<?php
foreach (array_reverse(glob('/home/jacob/Dropbox/Alice/*.mobi')) as $file)
{
	alice_email_send("Kindle", "jacroe@free.kindle.com", "Convert", " ", $file);
	unlink($file);
}
?>
