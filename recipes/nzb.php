<?php
/*
NAME:         Newzbin
ABOUT:        Adds .nzb to SABnzbd
DEPENDENCIES: Pushover module;
INSTALL:      Edit the SABnzbd+ settings in alice.php.
CONFIG:       Change the directory to one of your own. 
*/
foreach (array_reverse(glob(DROPBOX.'*.nzb')) as $file)
{
	$result = file_get_contents(SABNZBD_SERVER."api?mode=addlocalfile&name=".$file."&apikey=".SABNZBD_API);
	if ($result == "ok\n")
	{
		unlink($file);
		$file = str_replace(DROPBOX, "", $file);
		alice_pushover("NZB added", "$file has been queued.");
		alice_notification_add("NZB added", "$file has been queued.");
	}
	else
	{
		rename($file, $file."s");
		$file = str_replace(DROPBOX, "", $file);
		alice_pushover("NZB not added", "The NZB at $file could not be queued.");		
	}
}
?>

