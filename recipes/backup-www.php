<?php
/*
NAME:         Backup /var/www/ folder
ABOUT:        Backups the www folder to Dropbox
DEPENDENCIES: None;
*/

if (date('Hi') == "0400") exec('rsync -r -t -p -o -g -v --progress --delete -s /home/jacob/www /home/jacob/Dropbox/new-computer');;
?>
