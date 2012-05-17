<?php
function alice_loc_check($string)
{ 
	if(preg_match('/\(? (\d\d\d\d\d)/x', $string, $matches)) return true;
	elseif (preg_match("/\bhere\b/i", $string)) return true;
	else return false;
}
function alice_loc_get($string)
{
	if (preg_match('/\(? (\d\d\d\d\d)/x', $string, $matches))
	{
		$loc = $matches[0];
	}
	elseif (preg_match("/\bhere\b/i", $string))
	{
		$latitude = LATITUDE_API;
		$latitude = file_get_contents("http://www.google.com/latitude/apps/badge/api?user=$latitude&type=atom");
		$page = strstr($latitude, '<summary>Current Location</summary>');
		$table_start = strpos($page, '<georss:point>');
		$table_end = strpos($page, '</georss:point>');
		$latlong = substr($page, $table_start, $table_end - $table_start);
		$latlong = str_replace(' ', ',', $latlong);
		$latlong = str_replace('<georss:point>', '', $latlong);
		$loc = $latlong;
	}
	$mapdata = simplexml_load_file("http://api.wunderground.com/api/".WUNDERGROUND_API."/geolookup/q/$loc.xml");
	
	$city = $mapdata->xpath('/response/location/city');
	$state = $mapdata->xpath('/response/location/state');
	$zip = $mapdata->xpath('/response/location/zip');
	$lat = $mapdata->xpath('/response/location/lat');
	$long = $mapdata->xpath('/response/location/lon');
	$tz = $mapdata->xpath('/response/location/tz_long');
	$tz_short = $mapdata->xpath('/response/location/tz_short');
	return array("city"=>$city[0],"state"=>$state[0],"zip"=>$zip[0],"lat"=>$lat[0],"long"=>$long[0],"tz"=>$tz[0],"tz_short"=>$tz_short[0]);
}
function alice_loc_travel($from, $to, $mode = "driving") 
{
	$travel = simplexml_load_file("http://maps.googleapis.com/maps/api/distancematrix/xml?origins=$from&destinations=$to&mode=$mode&language=en-US&sensor=false&units=imperial");
	$time = $travel->xpath('/DistanceMatrixResponse/row/element/duration/text');
	$dist = $travel->xpath('/DistanceMatrixResponse/row/element/distance/text');
	return array("time"=>$time[0], "dist"=>$dist[0]);
}
?>
