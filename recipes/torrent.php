<?php
/*
NAME:         Torrent
ABOUT:        Adds all .torrent files to Transmission
DEPENDENCIES: Transmission module; Pushover module;
INSTALL:      Edit the Transmission settings in alice.php.
CONFIG:       Change the directory to your own.
*/
foreach (array_reverse(glob('/home/jacob/Dropbox/Alice/*.torrent')) as $file)
{
	$torrent = alice_transmission_add($file);
	if ($torrent == "success")
	{
		alice_pushover("Torrent added", "$file has been queued.");
		unlink($file);
	}
	else
	{
		alice_pushover("Torrent not added", "The torrent  at $file could not be queued.");
		rename($file, $file."s");
	}
}
?>
