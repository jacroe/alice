<?php
require "alice.php";

if (time()-$u['time'] > 1200) $errors[] = array("danger", "Alice's data is at least 20 minutes old.");

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
<div class="progress progress-striped active"><div class="progress-bar" style="width: {$nowPlaying[2]}%;"><strong>{$nowPlaying[2]}%</strong></div></div>
<a class="btn btn-default" onclick='aliceAPI({"method":"XBMC.Control","params":{"action":"rewind"}});'><span class="glyphicon glyphicon-backward"></span></a>
<a class="btn btn-primary" onclick='aliceAPI({"method":"XBMC.Control","params":{"action":"pause"}});'><span class="glyphicon glyphicon-play"></span><span class="glyphicon glyphicon-pause"></span></a>
<a class="btn btn-default" onclick='aliceAPI({"method":"XBMC.Control","params":{"action":"stop"}});'><span class="glyphicon glyphicon-stop"></span></a>
<a class="btn btn-default" onclick='aliceAPI({"method":"XBMC.Control","params":{"action":"forward"}});'><span class="glyphicon glyphicon-forward"></span></a>
<a class="btn btn-default" onclick='aliceAPI({"method":"XBMC.Control","params":{"action":"volumeup"}});'><span class="glyphicon glyphicon-volume-up"></span></a>
<a class="btn btn-default" onclick='aliceAPI({"method":"XBMC.Control","params":{"action":"volumedown"}});'><span class="glyphicon glyphicon-volume-down"></span></a>
<a class="btn btn-default" onclick='aliceAPI({"method":"XBMC.Control","params":{"action":"mute"}});'><span class="glyphicon glyphicon-volume-off"></span></a>
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
		$films .= "<a href=\"xbmc.php?movie={$movie->movieid}\"><strong>{$movie->label}</strong></a> - {$movie->mpaa} - " . floor($movie->runtime / 60) . " mins<br />\n";
	}
	$smarty->assign("xbmcBody", $films);
}
else $errors[] = array("warning", "XBMC is offline.");

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
$smarty->assign("updateCity", $u["city"]);
$smarty->assign("notifications", array_slice($notif, 0, 3));
$smarty->assign("error", $errors);
$smarty->display("index.tpl");
?>
