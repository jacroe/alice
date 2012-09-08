<?php
/*
NAME:         Update Sickbeard
ABOUT:        Checks if Sickbeard is up to date.
DEPENDENCIES: None;
*/
if ($sb = file_get_contents("http://localhost:8082/home/"))
	if (preg_match("/\/home\/update\/\?pid=[0-9]{4}/i", $sb, $matches))
	{
		file_get_contents("http://localhost:8082/{$matches[0]}");
		alice_pushover("Sickbeard update", "Sickbeard has been updated to the lastest version.");
        }
?>
