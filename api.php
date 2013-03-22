<?php
if (!$_POST['json']) die("This is Alice's API. She says hi.");
require('alice.php');

$json = json_decode(($_POST['json']));
switch ($json->method)
{

	// XBMC
	case "XBMC.PlayFilm":
		alice_xbmc_playFilm($json->params->id);
		break;
	case "XBMC.PlayEpisode":
		if($json->params->id)
			alice_xbmc_playEpisode($json->params->id);
		elseif($json->params->type)
			if($json->params->type == "next")
			{
				$arrayNextEpisode = alice_xbmc_getFirstUnwatchedEpisode($json->params->showid);
				alice_xbmc_playEpisode($arrayNextEpisode["id"]);
			}
		break;
	case "XBMC.Control":
		$returnXBMC = alice_xbmc_control($json->params->action);
		if($returnXBMC != -1)
			echo alice_api_buildResponse("XBMC.Control", 1, $returnXBMC);
		else
			echo alice_api_buildResponse("XBMC.Control", 0, "Unrecognized control");
		break;

	// X10
	case "X10.Do":
		if(!$json->params->device || !$json->params->action)
			echo alice_api_buildResponse("X10.Do", 0, "Invalid paramaters");
		else
		{
			alice_x10($json->params->device, $json->params->action);
			echo alice_api_buildResponse("X10.Do");
		}
		break;

	// Timer
	case "Timer.Set":
		if(!$json->params->datetime || !$json->params->message)
			echo alice_api_buildResponse("Timer.Set", 0, "Invalid paramaters");
		else
		{
			$time = alice_timer_set($json->params->datetime, $json->params->message);
			echo alice_api_buildResponse("Timer.Set", 1, $time);
		}
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
		if(alice_groceries_print())
			echo alice_api_buildResponse("Grocery.Print");
		else
			echo alice_api_buildResponse("Grocery.Print", 0, "PDF was not placed in Dropbox. Check error.log for more info.");
		break;

	default:
		echo alice_api_buildResponse($json->method, 0, "Method not recognized.");
		break;
}
function alice_api_buildResponse($method, $status = true, $response = null)
{
	if($status)
		$json = array("method"=>$method, "status"=>"Ok", "response"=>$response);
	else
		$json = array("method"=>$method, "status"=>"Invalid", "error"=>$response);

	return json_encode($json);
}