<?php
/*
NAME:         Weather
ABOUT:        Gets the current weather, forecast and and other conditions. Provides URLs to radar and satellite images
DEPENDENCIES: Location data;
*/
function alice_weather_get($loc)
{
	$jsonWeather = json_decode(file_get_contents("http://api.wunderground.com/api/a4c596e84409cbde/conditions/forecast/alerts/q/{$loc['zip']}.json"));
	$icon = alice_weather_getIcon($jsonWeather->current_observation->icon);
	if ($jsonWeather->response->features->alerts)
		foreach($jsonWeather->alerts as $alert)
		{
			$message = str_replace("\n", "<br />", trim($alert->message));
			$alertData .= "{$alert->description}|{$alert->date}|{$alert->expires}|$message\n";
		}
	return array("currTemp"=>"{$jsonWeather->current_observation->temp_f}",
	"currCond"=>"{$jsonWeather->current_observation->weather}",
	"currWind" => "{$jsonWeather->current_observation->wind_string}",
	"currHumidity" => "{$jsonWeather->current_observation->relative_humidity}",
	"hiTemp"=>"{$jsonWeather->forecast->simpleforecast->forecastday[0]->high->fahrenheit}", 
	"loTemp"=>"{$jsonWeather->forecast->simpleforecast->forecastday[0]->low->fahrenheit}",
	"fcastToday"=>"{$jsonWeather->forecast->txt_forecast->forecastday[0]->fcttext}",
	"fcastTonight"=>"{$jsonWeather->forecast->txt_forecast->forecastday[1]->fcttext}",
	"fcastTomorrow"=>"{$jsonWeather->forecast->txt_forecast->forecastday[2]->fcttext}",
	"fcastTomorrowNight"=>"{$jsonWeather->forecast->txt_forecast->forecastday[3]->fcttext}",
	"fcastNextday"=>"{$jsonWeather->forecast->txt_forecast->forecastday[4]->fcttext}",
	"fcastNextdayNight"=>"{$jsonWeather->forecast->txt_forecast->forecastday[5]->fcttext}",
	"alerts"=>$alertData,
	"icon"=>$icon);
}
function alice_weather_getRadar($loc)
{
	
	return file_get_contents("http://api.wunderground.com/api/".WUNDERGROUND_API."/animatedradar/q/{$loc['state']}/{$loc['city']}.gif?newmaps=1&timelabel=1&timelabel.y=10&num=8&delay=50");

}
function alice_weather_getSatellite($loc)
{
	
	return file_get_contents("http://api.wunderground.com/api/".WUNDERGROUND_API."/animatedsatellite/q/{$loc['state']}/{$loc['city']}.gif?borders=1&basemap=1&timelabel=1&timelabel.y=10&num=8&delay=50");

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
