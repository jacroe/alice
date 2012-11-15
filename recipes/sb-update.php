<?php
/*
NAME:         Update Sickbeard
ABOUT:        Checks if Sickbeard is up to date.
DEPENDENCIES: Pushover module
INSTALL:      None;
CONFIG:       Edit the url to the homepage of your sickbeard installation.
*/
if ($sb = file_get_contents("http://localhost:8082/home/"))
 // 10 minute delay so we won't try to update while we're currently updating. 
	if (preg_match("/\/home\/update\/\?pid=[0-9]{4,5}/i", $sb, $matches))
	{
		file_get_contents("http://localhost:8082/{$matches[0]}");
		sleep(60); // Give Sickbeard time to download and extract the update and restart
		alice_pushover("Sickbeard update", "Sickbeard has been updated to the lastest version.", -1);
        }
?>
