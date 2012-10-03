<?php
require "alice.php";

/* Masthead */

$masthead = "{$w['currTemp']}&deg;F - {$w['currCond']} <img src=./inc/images/weather/{$w['icon']}.png width=100 />";

$subhead = $w['fcastToday'];

$smarty->assign("masthead", $masthead);
$smarty->assign("subhead", $subhead);
$smarty->assign("weather", $w);
$smarty->assign("radarimg", alice_weather_getRadar($l));
$smarty->assign("satimg", alice_weather_getSatellite($l));
$smarty->assign("nextDay", date('l', strtotime("2 days")));
$smarty->assign("updateTime", $u['time']);
$smarty->assign("updateCity", $l['city'].', '.$l['state']);
$smarty->assign("error", $errors);
$smarty->display("weather.tpl");
?>
