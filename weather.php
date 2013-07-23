<?php
require "alice.php";
if (time()-$u['time'] > 1200) $errors[] = array("error", "Alice's data is at least 20 minutes old.");
/* Masthead */

$masthead = "{$w['currTemp']}&deg;F - {$w['currCond']} <img src=./inc/images/weather/{$w['icon']}.png width=100 alt='{$w['currCond']}' />";

$subhead = $w['fcastToday'];
if ($w['alerts'])
{
	$alerts = explode("\n", trim($w['alerts']));
	foreach($alerts as $alert)
	{
		$temp = explode("|", $alert);
		$alertArray[] = array('title'=>$temp[0], 'issued'=>$temp[1], 'expires'=>$temp[2], 'message'=>$temp[3]);
	}
}
else $alertArray = NULL;

$smarty->assign("title", "Weather in {$l['city']}, {$l['state']}");
$smarty->assign("masthead", $masthead);
$smarty->assign("subhead", $subhead);
$smarty->assign("weather", $w);
$smarty->assign("radarimg", "./inc/image.php?i=weather_radar");
$smarty->assign("satimg", "./inc/image.php?i=weather_satellite");
$smarty->assign("nextDay", date('l', strtotime("2 days")));
$smarty->assign("updateTime", date("g:i a", $u['time']));
$smarty->assign("updateCity", $u['city']);
$smarty->assign("alerts", $alertArray);
$smarty->assign("error", $errors);
$smarty->display("weather.tpl");
?>
