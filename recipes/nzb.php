<?php
/*
NAME:         Newzbin
ABOUT:        Adds .nzb to SABnzbd
DEPENDENCIES: Pushover module;
*/
foreach (array_reverse(glob('/home/jacob/Dropbox/Alice/*.nzb')) as $file)
{
	$result = file_get_contents(SABNZBD_SERVER."api?mode=addlocalfile&name=".$file."&apikey=".SABNZBD_API);
	if ($result == "ok\n")
	{
		alice_pushover("NZB added", "$file has been queued.");
		unlink($file);
	}
	else
	{
		alice_pushover("NZB not added", "The NZB at $file could not be queued.");
		rename($file, $file."s");
	}
}
?>
