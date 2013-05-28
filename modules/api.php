<?php
/*
NAME:         API
ABOUT:        API
DEPENDENCIES: All
*/
function alice_api($json)
{
	$json = json_decode($json);
	switch ($json->method)
	{

		// XBMC
		case "XBMC.PlayFilm":
			if(!alice_xbmc_isOn())
				return alice_api_buildResponse("XBMC.PlayFilm", 0, "XBMC is offline.");
			elseif(!$json->params->id)
				return alice_api_buildResponse("XBMC.PlayFilm", 0, "Invalid paramaters");
			else
			{
				if(alice_xbmc_playFilm($json->params->id))
					return alice_api_buildResponse("XBMC.PlayFilm");
				else
					return alice_api_buildResponse("XBMC.PlayFilm", 0, "Failed to play film.");
			}
			break;
		case "XBMC.PlayEpisode":
			if(!alice_xbmc_isOn())
				return alice_api_buildResponse("XBMC.PlayEpisode", 0, "XBMC is offline.");
			elseif((!$json->params->id) && (!$json->params->type))
				return alice_api_buildResponse("XBMC.PlayEpisode", 0, "Invalid paramaters");
			else
			{
				if($json->params->id)
					if(alice_xbmc_playEpisode($json->params->id))
						return alice_api_buildResponse("XBMC.PlayEpisode");
					else
						return alice_api_buildResponse("XBMC.PlayEpisode", 0, "Failed to play episode.");
				elseif($json->params->type == "next")
				{
					$arrayNextEpisode = alice_xbmc_getFirstUnwatchedEpisode($json->params->showid);
					if(alice_xbmc_playEpisode($arrayNextEpisode["id"]))
						return alice_api_buildResponse("XBMC.PlayEpisode");
					else
						return alice_api_buildResponse("XBMC.PlayEpisode", 0, "Failed to play episode.");
				}
				elseif($json->params->type == "last")
				{
					$arrayLastEpisode = alice_xbmc_getLatestEpisode($json->params->showid);
					if(alice_xbmc_playEpisode($arrayLastEpisode["id"]))
						return alice_api_buildResponse("XBMC.PlayEpisode");
					else
						return alice_api_buildResponse("XBMC.PlayEpisode", 0, "Failed to play episode.");
				}
			}
			break;
		case "XBMC.Control":
			if(!alice_xbmc_isOn())
				return alice_api_buildResponse("XBMC.PlayFilm", 0, "XBMC is offline.");
			else
			{
				$returnXBMC = alice_xbmc_control($json->params->action);
				if($returnXBMC != -1)
					return alice_api_buildResponse("XBMC.Control", 1, $returnXBMC);
				else
					return alice_api_buildResponse("XBMC.Control", 0, "Unrecognized control");
			}
			break;
		case "XBMC.Quit":
			if(!alice_xbmc_isOn())
				return alice_api_buildResponse("XBMC.Quit", 0, "XBMC is offline.");
			else
			{
				alice_xbmc_quit();
				return alice_api_buildResponse("XBMC.Quit");
			}

		// X10
		case "X10.Do":
			if(!$json->params->device || !$json->params->action)
				return alice_api_buildResponse("X10.Do", 0, "Invalid paramaters");
			elseif ($json->params->amount)
			{
				alice_x10($json->params->device, $json->params->action, $json->params->amount);
				return alice_api_buildResponse("X10.Do");
			}
			else
			{
				alice_x10($json->params->device, $json->params->action);
				return alice_api_buildResponse("X10.Do");
			}
			break;

		// Timer
		case "Timer.Set":
			if(!$json->params->datetime || !$json->params->message)
				return alice_api_buildResponse("Timer.Set", 0, "Invalid paramaters");
			else
			{
				$timerTime = alice_timer_set($json->params->datetime, $json->params->message);
				return alice_api_buildResponse("Timer.Set", 1, $timerTime);
			}
			break;
		case "Timer.Remove":
			if(!$json->params->timer)
				return alice_api_buildResponse("Timer.Remove", 0, "Invalid paramaters");
			else
			{
				alice_timer_remove($json->params->timer);
				return alice_api_buildResponse("Timer.Remove");
			}

		// Notifications
		case "Notify.Add":
			if(!$json->params->title || !$json->params->message)
				return alice_api_buildResponse("Notify.Add", 0, "Invalid paramaters");
			else
			{
				$notifTime = alice_notification_add($json->params->title, $json->params->message);
				return alice_api_buildResponse("Notify.Add", 1, $notifTime);
			}
			break;
		case "Notify.Remove":
			if(!$json->params->timestamp)
				return alice_api_buildResponse("Notify.Remove", 0, "Invalid paramaters");
			else
			{
				alice_notification_remove($json->params->timestamp);
				return alice_api_buildResponse("Notify.Remove");
			}
			break;

		// Groceries
		case "Grocery.Print":
			if(alice_groceries_print())
				return alice_api_buildResponse("Grocery.Print");
			else
				return alice_api_buildResponse("Grocery.Print", 0, "PDF was not placed in Dropbox. Check error.log for more info.");
			break;

		// Macros
		case "Macro.Run":
			if(!$json->params->macro)
				return alice_api_buildResponse("Macro.Run", 0, "Invalid paramaters");
			else
			{
				alice_macro_run($json->params->macro);
				return alice_api_buildResponse("Macro.Run");
			}
			break;

		default:
			return alice_api_buildResponse($json->method, 0, "Method not recognized.");
			break;
	}
}
function alice_api_buildResponse($method, $status = true, $response = null)
{
	if($status)
		$json = array("method"=>$method, "status"=>"Ok", "response"=>$response);
	else
		$json = array("method"=>$method, "status"=>"Invalid", "error"=>$response);

	return json_encode($json);
}