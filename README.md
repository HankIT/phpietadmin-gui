# phpietadmin
Phpietadmin is an easy to use webinterface to control the iet daemon (http://sourceforge.net/projects/iscsitarget/) written in php and javascript.

## Intention
The main reason for developing this was, to create a way to configure the daemon while it’s in use. The iet daemon reads
the config file only at start/restart. Changes after the daemon was started are only possible via the ietadm command line
tool. This tool alters the configuration of the daemon while it’s running. Unfortunatly, the changes are not reflected
in the config file itself. Which means, if the daemon gets restart the changes made via ietadm are gone, because the
daemons loads only the targets from the config file. Phpietadmin saves all changes in the config file and passes them
directly to the daemon via php’s „exec“ function. This prevents any inconsistency between the config file and the
daemon live config.

## Compatibility
Phpietadmin is tested on 8. But it’s not limited to debian.
It should run just fine on any other linux distribution.

## Docs
* https://github.com/MrCrankHank/phpietadmin/wiki/Installation-v05
* https://github.com/MrCrankHank/phpietadmin/wiki/Update-v04-to-v05

## Screens
https://github.com/MrCrankHank/phpietadmin/wiki/Screens-v05

## Features
Take a look at the github releases for detailed information about the features.

## Bugs in 0.5.2:
- [ ] Reload page after session disconnect
- [ ] Delete lun: check if line contains default parameter

## Roadmap
In version 0.6:
* LVM
    - [x] Lvm snapshots (No merging...)
    - [x] Add lvextend, lvremove, lvrename features

* Frontend
    - [x] Disable the auto logout by using a 0 in the config menu
    - [x] Put hostname in title
    - [x] Bar for PV/VG usage
    - [x] Cool sliders (http://www.jqueryrain.com/?ot4e1H_o)
    - [x] Better counter (html5 number doesn't look so good... http://www.virtuosoft.eu/code/bootstrap-touchspin/)
    - [x] Nested tables for iet volumes and iet sessions (https://github.com/wenzhixin/bootstrap-table-examples/blob/master/options/sub-table.html)
    - [x] Override option, if user is already logged in
    - [x] Create logging gui
    - [x] Improved ajax menu with error handling
    - [ ] Release "compressed" javascript files
    - [x] Use custom data attributes to store data in dom
    - [x] Configure target: Show if target has open sessions
    - [ ] Add bar to snapshot delete gui
    - [ ] Select all checkbox in snapshot delete gui

* Backend
    - [x] Create a target model with all functions which are necessary to add/delete/change a target
    - [x] Create a lvm model
    - [ ] Write phpietadmin-cli
        - [ ] Install/Update
    - [x] Basic error logging
    - [x] Login/Logout logging
    - [x] Debug logging
    - [ ] New session implementation
    - [ ] Database error log
    - [ ] Log also successful messages
    - [ ] Rework controller/models
        - [ ] Database model
        - [x] User model
        - [ ] Config model
        - [x] Dashboard
        - [x] Overview
        - [x] Targets
        - [x] Users
        - [x] Objects
        - [x] LVM
        - [x] Services
        - [ ] Config
        - [ ] PHPietadmin user/session menu
        - [ ] Stop/Reboot/Logout
    - [x] Use namespaces with basic autoloader
    - [x] New lsblk parser
    - [x] Replace version file with .json
    - [ ] Use bcrypt for storing passwords
    - [ ] Support for live resizing of targets (with workaround, since iet doesn't support)
    - [ ] Rework the javascript code

* Misc
    - [ ] Create development branch after release of v0.6 (master should be stable)

In version 0.7:
* LVM
    - [ ] Volume group menu (select which volume groups phpietadmin should use)
    - [ ] Optional lv prefix (append LV_ or some other user chosen string)
    - [ ] Add snapshot merge feature to gui
    - [ ] Add enable/disable logical volume feature to gui

* Frontend
    - [ ] Use jwindow to dynamically display the status of running commands
    - [ ] Drag & Drop with HTML5
    - [ ] Menu to import orphaned objects into database
    - [ ] Display input validation with bootstrap css Validation states (http://formvalidation.io/validators/integer/)
    - [ ] Bootstrap-table Table Select Checkbox
    - [ ] Awesome checkboxes (https://github.com/designmodo/Flat-UI)
    - [ ] Improve configure target settings menu
    - [ ] Improve nested table row handling

* Backend
    - [ ] Write process class to execute commands in the background (+ jwindow)
    - [ ] Create complete documentation on https://readthedocs.org/
    - [ ] Use unity testing

* In version 0.8:
    - [ ] Support for DRBD (show status)
    - [ ] Support for HA Clusters (Corosync & Pacemaker, only for iet)

* In version 0.9:
    - [ ] Support for nfs

## More
- [ ] Software raid status
- [ ] Support for samba shares
- [ ] Show and configure network settings
- [ ] Enable/Disable features
- [ ] Support for apcupsd
- [ ] Manual selection of block devices
- [ ] HDD temp
- [ ] Pie Chart for volume groups
- [ ] Smart data
- [ ] Backup config files (http://code.stephenmorley.org/php/diff-implementation/)
- [ ] Menu to restore config files
- [ ] function naming convention in models (prepend class name to function name)
- [ ] Create "consistency", which displays if the daemon config and the config file are identically
- [ ] Use composer
- [ ] Use json for tables
- [ ] Change duplication check (Try to select the specific value from the database)
- [ ] Add "Generate random id" button to the "Add target" menu
- [ ] Use own exception class for error handling
- [ ] Prevent comments from being deleted, when editing a config file
- [ ] Sign archives
- [ ] Separate database models

Items are completely random ;-)

If you have any problems, please open an issue!