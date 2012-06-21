<?php
/*
NAME:         XBMC
ABOUT:        Plays films, tv shows, and controls the playback of XBMC
DEPENDENCIES: None;
*/
function alice_xbmc_talk($data)
{
	$data = json_encode($data);
	$ch = curl_init(XBMC_SERVER."jsonrpc");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
	$result = curl_exec($ch);
	return $result;
}
function alice_xbmc_on()
{
	if(file_get_contents(XBMC_SERVER."jsonrpc"))
	return true;
	else return false;
}
function alice_xbmc_check($string)
{
	$data = array("jsonrpc" => "2.0", "method" => "Player.GetActivePlayers", "id" => 1);
	$player = json_decode(alice_xbmc_talk($data))->result[0]->playerid;
	$playerType = json_decode(alice_xbmc_talk($data))->result[0]->type;
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
	elseif (preg_match("/\bstop\b/i", $string))
	{
		$data = array("jsonrpc" => "2.0", "method" => "Player.Stop", "params" => array("playerid" => $player), "id" => 1);
		$xbmc = json_decode(alice_xbmc_talk($data));
		return "XBMC Stopped";
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
	elseif (preg_match("/\bplaying\b/i", $string))
	{
		if ($playerType == "audio")
		{
			$data = array("jsonrpc" => "2.0", "method" => "Player.GetItem", "params" => array("playerid" => 0, "properties" => array("artist", "title")), "id" => 1);
			$xbmc = json_decode(alice_xbmc_talk($data));
			return array($xbmc->result->item->artist, $xbmc->result->item->title);
		}
		elseif($playerType == "video")
		{
			$data = array("jsonrpc" => "2.0", "method" => "Player.GetItem", "params" => array("playerid" => 1, "properties" => array("showtitle", "title")), "id" => 1);
			$xbmc = json_decode(alice_xbmc_talk($data));
			return array($xbmc->result->item->showtitle, $xbmc->result->item->title);
		
		}
		else return false;
	}
	elseif (preg_match("/\bnotify\b/i", $string))
	{
		// There isn't a JSON call in v4 of the API. Using the HTTP server instead.
		$string = str_replace("xbmc", "", $string);
		$string = trim(str_replace("notify", "", $string));
		file_get_contents(XBMC_SERVER."xbmcCmds/xbmcHttp/?command=ExecBuiltin&parameter=Notification(Alice:,".urlencode($string).")");
		return "Notified XBMC: $string";
	}
	elseif (preg_match("/\bmovie\b/i", $string))
	{
		preg_match('/\d{1,2}/', $string, $match);
		$id = intval($match[0]);
		$data = array("jsonrpc" => "2.0", "method" => "Player.Open", "params" => array("item" => array("movieid" => $id)), "id" => 1);
		alice_xbmc_talk($data);
		alice_events("watch");
	}
	elseif (preg_match("/\bepisode\b/i", $string))
	{
		preg_match('/\d{1,3}/', $string, $match);
		$id = intval($match[0]);
		$data = array("jsonrpc" => "2.0", "method" => "Player.Open", "params" => array("item" => array("episodeid" => $id)), "id" => 1);
		alice_xbmc_talk($data);
		alice_events("watch");
	}
	elseif (preg_match("/\bquit\b/i", $string))
	{
		$data = array("jsonrpc" => "2.0", "method" => "Application.Quit", "id" => 1);
		$xbmc = json_decode(alice_xbmc_talk($data));
		return "XBMC has quit";
	}
	else return alice_error_nocommand();
}

function alice_xbmc_movies() 
{
	$data = array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetMovies", "params" => array("sort" => array("order" => "ascending", "method" => "label", "ignorearticle" => true), "properties" => array("tagline", "plot", "year", "mpaa", "runtime", "thumbnail", "genre")), "id" => 1);
	$xbmc = json_decode(alice_xbmc_talk($data));
	return $xbmc->result->movies;
}

function alice_xbmc_tvshows() 
{
	$data = array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetTVShows", "params" => array("sort" => array("order" => "ascending", "method" => "label", "ignorearticle" => true), "properties" => array("plot", "year", "mpaa", "thumbnail", "genre")), "id" => 1);
	$xbmc = json_decode(alice_xbmc_talk($data));
	return $xbmc->result->tvshows;
}

function alice_xbmc_show($show)
{
	$data = array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetTVShowDetails", "params" => array("tvshowid" => intval($show), "properties" => array("plot", "year", "mpaa", "thumbnail", "fanart", "genre")), "id" => 1);
	$xbmc = json_decode(alice_xbmc_talk($data));
	return $xbmc->result->tvshowdetails;
}

function alice_xbmc_episodes($show)
{
	$data = array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetEpisodes", "params" => array("sort" => array("order" => "ascending", "method" => "label", "ignorearticle" => true),"tvshowid" => intval($show), "properties" => array("title", "episode", "season")), "id" => 1);
	$xbmc = json_decode(alice_xbmc_talk($data));
	return $xbmc->result->episodes;
}
