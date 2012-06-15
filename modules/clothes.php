<?php
/*
NAME:         Clothes
ABOUT:        Returns data about what type of clothes to wear for the day
DEPENDENCIES: Location module; Weather module;
*/
function alice_clothes($string = "here") {
	if (alice_loc_check($string)) $loc = alice_loc_get($string);
	else $loc = alice_loc_get("here");
	$weather = alice_weather_get($loc['zip']);
	$hi = $weather['hiTemp'];

	// top
	if ($hi >= 60) $top = "just a tshirt";
	else $top = "a hoodie";
	
	// bottom
	if ($hi >= 60) $bottom = "shorts";
	elseif ($hi >= 45) $bottom = "cargo shorts";
	else $bottom = "blue jeans";
	
	// other items?
	if (alice_rain_check($loc['zip'])) $extra = "an umbrella or rain jacket because it may rain";
	
	return array("city"=>$loc['city'], "top"=>$top, "bottom"=>$bottom, "hi"=>$hi, "extra"=>$extra);
}
?>
