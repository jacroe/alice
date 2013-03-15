<?php
/*
NAME:         Printing
ABOUT:        Prints pdf documents. Note: This recipe as is will NOT work on Windows. It has only been tested to work on Ubuntu 11.10; it may work on Mac.
DEPENDENCIES: CUPS to use the "lp" commnand (can be substituted for any command line tool that prints pdfs)
INSTALL:      None;
CONFIG:       Change the location where Alice should look for PDFs;
*/
foreach (array_reverse(glob(DROPBOX.'*.pdf')) as $file)
{
	exec("lp $file");
	unlink($file);
	$file = str_replace(DROPBOX, "", $file);
	alice_notification_add("Printed document", "$file was printed.");
}
?>
