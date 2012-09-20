<?php
require "alice.php";

/* Masthead */

$masthead = "{$w['currTemp']}&deg;F - {$w['currCond']} <img src=./inc/images/weather/{$w['icon']}.svg width=100 />";

$subhead = $w['fcastFull'];

$smarty->assign("masthead", $masthead);
$smarty->assign("subhead", $subhead);
$smarty->assign("weather", $w);
$smarty->assign("radarimg", alice_weather_getRadar($l));
$smarty->assign("updateTime", $u['time']);
$smarty->assign("updateCity", $l['city'].', '.$l['state']);
$smarty->assign("error", $errors);
$smarty->display("weather.tpl");
?>