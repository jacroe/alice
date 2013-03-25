<?php
/*
NAME:         Torrent
ABOUT:        Adds all .torrent files to either Deluge or Transmission based on which is not commmented
DEPENDENCIES: Deluge module or Transmission module; Pushover module;
INSTALL:      Edit the Deluge or Transmission settings in alice.php. Comment/Uncomment the below code depending on which torrent software you're using
CONFIG:       Change the directory to your own.
*/

# Use this if you're using Deluge
foreach (glob(DROPBOX.'*.torrent') as $file)
{
	$torrent = alice_deluge_addLocal($file);

	if($torrent->result == 1)
	{
		unlink($file);
		$file = str_replace(DROPBOX, "", $file);
		alice_notification_add("Torrent added", "$file was queued.");
		alice_pushover("Torrent added", "$file has been queued.");
	}
	else
	{
		rename($file, $file."s");
		alice_pushover("Torrent not added", "$file has not been queued.");
		$file = str_replace(DROPBOX, "", $file);
	}
}
foreach (glob(DROPBOX.'*.magnet') as $file)
{	
	$torrent = alice_deluge_addLocal(trim(file_get_contents($file)));
	if($torrent->result == 1)
	{
		unlink($file);
		$file = str_replace(DROPBOX, "", $file);
		alice_notification_add("Magnet added", "$file has been queued.");
		alice_pushover("Magnet added", "$file has been queued.");
	}
	else
	{
		rename($file, $file."s");
		$file = str_replace(DROPBOX, "", $file);
		alice_pushover("Magnet not added", "$file has not been queued.");
	}
}
/*
# Use this code if you're using Transmission
foreach (glob(DROPBOX.'*.torrent') as $file)
{
	$torrent = alice_transmission_add($file);
	if ($torrent == "success")
	{
		unlink($file);
		$file = str_replace(DROPBOX, "", $file);
		alice_notification_add("Torrent added", "$file has been queued.");
		alice_pushover("Torrent added", "$file has been queued.");
	}
	else
	{
		rename($file, $file."s");
		$file = str_replace(DROPBOX, "", $file);
		alice_pushover("Torrent not added", "The torrent at $file could not be queued.");
	}
}
foreach (glob(DROPBOX.'*.magnet') as $file)
{
	$torrent = alice_transmission_add($file);
	if ($torrent == "success")
	{
		unlink($file);
		$file = str_replace(DROPBOX, "", $file);
		alice_notification_add("Magnet added", "$file has been queued.");
		alice_pushover("Torrent added", "$file has been queued.");
	}
	else
	{
		rename($file, $file."s");
		$file = str_replace(DROPBOX, "", $file);
		alice_pushover("Torrent not added", "The torrent at $file could not be queued.");
	}
}
*/
?>
