<?php
/*
NAME:         Notifications
ABOUT:        Receives notifications from other programs and stores them
DEPENDENCIES: MySQL module;
*/
function alice_notification_add($title, $message)
{
	$time = time();
	alice_mysql_put("modules", "notification", array($time => "$title|$message"));
	return $time;
}
function alice_notification_remove($timestamp)
{
	alice_mysql_remove("modules", "notification", $timestamp);
}
?>
