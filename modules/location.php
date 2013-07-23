<?php
/*
NAME:         Location
ABOUT:        Returns data about certain locations. Can look up where a person is based on Google Latitude
DEPENDENCIES: None;
*/

$serviceList[] = alice_loc_status();

function alice_loc_status()
{
	$lData = alice_mysql_get("modules", "location");

	if($lData["status"])
	{
		$sMessage = "I see you.";
		$sStatus = "0";
	}
	else
	{
		$sMessage = "Where'd you go?";
		$sStatus = "2";
	}

	return array("title"=>"Location", "message"=>$sMessage, "status"=>$sStatus);
}

function alice_loc_check($string)
{
	if(preg_match('/\(? (\d\d\d\d\d)/x', $string, $matches)) return true;
	elseif (preg_match("/\bhere\b/i", $string)) return true;
	else return false;
}

function alice_loc_get($string)
{
	/*if (preg_match('/\(? (\d\d\d\d\d)/x', $string, $matches))
	{
		$loc = $matches[0];
	}
	elseif (preg_match("/\bhere\b/i", $string))
	{
		$jsonLatitude = json_decode(file_get_contents("http://www.google.com/latitude/apps/badge/api?user=".LATITUDE_API."&type=json"));
		$loc = "{$jsonLatitude->features[0]->geometry->coordinates[1]},{$jsonLatitude->features[0]->geometry->coordinates[0]}";
		// The API places the longitude before the latitude (at least for the Western hemisphere; can't test Eastern)
	}*/
	$loc = $string;
	$jsonWund = json_decode(file_get_contents("http://api.wunderground.com/api/".WUNDERGROUND_API."/geolookup/q/$loc.json"));

	if($jsonWund->response->error)
	{
		alice_error_add("Location module", "WUnderground geolookup error ".$jsonWund->response->error->description);
		alice_mysql_put("modules", "location", array("status"=>"0"));
		return -1;
	}
	else alice_mysql_put("modules", "location", array("status"=>"1"));
	return array("city"=>$jsonWund->location->city,
	"state"=>$jsonWund->location->state,
	"zip"=>$jsonWund->location->zip,
	"lat"=>$jsonWund->location->lat,
	"long"=>$jsonWund->location->lon,
	"tz"=>$jsonWund->location->tz_long,
	"tz_short"=>$jsonWund->location->tz_short);
}

function alice_loc_travel($from, $to, $mode = "driving")
{
	$from = urlencode($from);
	$to = urlencode($to);
	$jsonTravel = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&mode=$mode&language=en-US&sensor=false&units=imperial"));
	return array("time"=>$jsonTravel->rows[0]->elements[0]->duration->text,
	"dist"=>$jsonTravel->rows[0]->elements[0]->distance->text);
}
?>
