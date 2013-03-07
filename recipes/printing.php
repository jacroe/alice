<?php
/*
NAME:         Printing
ABOUT:        Prints pdf documents. Note: This recipe as is will NOT work on Windows. It has only been tested to work on Ubuntu 11.10; it may work on Mac.
DEPENDENCIES: None;
INSTALL:      You will need to have CUPS installed to use the "lp" command. If you don't use CUPS to print, you'll need to find out what you do use.
CONFIG:       None;
*/
foreach (array_reverse(glob(DROPBOX.'*.pdf')) as $file)
{
	exec("lp $file");
	unlink($file);
	$file = str_replace(DROPBOX, "", $file);
	alice_notification_add("Printed document", "$file was printed.");
}
?>
