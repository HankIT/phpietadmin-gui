<?php namespace phpietadmin\app\models;
class Std {
    /**
     * array_search for multidimensional arrays
     *
     * @param string $needle
     * @param array $haystack
     * @return int|bool
     *
     */
    public function recursive_array_search($needle, array $haystack) {
        foreach ($haystack as $key => $value) {
            $current_key = $key;
            if ($needle === $value OR (is_array($value) && $this->recursive_array_search($needle, $value) !== false)) {
                return $current_key;
            }
        }
        return false;
    }

    /**
     *  array_search function with partial match
     *
     * @param string $needle
     * @param array $haystack
     * @link https://gist.github.com/branneman/951847
     * @return bool
     *
     */
    public function array_find($needle, array $haystack) {
        foreach ($haystack as $key => $value) {
            if (false !== stripos($value, $needle)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Collects data for the phpietadmin dashboard
     *
     * @return array
     */
    public function get_dashboard_data() {
        $data['hostname'] = file_get_contents('/etc/hostname');

        // get version and release
        $json = json_decode(file_get_contents(__DIR__ . '/../../version.json'), true);
        $data['phpietadminversion'] = $json['version'][1]['version_nr'];
        $data['release'] = $json['version'][3]['release'];

        $data['distribution'] = shell_exec('lsb_release -sd');

        $hwdata = file('/proc/cpuinfo');
        $hwdata[4] = str_replace("model", '', $hwdata[4]);
        $hwdata[4] = str_replace("name", '', $hwdata[4]);
        $data['cpu'] = str_replace(":", '', $hwdata[4]);

        $data['uptime'] = shell_exec('uptime -p');
        $data['systemstart'] = shell_exec('uptime -s');

        preg_match('/load average: (.*)/', shell_exec('uptime'), $matches);
        $data['currentload'] = $matches[1];

        $mem = file('/proc/meminfo');
        preg_match('/[0-9]+/', $mem[0], $matches);
        $data['memtotal'] = intval($matches[0] / 1024);

        preg_match('/[0-9]+/', $mem[1], $matches);
        $data['memused'] = intval($matches[0] / 1024);

        $data['systemtime'] = shell_exec('date');
        $data['kernel'] = shell_exec('uname -r');

        return $data;
    }

    /**
     * Checks if an incoming request is an ajax
     *
     * @return bool
     */
    public function IsXHttpRequest() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * Escape and execute a command
     * $return['status'] = string, contains a error message from the program executed
     * $return['result'] = int contains a error code from the program executed
     * $return['code_type'] = error code generated by third party tool or phpietadmin?
     *
     * @param    string $command command to be executed
     * @return   array
     *
     */
    protected function exec_and_return($command) {
        $return = [];
        exec(escapeshellcmd($command) . ' 2>&1', $return['status'], $return['result']);
        $return['code_type'] = 'extern';
        return $return;
    }

    /**
     *
     * empty() function for multiple values
     *
     * @link    http://stackoverflow.com/questions/4993104/using-ifempty-with-multiple-variables-not-in-an-array
     * @return      boolean
     *
     */
    public function mempty() {
        foreach (func_get_args() as $arg)
            if (empty($arg))
                continue;
            else
                return false;
        return true;
    }

    /**
     * Create a "normal" array from a multidimensional one
     *
     * @param array $array multidimensional array to convert
     * @return array
     * @link http://stackoverflow.com/questions/6785355/convert-multidimensional-array-into-single-array/6785366#6785366
     *
     */
    public function array_flatten(array $array) {
        if (!is_array($array)) {
            return FALSE;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->array_flatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /**
     * Hash a string an return it
     * To prevent inconsistency with different hashing algorithms
     *
     * @param $string string that should be hashed
     * @return string
     */
    public function hash_sha256_string($string) {
        return hash('sha256', $string);
    }

    public function check_if_file_contains_value($file, $value) {
        if (strpos(file_get_contents($file), $value) !== false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Tail implementation in php
     *
     * @link http://www.geekality.net/2011/05/28/php-tail-tackling-large-files/
     * @param $filename
     * @param int $lines
     * @param int $buffer
     * @return string
     */
    public function tail($filename, $lines = 10, $buffer = 4096) {
        if (file_exists($filename) && filesize($filename) != 0) {
            // Open the file
            $f = fopen($filename, "rb");

            // Jump to last character
            fseek($f, -1, SEEK_END);

            // Read it and adjust line number if necessary
            // (Otherwise the result would be wrong if file doesn't end with a blank line)
            if(fread($f, 1) != "\n") $lines -= 1;

            // Start reading
            $output = '';
            $chunk = '';

            // While we would like more
            while(ftell($f) > 0 && $lines >= 0)
            {
                // Figure out how far back we should jump
                $seek = min(ftell($f), $buffer);

                // Do the jump (backwards, relative to where we are)
                fseek($f, -$seek, SEEK_CUR);

                // Read a chunk and prepend it to our output
                $output = ($chunk = fread($f, $seek)).$output;

                // Jump back to where we started reading
                fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);

                // Decrease our line counter
                $lines -= substr_count($chunk, "\n");
            }

            // While we have too many lines
            // (Because of buffer size we might have read too many)
            while($lines++ < 0)
            {
                // Find first newline and remove all text before that
                $output = substr($output, strpos($output, "\n") + 1);
            }

            // Close file and return
            fclose($f);

            $data = array_filter(explode("\n", $output));

            foreach ($data as $line) {
                $rows[] = str_getcsv($line, ' ');
            }

            return $rows;
        } else {
            return false;
        }
    }
}