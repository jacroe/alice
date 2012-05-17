<?php
foreach (array_reverse(glob('/home/jacob/Dropbox/Alice/*.torrent')) as $file)
{
	$torrent = alice_transmission_add($file);
	if ($torrent == "success")
	{
		alice_email_send("Jacob", "jacob@jacroe.com", "Torrent added", "<code>".$file."</code> has been queued.");
		unlink($file);
	}
	else
	{
		alice_email_send("Jacob", "jacob@jacroe.com", "Torrent not added", "The torrent  at <code>".$file."</code> could not be queued. The following error was given:<br /> <code>".$torrent."</code>");
		rename($file, $file."s");
	}
}
?>
