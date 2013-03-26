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
function alice_xbmc_isOn()
{
	if(file_get_contents(XBMC_SERVER."jsonrpc")) return true;
	else return false;
}
function alice_xbmc_getPlayer($textual = NULL)
{
	$data = array("jsonrpc" => "2.0", "method" => "Player.GetActivePlayers", "id" => 1);
	if (!$textual) return json_decode(alice_xbmc_talk($data))->result[0]->playerid; // 0=audio, 1=video
	else return json_decode(alice_xbmc_talk($data))->result[0]->type;
}
function alice_xbmc_control($command, $param = NULL)
{
	$player = alice_xbmc_getPlayer();
	
	switch($command)
	{
		case "pause":
			$data = array("jsonrpc" => "2.0", "method" => "Player.PlayPause", "params" => array("playerid" => $player), "id" => 1);
			$xbmc = json_decode(alice_xbmc_talk($data));
			if ($xbmc->result->speed) return "XBMC Playing";
			else return "XBMC Paused";
			break;
		
		case "rewind":
			$data = array("jsonrpc" => "2.0", "method" => "Player.Seek", "params" => array("playerid" => $player, "value" => "smallbackward"), "id" => 1);
			$xbmc = json_decode(alice_xbmc_talk($data));
			return "XBMC Skipped Backward";
			break;
		
		case "forward":
			$data = array("jsonrpc" => "2.0", "method" => "Player.Seek", "params" => array("playerid" => $player, "value" => "smallforward"), "id" => 1);
			$xbmc = json_decode(alice_xbmc_talk($data));
			return "XBMC Skipped Forward";
			break;
		
		case "stop":
			$data = array("jsonrpc" => "2.0", "method" => "Player.Stop", "params" => array("playerid" => $player), "id" => 1);
			$xbmc = json_decode(alice_xbmc_talk($data));
			return "XBMC Stopped";
			break;
		case "mute":
			$data = array("jsonrpc" => "2.0", "method" => "Application.SetMute", "params" => array("mute" => "toggle"), "id" => 1);
			$xbmc = json_decode(alice_xbmc_talk($data));
			if ($xbmc->result) return "XBMC Muted";
			else return "XBMC Unmuted";
			break;
		case "volumeup":
			$data = array("jsonrpc" => "2.0", "method" => "Application.GetProperties", "params" => array("properties" => array("volume")), "id" => 1);
			$xbmc = json_decode(alice_xbmc_talk($data));
			$newvolume = ($xbmc->result->volume)+5;
			$data = array("jsonrpc" => "2.0", "method" => "Application.SetVolume", "params" => array("volume" => $newvolume), "id" => 1);
			alice_xbmc_talk($data);
			return "XBMC volume increased to ".$newvolume;
			break;
		case "volumedown":
			$data = array("jsonrpc" => "2.0", "method" => "Application.GetProperties", "params" => array("properties" => array("volume")), "id" => 1);
			$xbmc = json_decode(alice_xbmc_talk($data));
			$newvolume = ($xbmc->result->volume)-5;
			$data = array("jsonrpc" => "2.0", "method" => "Application.SetVolume", "params" => array("volume" => $newvolume), "id" => 1);
			alice_xbmc_talk($data);
			return "XBMC volume decreased to ".$newvolume;
			break;
		default:
			return -1;
		
	}
}

function alice_xbmc_playing()
{
	$player = alice_xbmc_getPlayer(1);
	if ($player == "audio")
	{
		$data = array("jsonrpc" => "2.0", "method" => "Player.GetItem", "params" => array("playerid" => 0, "properties" => array("artist", "title")), "id" => 1);
		$xbmc = json_decode(alice_xbmc_talk($data));
		$timeLeft = alice_xbmc_timeLeft(0);
		return array($xbmc->result->item->artist, $xbmc->result->item->title, $timeLeft);
	}
	elseif($player == "video")
	{
		$data = array("jsonrpc" => "2.0", "method" => "Player.GetItem", "params" => array("playerid" => 1, "properties" => array("showtitle", "title")), "id" => 1);
		$xbmc = json_decode(alice_xbmc_talk($data));
		$timeLeft = alice_xbmc_timeLeft(1);
		return array($xbmc->result->item->showtitle, $xbmc->result->item->title, $timeLeft);

	}
	else return false;
}
function alice_xbmc_timeLeft($playerid)
{
	$data = array("jsonrpc" => "2.0", "method" => "Player.GetProperties", "params" => array("playerid" => $playerid, "properties" => array("percentage")), "id" => 1);
	$timeLeft = json_decode(alice_xbmc_talk($data));
	return intval($timeLeft->result->percentage);
}
function alice_xbmc_notify($msg)
{
	$data = array("jsonrpc" => "2.0", "method" => "GUI.ShowNotification", "params" => array("title" => "Alice:", "message" => $msg));
	alice_xbmc_talk($data);
	return "Notified XBMC: $msg";
}
function alice_xbmc_quit()
{
	$data = array("jsonrpc" => "2.0", "method" => "Application.Quit", "id" => 1);
	alice_xbmc_talk($data);
	return "XBMC has quit";
}
function alice_xbmc_playFilm($id)
{
	$data = array("jsonrpc" => "2.0", "method" => "Player.Open", "params" => array("item" => array("movieid" => intval($id))), "id" => 1);
	$jsonReturn = json_decode(ealice_xbmc_talk($data));
	if($jsonReturn->error) return false;
	else return true;
}
function alice_xbmc_playEpisode($id)
{
	$data = array("jsonrpc" => "2.0", "method" => "Player.Open", "params" => array("item" => array("episodeid" => intval($id))), "id" => 1);
	$jsonReturn = json_decode(ealice_xbmc_talk($data));
	if($jsonReturn->error) return false;
	else return true;
}
function alice_xbmc_getAllFilms()
{
	$data = array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetMovies", "params" => array("sort" => array("order" => "ascending", "method" => "label", "ignorearticle" => true), "properties" => array("tagline", "plot", "year", "mpaa", "runtime", "thumbnail", "genre")), "id" => 1);
	$xbmc = json_decode(alice_xbmc_talk($data));
	return $xbmc->result->movies;
}
function alice_xbmc_getSingleFilm($film)
{
	$data = array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetMovieDetails", "params" => array("movieid" => intval($film), "properties" => array("tagline", "plot", "year", "mpaa", "runtime", "thumbnail", "genre", "imdbnumber")), "id" => 1);
	$xbmc = json_decode(alice_xbmc_talk($data));
	return $xbmc->result->moviedetails;
}
function alice_xbmc_getAllShows()
{
	$data = array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetTVShows", "params" => array("sort" => array("order" => "ascending", "method" => "label", "ignorearticle" => true), "properties" => array("plot", "year", "mpaa", "thumbnail", "genre")), "id" => 1);
	$xbmc = json_decode(alice_xbmc_talk($data));
	return $xbmc->result->tvshows;
}

function alice_xbmc_getSingleShow($show)
{
	$data = array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetTVShowDetails", "params" => array("tvshowid" => intval($show), "properties" => array("plot", "year", "mpaa", "thumbnail", "fanart", "genre")), "id" => 1);
	$xbmc = json_decode(alice_xbmc_talk($data));
	return $xbmc->result->tvshowdetails;
}

function alice_xbmc_getAllEpisodesOfShow($show)
{
	$data = array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetEpisodes", "params" => array("sort" => array("order" => "ascending", "method" => "label", "ignorearticle" => true),"tvshowid" => intval($show), "properties" => array("title", "episode", "season", "playcount")), "id" => 1);
	$xbmc = json_decode(alice_xbmc_talk($data));
	return $xbmc->result->episodes;
}
function alice_xbmc_getFirstUnwatchedEpisode($show)
{
	$arrayEpisodes = alice_xbmc_getAllEpisodesOfShow($show);
	foreach($arrayEpisodes as $episode)
	{
		if($episode->playcount < 1)
		{
			$nextShowID = $episode->episodeid;
			$nextShowTitle = $episode->title;
			break;
		}
	}
	return array("title" => $nextShowTitle, "id" => $nextShowID);
}
function alice_xbmc_getLatestEpisode($show)
{
	$arrayEpisodes = alice_xbmc_getAllEpisodesOfShow($show);
	foreach ($arrayEpisodes as $episode)
	{
		$lastShowID = $episode->episodeid;
		$lastShowTitle = $episode->title;
	}
	return array("title" => $lastShowTitle, "id" => $lastShowID);
}