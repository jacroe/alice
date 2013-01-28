<?php
require "alice.php";

if (time()-$u['time'] > 1200) $errors[] = array("error", "Alice's data is at least 20 minutes old.");

/* Masthead */
if (alice_xbmc_playing())
{
	$nowPlaying = alice_xbmc_playing();
	if ($nowPlaying[0])
	$masthead = "{$nowPlaying[0]} - &ldquo;{$nowPlaying[1]}&rdquo;";
	else $masthead = $nowPlaying[1];
}
elseif ($e['count'])
	if ($e['count'] == 1) $masthead = "{$e['count']} new message";
	else $masthead = "{$e['count']} new messages";
else
{
	$masthead = "{$w['currTemp']}&deg;F - {$w['currCond']} <img src=./inc/images/weather/{$w['icon']}.png width=100 alt='{$w['currCond']}' />";
}

/* Subhead */
if (alice_xbmc_playing())
{
	$subhead = <<<SHEAD
<a class="btn btn-large" onclick='$.post("api.php", { control: "rewind" } );'><i class=icon-backward></i></a>
<a class="btn btn-large btn-primary" onclick='$.post("api.php", { control: "pause" } );'><i class="icon-play icon-white"></i><i class="icon-pause icon-white"></i></a>
<a class="btn btn-large" onclick='$.post("api.php", { control: "stop" } );'><i class=icon-stop></i></a>
<a class="btn btn-large" onclick='$.post("api.php", { control: "forward" } );'><i class=icon-forward></i></a>
<a class="btn btn-large" onclick='$.post("api.php", { control: "volume", param: "up" } );'><i class=icon-volume-up></i></a>
<a class="btn btn-large" onclick='$.post("api.php", { control: "volume", param: "down" } );'><i class=icon-volume-down></i></a>
<a class="btn btn-large" onclick='$.post("api.php", { control: "volume", param: "mute" } );'><i class=icon-volume-off></i></a>
SHEAD;
}

else $subhead = "It is ".date("g:i a");

/* XBMC */
/* Get three most recent films */
if (alice_xbmc_isOn())
{
	$jsonThreeFilms = json_decode(alice_xbmc_talk(array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetRecentlyAddedMovies", "params" => array("limits" => array("end" => 3), "properties" => array("mpaa", "runtime")), "id" => 1)));
	$arrayThreeFilms = $jsonThreeFilms->result->movies;
	$films = "";
	foreach ($arrayThreeFilms as $movie)
	{
		$films .= "<a href=\"xbmc.php?movie={$movie->movieid}\"><strong>{$movie->label}</strong></a> - {$movie->mpaa} - {$movie->runtime} mins<br />\n";
	}
	$smarty->assign("xbmcBody", $films);
}
else $errors[] = array("alert", "XBMC is offline.");

$notifications = alice_mysql_get("modules", "notification", "DESC");
foreach($notifications as $id => $value)
{
	$value = explode("|", $value);
	$notif[] = array("id"=>$id, "title"=>$value[0], "message"=>$value[1]);
}

$smarty->assign("masthead", $masthead);
$smarty->assign("subhead", $subhead);
$smarty->assign("weather", $w);
$smarty->assign("updateTime", date("g:i a", $u['time']));
$smarty->assign("updateCity", $l['city'].', '.$l['state']);
$smarty->assign("notifications", array_slice($notif, 0, 3));
$smarty->assign("error", $errors);
$smarty->display("index.tpl");
?>
