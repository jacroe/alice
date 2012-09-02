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

?>
