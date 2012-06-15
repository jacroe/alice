<?php
/*
NAME:         Backup /var/www/ folder
ABOUT:        Backups the www folder to Dropbox
DEPENDENCIES: None;
*/
function backup_www() {
	exec('rsync -r -t -p -o -g -v --progress --delete -s /var/www /home/jacob/Dropbox/new-computer');
}
if (date('Hi') == "0400") backup_www();
?>
