<?php
/*
NAME:         Clothes
ABOUT:        Returns data about what type of clothes to wear for the day
DEPENDENCIES: None directly. The weather array must be passed to it. 
*/
function alice_clothes($weather)
{
	
	$temp = $weather['currTemp'];
	$hi = $weather['hiTemp'];
	$forecast = $weather['fcastToday'];

	// top
	if ($temp >= 60) $top = "just a tshirt";
	else $top = "a hoodie";
	
	// bottom
	if ($temp >= 60) $bottom = "shorts";
	elseif ($temp >= 45) $bottom = "cargo shorts";
	else $bottom = "blue jeans";
	
	// other items?
	if ((preg_match("/\brain\b/i", $forecast)) || (preg_match("/\bthunder\b/i", $forecast)) || (preg_match("/\bThunderstorm\b/i", $forecast)) || (preg_match("/\bshower\b/i", $forecast)) || (preg_match("/\bstorm\b/i", $forecast)) || (preg_match("/\bdrizzle\b/i", $forecast))) $extra = "an umbrella or rain jacket because it may rain";
	
	return array("top"=>$top, "bottom"=>$bottom, "temp"=>$temp, "hi"=>$hi, "extra"=>$extra);
}
?>
