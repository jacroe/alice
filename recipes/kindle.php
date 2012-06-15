<?php
/*
NAME:         Kindle
ABOUT:        Mails .mobi files found in Alice's Dropbox folder to be read on Kindle
DEPENDENCIES: Email module;
*/
foreach (array_reverse(glob('/home/jacob/Dropbox/Alice/*.mobi')) as $file)
{
	alice_email_send("Kindle", "jacroe@free.kindle.com", "Convert", " ", $file);
	unlink($file);
}
?>
