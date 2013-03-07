<?php
/*
NAME:         Backup Apache folder
ABOUT:        Backups the www folder to Dropbox
DEPENDENCIES: The rsync package must be installed on your system.
INSTALL:      None;
CONFIG:       Change the directories to match your own. 
*/

if (date('Hi') == "0400")
{
	exec('rsync -r -t -p -o -g -v --progress --delete -s /home/jacob/www /home/jacob/Dropbox/new-computer');
	#alice_notification_add("Webserver backup", "Your webserver has been backed up.");
}
?>
