<?php
require('alice.php');
if (!(date('i') % 10) || ($_GET['purge']))
{
	$t = date('g:i a');
	$l = alice_loc_get(LOCATION_LOOKUP);
	$w = alice_weather_get($l);
	$e = alice_email_check('num');
	alice_mysql_put("modules", "weather", $w);
	alice_mysql_put("modules", "location", $l);
	alice_mysql_put("modules", "email", array("count"=>$e));
	alice_mysql_put("modules", "update", array("time"=>$t));
	if ($_GET['purge']) header("Location: index.php");
}
else
{
	$w = alice_mysql_get("modules", "weather");
	$l = alice_mysql_get("modules", "location");
	$u = alice_mysql_get("modules", "update");
	$e = alice_mysql_get("modules", "email");
}
//require('data.php');
foreach (glob(PATH.'recipes/*.php') as $recipes) require_once($recipes);
?>
