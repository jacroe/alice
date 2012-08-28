<?php
/*
NAME:         Weather
ABOUT:        Gets the current weather, forecast and returns sunrise/sunset times
DEPENDENCIES: Location module;
*/
function alice_weather_get($loc)
{
	if ($loc == "Preston, MS") $loc = "39339";
	$jsonWeather = json_decode(file_get_contents("http://api.wunderground.com/api/".WUNDERGROUND_API."/conditions/forecast/q/$loc.json"));
	return array("currTemp"=>"{$jsonWeather->current_observation->temp_f}",
	"currCond"=>"{$jsonWeather->current_observation->weather}",
	"hiTemp"=>"{$jsonWeather->forecast->simpleforecast->forecastday[0]->high->fahrenheit}", 
	"loTemp"=>"{$jsonWeather->forecast->simpleforecast->forecastday[0]->low->fahrenheit}",
	"fcastTod"=>"{$jsonWeather->forecast->simpleforecast->forecastday[0]->conditions}",
	"fcastTom"=>"{$jsonWeather->forecast->simpleforecast->forecastday[1]->conditions}",
	"fcastFull"=>"{$jsonWeather->forecast->txt_forecast->forecastday[0]->fcttext}");
}

function alice_rain_check($loc = "here")
{
	$loc = alice_loc_get($loc);
	$weather = alice_weather_get($loc['zip']);
	$forecast = $weather['currCond'];

	if ((preg_match("/\brain\b/i", $forecast)) || (preg_match("/\bthunder\b/i", $forecast)) || (preg_match("/\bThunderstorm\b/i", $forecast)) || (preg_match("/\bshower\b/i", $forecast)) || (preg_match("/\bstorm\b/i", $forecast)) || (preg_match("/\bdrizzle\b/i", $forecast))) return true;
	else return false;
}
?>
