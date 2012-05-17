<?php
function alice_weather_get($loc)
{
	if ($loc == "Preston, MS") $loc = "39339";
	$xml = simplexml_load_file("http://www.google.com/ig/api?weather=$loc");
	$current = $xml->xpath("/xml_api_reply/weather/current_conditions");
	$forecast = $xml->xpath("/xml_api_reply/weather/forecast_conditions");
	
	return array("currTemp"=>$current[0]->temp_f['data'], "currCond"=>$current[0]->condition['data'], "hiTemp"=>$forecast[0]->high['data'], "loTemp"=>$forecast[0]->low['data'], "fcastTod"=>$forecast[0]->condition['data'], "fcastTom"=>$forecast[1]->condition['data']);
}

function alice_rain_check($loc = "here")
{
	$loc = alice_loc_get($loc);
	$weather = alice_weather_get($loc['zip']);
	$forecast = $weather['currCond'];
	
	if ((preg_match("/\brain\b/i", $forecast)) || (preg_match("/\bthunder\b/i", $forecast)) || (preg_match("/\bThunderstorm\b/i", $forecast)) || (preg_match("/\bshower\b/i", $forecast)) || (preg_match("/\bstorm\b/i", $forecast)) || (preg_match("/\bdrizzle\b/i", $forecast))) return true;
	else return false;
}
function alice_sunrise($lat, $long, $tz)
{
	date_default_timezone_set($tz);
	return date_sunrise(time(), SUNFUNCS_RET_STRING, intval($lat), intval($long), 90, date("Z")/3600);
}

function alice_sunset($lat, $long, $tz)
{
	date_default_timezone_set($tz);
	return date_sunset(time(), SUNFUNCS_RET_STRING, intval($lat), intval($long), 90, date("Z")/3600);
}
?>
