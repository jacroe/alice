<?php
foreach (array_reverse(glob('/home/jacob/Dropbox/Alice/*.nzb')) as $file)
{
	$result = file_get_contents(SABNZBD_SERVER."api?mode=addlocalfile&name=".$file."&apikey=".SABNZBD_API);
	if ($result == "ok\n") 
	{
		alice_email_send(NAME, EMAIL, "NZB added", "<code>".$file."</code> has been queued.");
		unlink($file);
	}
	else
	{
		alice_email_send(NAME, EMAIL, "NZB not added", "The NZB at <code>".$file."</code> could not be queued. The following error was given:<br /> <code>".$result."</code>");
		rename($file, $file."s");
	}
}
?>
