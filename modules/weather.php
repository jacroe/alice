<?php
/*
NAME:         Weather
ABOUT:        Gets the current weather, forecast and returns sunrise/sunset times
DEPENDENCIES: Location module;
*/
function alice_weather_get($loc)
{
	$jsonWeather = json_decode(file_get_contents("http://api.wunderground.com/api/".WUNDERGROUND_API."/conditions/forecast/q/{$loc['zip']}.json"));
	$icon = alice_weather_getIcon($jsonWeather->current_observation->icon);
	return array("currTemp"=>"{$jsonWeather->current_observation->temp_f}",
	"currCond"=>"{$jsonWeather->current_observation->weather}",
	"currWind" => "{$jsonWeather->current_observation->wind_string}",
	"currHumidity" => "{$jsonWeather->current_observation->relative_humidity}",
	"hiTemp"=>"{$jsonWeather->forecast->simpleforecast->forecastday[0]->high->fahrenheit}", 
	"loTemp"=>"{$jsonWeather->forecast->simpleforecast->forecastday[0]->low->fahrenheit}",
	"fcastToday"=>"{$jsonWeather->forecast->txt_forecast->forecastday[0]->fcttext}",
	"fcastTomorrow"=>"{$jsonWeather->forecast->txt_forecast->forecastday[1]->fcttext}",
	"fcastNextday"=>"{$jsonWeather->forecast->txt_forecast->forecastday[1]->fcttext}",
	"icon"=>$icon);
}
function alice_weather_getRadar($loc)
{
	
	#TODO: Find a way to store this image
	return "http://api.wunderground.com/api/".WUNDERGROUND_API."/animatedradar/q/{$loc['state']}/{$loc['city']}.gif?newmaps=1&timelabel=1&timelabel.y=10&num=8&delay=50";

}
function alice_weather_getSatellite($loc)
{
	
	#TODO: Find a way to store this image
	return "http://api.wunderground.com/api/".WUNDERGROUND_API."/animatedsatellite/q/{$loc['state']}/{$loc['city']}.gif?borders=1&basemap=1&timelabel=1&timelabel.y=10&num=8&delay=50";

}
function alice_weather_getIcon($icon)
{
	switch ($icon)
	{
		case "chanceflurries":
		case "chancesnow":
		case "flurries":
		case "snow":
		return "snow";
		break;
		
		case "chancerain":
		case "rain":
		return "rain";
		break;
		
		case "chancesleet":
		case "sleet":
		return "sleet";
		break;
		
		case "chancetstorms":
		case "tstorms":
		return "tstorms";
		break;
		
		case "cloudy":
		return "cloudy";
		break;
		
		case "mostlycloudy":
		case "partlysunny":
		return "mostlycloudy";
		break;
		
		case "mostlysunny":
		case "partlycloudy":
		return "mostlysunny";
		break;
		
		case "fog":
		case "haze":
		return "fog";
		break;
		
		default:
		return "sunny";
		break;
	}
}
?>
