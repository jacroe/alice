<?php
/*
NAME:         Update Sickbeard
ABOUT:        Checks if Sickbeard is up to date.
DEPENDENCIES: Pushover module
INSTALL:      None;
CONFIG:       Edit the url to the homepage of your sickbeard installation. Update the phrasing to your liking
*/
if ($sb = file_get_contents("http://localhost:8082/home/"))
	if (preg_match("/\/home\/update\/\?pid=[0-9]{4,5}/i", $sb, $matches))
	{
		file_get_contents("http://localhost:8082/{$matches[0]}");
		sleep(60); // Give Sickbeard time to download and extract the update and restart
		alice_pushover("Sickbeard update", "Sickbeard has been updated to the lastest version.", -1);
		alice_notification_add("Sickbeard update", "Sickbeard has been updated to the lastest version.");
        }
?>
