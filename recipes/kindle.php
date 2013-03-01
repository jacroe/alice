<?php
/*
NAME:         Kindle
ABOUT:        Mails .mobi files found in Alice's Dropbox folder to be read on Kindle
DEPENDENCIES: Email module;
INSTALL:      None;
CONFIG:       Change directory to one of your own. Change the Kindle email address to your own.
*/
foreach (array_reverse(glob(DROPBOX.'*.mobi')) as $file)
{
	alice_email_send("Kindle", "jacroe@free.kindle.com", "Convert", " ", $file);
	unlink($file);
	$file = str_replace("/home/jacob/Dropbox/Alice/", "", $file);
	alice_notification_add("Kindle file sent", "$file has been sent.");
}
?>
