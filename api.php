<?php
if (!$_POST['json']) die("This is Alice's API. She says hi.");
require('alice.php');

$json = json_decode(($_POST['json']));
switch ($json->method)
{

	// XBMC
	case "XBMC.PlayFilm":
		if(!alice_xbmc_isOn())
			echo alice_api_buildResponse("XBMC.PlayFilm", 0, "XBMC is offline.");
		elseif(!$json->params->id)
			echo alice_api_buildResponse("XBMC.PlayFilm", 0, "Invalid paramaters");
		else
		{
			if(alice_xbmc_playFilm($json->params->id))
				echo alice_api_buildResponse("XBMC.PlayFilm");
			else
				echo alice_api_buildResponse("XBMC.PlayFilm", 0, "Failed to play film.");
		}
		break;
	case "XBMC.PlayEpisode":
		if(!alice_xbmc_isOn())
			echo alice_api_buildResponse("XBMC.PlayEpisode", 0, "XBMC is offline.");
		elseif(!$json->params->id || !$json->params->type)
			echo alice_api_buildResponse("XBMC.PlayEpisode", 0, "Invalid paramaters");
		else
		{
			if($json->params->id)
				if(alice_xbmc_playEpisode($json->params->id))
					echo alice_api_buildResponse("XBMC.PlayEpisode");
				else
					echo alice_api_buildResponse("XBMC.PlayEpisode", 0, "Failed to play episode.");
			elseif($json->params->type == "next")
				{
					$arrayNextEpisode = alice_xbmc_getFirstUnwatchedEpisode($json->params->showid);
					if(alice_xbmc_playEpisode($arrayNextEpisode["id"]))
						echo alice_api_buildResponse("XBMC.PlayEpisode");
					else
						echo alice_api_buildResponse("XBMC.PlayEpisode", 0, "Failed to play episode.");
				}
		}
		break;
	case "XBMC.Control":
		if(!alice_xbmc_isOn())
			echo alice_api_buildResponse("XBMC.PlayFilm", 0, "XBMC is offline.");
		else
		{
			$returnXBMC = alice_xbmc_control($json->params->action);
			if($returnXBMC != -1)
				echo alice_api_buildResponse("XBMC.Control", 1, $returnXBMC);
			else
				echo alice_api_buildResponse("XBMC.Control", 0, "Unrecognized control");
		}
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
			$timerTime = alice_timer_set($json->params->datetime, $json->params->message);
			echo alice_api_buildResponse("Timer.Set", 1, $timerTime);
		}
		break;

	// Notifications
	case "Notify.Add":
		if(!$json->params->title || !$json->params->message)
			echo alice_api_buildResponse("Notify.Add", 0, "Invalid paramaters");
		else
		{
			$notifTime = alice_notification_add($json->params->title, $json->params->message);
			echo alice_api_buildResponse("Notify.Add", 1, $notifTime);
		}
		break;
	case "Notify.Remove":
		if(!$json->params->timestamp)
			echo alice_api_buildResponse("Notify.Remove", 0, "Invalid paramaters");
		else
		{
			alice_mysql_remove("modules", "notification", array($json->params->timestamp));
			echo alice_api_buildResponse("Notify.Remove");
		}
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
echo "\n";
function alice_api_buildResponse($method, $status = true, $response = null)
{
	if($status)
		$json = array("method"=>$method, "status"=>"Ok", "response"=>$response);
	else
		$json = array("method"=>$method, "status"=>"Invalid", "error"=>$response);

	return json_encode($json);
}