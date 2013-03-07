<?php
require('alice.php');
if ((!(date('i') % 10) || ($_GET['purge'])) && alice_onlineCheck())
{
	$t = time();
	$l = alice_loc_get(LOCATION_LOOKUP);
	$w = alice_weather_get($l);
	$e = alice_email_check('num');

	if($l != -1) alice_mysql_put("modules", "location", $l);
	if($w != -1) alice_mysql_put("modules", "weather", $w);
	if (!(date('i') % 30) || ($_GET['purge'])) alice_mysql_putImage("weather_radar", alice_weather_getRadar($l), "image/gif");
	if (!(date('i') % 30) || ($_GET['purge'])) alice_mysql_putImage("weather_satellite", alice_weather_getSatellite($l), "image/gif");
	alice_mysql_put("modules", "email", array("count"=>$e));
	alice_mysql_put("modules", "update", array("time"=>$t));
}
else
{
	$w = alice_mysql_get("modules", "weather");
	$l = alice_mysql_get("modules", "location");
	$u = alice_mysql_get("modules", "update");
	$e = alice_mysql_get("modules", "email");
}
if ($_GET['purge']) header("Location: {$_GET['purge']}.php");

alice_timer_check();
foreach (glob(PATH.'recipes/*.php') as $recipes) require_once($recipes);
?>
