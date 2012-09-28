<?php
/*
NAME:         Notify of Connection
ABOUT:        Notices when computer is offline and sends a notification when we reconnnect. 
DEPENDENCIES: Pushover module
SQL:          INSERT INTO `a_recipes` (`name`, `value`, `lastchanged`) VALUES
('notifyConnection_time', '-1', '2012-01-01 06:00:00')
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
	
	alice_pushover("Connection Down", "The internet connection was down for $time. It is now back up.");
	$arrayDB['time'] = -1;
	alice_mysql_put("recipes", "notifyConnection", $arrayDB);
}
elseif (($arrayDB['time'] == -1) && !alice_onlineCheck())
{
	$arrayDB['time'] = date('Y-m-d g:i a');
	alice_mysql_put("recipes", "notifyConnection", $arrayDB);
}
?>
