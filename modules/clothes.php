<?php
/*
NAME:         Clothes
ABOUT:        Returns data about what type of clothes to wear for the day
DEPENDENCIES: None directly. The weather array stored in data.php must be passed to it. 
*/
function alice_clothes($weather) {
	
	$hi = $weather['hiTemp'];
	$forecast = $weather['fcastTod'];

	// top
	if ($hi >= 60) $top = "just a tshirt";
	else $top = "a hoodie";
	
	// bottom
	if ($hi >= 60) $bottom = "shorts";
	elseif ($hi >= 45) $bottom = "cargo shorts";
	else $bottom = "blue jeans";
	
	// other items?
	if ((preg_match("/\brain\b/i", $forecast)) || (preg_match("/\bthunder\b/i", $forecast)) || (preg_match("/\bThunderstorm\b/i", $forecast)) || (preg_match("/\bshower\b/i", $forecast)) || (preg_match("/\bstorm\b/i", $forecast)) || (preg_match("/\bdrizzle\b/i", $forecast))) $extra = "an umbrella or rain jacket because it may rain";
	
	return array("top"=>$top, "bottom"=>$bottom, "hi"=>$hi, "extra"=>$extra);
}
?>
