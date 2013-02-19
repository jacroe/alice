<?php
/*
NAME:         Notify of Connection
ABOUT:        Notices when computer is offline and sends a notification when we reconnnect. 
DEPENDENCIES: Pushover module
INSTALL:      None;
CONFIG:       Works out of the box though you may want to edit the phrasing to your liking;
*/

$arrayDB = alice_mysql_get("recipes", "notifyConnection");
if (($arrayDB['time'] != -1) && alice_onlineCheck())
{
	$now = new DateTime();
	$ref = new DateTime($arrayDB['time']);
	$diff = $now->diff($ref);
	if ($diff->d) $time = "{$diff->d} days {$diff->h} hours and {$diff->i} minutes";
	elseif ($diff->h) $time = "{$diff->h} hours and {$diff->i} minutes";
	else $time = "{$diff->i} minutes";
	
	if ($time != "1 minutes" && $time != "0 minutes" && $time != "2 minutes") alice_pushover("Connection Down", "The internet connection was down for $time. It is now back up.");
	alice_mysql_put("recipes", "notifyConnection", array("time"=>-1));
}
elseif (($arrayDB['time'] == -1) && !alice_onlineCheck())
{
	alice_mysql_put("recipes", "notifyConnection", array("time"=>date('Y-m-d g:i a')));
}
?>
