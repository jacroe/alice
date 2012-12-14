<?php
/*
NAME:         Torrent
ABOUT:        Adds all .torrent files to either Deluge or Transmission based on which is not commmented
DEPENDENCIES: Deluge module or Transmission module; Pushover module;
INSTALL:      Edit the Deluge or Transmission settings in alice.php.
CONFIG:       Change the directory to your own.
*/

# Use this if you're using Deluge
foreach (glob('/home/jacob/Dropbox/Alice/*.torrent') as $file)
{
	$torrent = alice_deluge_addLocal($file);
	if($torrent->result == 1)
	{
		alice_pushover("Torrent added", "$file has been queued.");
		unlink($file);
	}
	else
	{
		alice_pushover("Torrent not added", "$file has not been queued.");
		rename($file, $file."s");
	}
}

foreach (glob('/home/jacob/Dropbox/Alice/*.magnet') as $file)
{	
	$torrent = alice_deluge_addLocal(trim(file_get_contents($file)));
	if($torrent->result == 1)
	{
		alice_pushover("Magnet added", "$file has been queued.");
		unlink($file);
	}
	else
	{
		alice_pushover("Magnet not added", "$file has not been queued.");
		rename($file, $file."s");
	}
}
/*
# Use this code if you're using Transmission
foreach (glob('/home/jacob/Dropbox/Alice/*.torrent') as $file)
{
	$torrent = alice_transmission_add($file);
	if ($torrent == "success")
	{
		alice_pushover("Torrent added", "$file has been queued.");
		unlink($file);
	}
	else
	{
		alice_pushover("Torrent not added", "The torrent at $file could not be queued.");
		rename($file, $file."s");
	}
}
foreach (glob('/home/jacob/Dropbox/Alice/*.magnet') as $file)
{
	$torrent = alice_transmission_add($file);
	if ($torrent == "success")
	{
		alice_pushover("Torrent added", "$file has been queued.");
		unlink($file);
	}
	else
	{
		alice_pushover("Torrent not added", "The torrent at $file could not be queued.");
		rename($file, $file."s");
	}
}
*/
?>
