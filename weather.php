<?php
require "alice.php";

/* Masthead */

$masthead = "{$w['currTemp']}&deg;F - {$w['currCond']} <img src=./inc/images/weather/{$w['icon']}.png width=100 alt='{$w['currCond']}' />";

$subhead = $w['fcastToday'];

$alerts = explode("\n", trim($w['alerts']));
foreach($alerts as $alert)
{
	$temp = explode("|", $alert);
	$alertArray[] = array('title'=>$temp[0], 'issued'=>$temp[1], 'expires'=>$temp[2], 'message'=>$temp[3]);
}



$smarty->assign("masthead", $masthead);
$smarty->assign("subhead", $subhead);
$smarty->assign("weather", $w);
$smarty->assign("radarimg", "./inc/image.php?i=weather_radar");
$smarty->assign("satimg", "./inc/image.php?i=weather_satellite");
$smarty->assign("nextDay", date('l', strtotime("2 days")));
$smarty->assign("updateTime", $u['time']);
$smarty->assign("updateCity", $l['city'].', '.$l['state']);
$smarty->assign("alerts", $alertArray);
$smarty->assign("error", $errors);
$smarty->display("weather.tpl");
?>
