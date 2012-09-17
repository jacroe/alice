<?php
require('alice.php');
if (!(date('i') % 10) || ($_GET['purge']))
{
	$t = date('g:i a');
	$l = alice_loc_get(LOCATION_LOOKUP);
	$w = alice_weather_get($l['zip']);
	$e = alice_email_check('num');
	$f = <<<FILE
<?php
\$dWeather = array("currTemp"=>round({$w['currTemp']}), "currCond"=>"{$w['currCond']}", "hiTemp"=>round({$w['hiTemp']}), "loTemp"=>round({$w['loTemp']}), "fcastTod"=>"{$w['fcastTod']}", "fcastTom"=>"{$w['fcastTom']}", "fcastFull"=>"{$w['fcastFull']}");
\$dEmailCount = $e;
\$dLocation = array("city"=>"{$l['city']}","state"=>"{$l['state']}","zip"=>{$l['zip']},"lat"=>{$l['lat']}, "long"=>{$l['long']}, "tz"=>"{$l['tz']}","tz_short"=>"{$l['tz_short']}");
\$dUpdated = "$t";
?>
FILE;
	file_put_contents(PATH.'data.php', $f);
	if ($_GET['purge']) header("Location: index.php");
}
require('data.php');
foreach (glob(PATH.'recipes/*.php') as $recipes) require_once($recipes);
?>
