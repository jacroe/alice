<?php
if (!$_POST['json']) die("This is Alice's API. She says hi.");
require('alice.php');

$json = json_decode(($_POST['json']));
switch ($json->method) {

	// XBMC
	case "XBMC.PlayFilm":
		alice_xbmc_playFilm($json->params->id);
		break;
	case "XBMC.PlayEpisode":
		alice_xbmc_playEpisode($json->params->id);
		break;
	case "XBMC.Control":
		alice_xbmc_control($json->params->action);
		break;

	// X10
	case "X10.Do":
		alice_x10($json->params->device, $json->params->action);
		break;

	// Timer
	case "Timer.Set":
		alice_timer_set($json->params->datetime, $json->params->message);
		break;

	// Notifications
	case "Notify.Add":
		alice_notification_add($json->params->title, $json->params->message);
		break;
	case "Notify.Remove":
		alice_mysql_remove("modules", "notification", array($json->params->timestamp));
		break;

	// Groceries
	case "Grocery.Print":
		alice_groceries_print();
		break;

	default:
		echo "JSONERROR";
		break;
}