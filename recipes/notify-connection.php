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
	$arrayDB['time'] = -1;
	alice_mysql_put("recipes", "notifyConnection", $arrayDB);
	alice_pushover("Connection Down", "The internet connection was down. It is now back up.");
}
elseif (($arrayDB['time'] == -1) && !alice_onlineCheck())
{
	$arrayDB['time'] = 1;
	alice_mysql_put("recipes", "notifyConnection", $arrayDB);
}
?>