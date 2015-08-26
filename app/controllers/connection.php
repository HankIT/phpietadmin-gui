<?php
    class connection extends Controller {
        /**
         *
         * echos a service status
         *
         * @return      void
         *
         */
       public function status() {
           if (isset($_POST['servicename'])) {
               $return = $this->std->get_service_status($_POST['servicename']);
               echo htmlspecialchars($return[1]);
           } else {
               echo 'Undefined service name';
           }
       }

        /**
         *
         * check if session is expired
         *
         * @return      void
         *
         */
       public function check_session_expired() {
           // if the session is expired the function check_loggedin in core/Controller.php will return false
           // else we will return true here
           echo 'true';
       }

        /**
         *
         * check if server is still reachable
         *
         * @return      void
         *
         */
       public function check_server_online() {
           echo 'alive';
       }
    }