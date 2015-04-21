CREATE TABLE config(
  id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  option VARCHAR(50) NOT NULL,
  value VARCHAR(50) NOT NULL,
  editable_via_gui BOOLEAN NOT NULL DEFAULT 0,
  description VARCHAR(200)
);

CREATE TABLE user(
  id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

INSERT INTO config (option, value, description) VALUES
    ('proc_sessions', '/proc/net/iet/session', "Path to the IET sessions file"),
    ('proc_volumes', '/proc/net/iet/volume', "Path to the IET volumes file"),
    ('ietd_config_file', '/etc/iet/ietd.conf', "Path to the IET config file"),
    ('ietd_init_allow', '/etc/iet/initiators.allow', "Path to the IET initiators allow file"),
    ('ietd_target_allow', '/etc/iet/targets.allow', "Path to the IET targets allow file"),
    ('ietadm', '/usr/sbin/ietadm', "Path to the IET admin tool"),
    ('servicename', 'iscsitarget', "Name of the IET service"),
    ('iqn', 'iqn.2014-12.com.example.iscsi', "Names of the iscsi targets"),
    ('lvs', '/sbin/lvs', "Path to the lvs binary"),
    ('vgs', '/sbin/vgs', "Path to the vgs binary"),
    ('pvs', '/sbin/pvs', "Path to the pvs binary"),
    ('lvcreate', '/sbin/lvcreate', "Path to the lvcreate binary"),
    ('lvreduce', '/sbin/lvreduce', "Path to the lvreduce binary"),
    ('lvextend', '/sbin/lvextend', "Path to the lvextend binary"),
    ('lvremove', '/sbin/lvremove', "Path to the lvremove binary"),
    ('mdstat', '/proc/mdstat', "Path to the mdstat file"),
    ('sudo', '/usr/bin/sudo', "Path to the sudo binary"),
    ('service', '/usr/sbin/service', "Path to the service binary"),
    ('lsblk', '/bin/lsblk', "Path to the lsblk binary");

