<?php
function alice_xbmc_talk($data)
{	
	$data = json_encode($data);
	$ch = curl_init(XBMC_SERVER."jsonrpc");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Content-Length: ' . strlen($data)));
	$result = curl_exec($ch);
	return $result;
}
function alice_xbmc_check($string)
{
	$data = array("jsonrpc" => "2.0", "method" => "Player.GetActivePlayers", "id" => 1);
	$player = json_decode(alice_xbmc_talk($data))->result[0]->playerid;
	if (preg_match("/\bpause\b/i", $string))
	{
		$data = array("jsonrpc" => "2.0", "method" => "Player.PlayPause", "params" => array("playerid" => $player), "id" => 1);
		$xbmc = json_decode(alice_xbmc_talk($data));
		if ($xbmc->result->speed) return "XBMC Playing";
		else return "XBMC Paused";
	}
	elseif (preg_match("/\brewind\b/i", $string))
	{
		$data = array("jsonrpc" => "2.0", "method" => "Player.Seek", "params" => array("playerid" => $player, "value" => "smallbackward"), "id" => 1);
		$xbmc = json_decode(alice_xbmc_talk($data));
		return "XBMC Skipped Backward";
	}
	elseif (preg_match("/\bforward\b/i", $string))
	{
		$data = array("jsonrpc" => "2.0", "method" => "Player.Seek", "params" => array("playerid" => $player, "value" => "smallforward"), "id" => 1);
		$xbmc = json_decode(alice_xbmc_talk($data));
		return "XBMC Skipped Forward";
	}
	elseif (preg_match("/\bvolume\b/i", $string))
	{
		if (preg_match("/\bmute\b/i", $string))
		{
			$data = array("jsonrpc" => "2.0", "method" => "Application.SetMute", "params" => array("mute" => "toggle"), "id" => 1);
			$xbmc = json_decode(alice_xbmc_talk($data));
			if ($xbmc->result) return "XBMC Muted";
			else return "XBMC Unmuted";
		}
		elseif (preg_match("/\bup\b/i", $string))
		{
			$data = array("jsonrpc" => "2.0", "method" => "Application.GetProperties", "params" => array("properties" => array("volume")), "id" => 1);
			$xbmc = json_decode(alice_xbmc_talk($data));
			$newvolume = ($xbmc->result->volume)+5;
			$data = array("jsonrpc" => "2.0", "method" => "Application.SetVolume", "params" => array("volume" => $newvolume), "id" => 1);
			alice_xbmc_talk($data);
			return "XBMC volume increased to ".$newvolume;
		}
		elseif (preg_match("/\bdown\b/i", $string))
		{
			$data = array("jsonrpc" => "2.0", "method" => "Application.GetProperties", "params" => array("properties" => array("volume")), "id" => 1);
			$xbmc = json_decode(alice_xbmc_talk($data));
			$newvolume = ($xbmc->result->volume)-5;
			$data = array("jsonrpc" => "2.0", "method" => "Application.SetVolume", "params" => array("volume" => $newvolume), "id" => 1);
			alice_xbmc_talk($data);
			return "XBMC volume decreased to ".$newvolume;
		}
	}
	elseif (preg_match("/\bnotify\b/i", $string))
	{
		// There isn't a JSON call in v4 of the API. Using the HTTP server instead.
		$string = str_replace("xbmc", "", $string);
		$string = trim(str_replace("notify", "", $string));
		file_get_contents(XBMC_SERVER."xbmcCmds/xbmcHttp/?command=ExecBuiltin&parameter=Notification(Alice:,".urlencode($string).")");
		return "Notified XBMC: $string";
	}
	else return alice_error_nocommand();
}
