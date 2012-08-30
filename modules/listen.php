<?php
/*
NAME:         Listening
ABOUT:        Main logic of Alice. Each command is routed through here and then ran
DEPENDENCIES: All modules and their requried libraries.
*/
function alice_check_command($string)
{
	if (preg_match("/\bxbmc\b/i", $string))
	{
		return alice_xbmc_check($string);
	}
	elseif (preg_match("/\bweather\b/i", $string))
	{
		if (alice_loc_check($string))
		{
			$loc = alice_loc_get($string);
			$weather = alice_weather_get($loc['zip']);
			return "Right now it's ".$weather['currTemp']." and ".$weather['currCond'].". The forecast for today calls for ".$weather['fcastTod'].". The high is ".$weather['hiTemp']."F and the low is ".$weather['loTemp']."F.";
		}
		else return alice_error_noloc();
	}
	elseif (preg_match("/\bemail\b/i", $string))
	{
		return alice_email_check();
	}
	elseif (preg_match("/\bturn\b/i", $string) || preg_match("/\bbrighten\b/i", $string) || preg_match("/\bdim\b/i", $string))
	{
		if (alice_x10_check($string)) return "The command succeeded.";
		else return "The command did not execute.";
	}
	elseif (preg_match("/\bip\b/i", $string))
	{
		$ip = alice_ip_get();
		return "<a href=http://$ip>$ip</a>";
	}
	elseif (preg_match("/\bclothes\b/i", $string))
	{
		$clothes = alice_clothes($string);
		$return = "For right now in ".$clothes['city'].", you should wear ".$clothes['top']." and ".$clothes['bottom']." as the high today will be ".$clothes['hi']."F.";
		if ($clothes['extra']) $return .= " You should also consider ".$clothes['extra'].". Just in case.";
		return $return;
	}
	elseif (preg_match("/\bwhere am i\b/i", $string))
	{
		$loc = alice_loc_get("here");
		return "According to Google Latitude, you are in ".$loc['city'].", ".$loc['state'].".";
	}
	elseif (preg_match("/\btravel\b/i", $string))
	{
		if (!alice_loc_check($string)) return alice_error_noloc();
		$from = alice_loc_get("here");
		$to = alice_loc_get($string);
		$weather = alice_weather_get($to['city'].', '.$to['state']);
		$travel = alice_loc_travel($from['lat'].','.$from['long'], $to['zip']);
		return "It's {$travel['dist']} from {$from['city']} to {$to['city']} or roughly {$travel['time']}. In {$to['city']}, it's {$weather['currTemp']}F and {$weather['currCond']}.";
	}
	elseif (preg_match("/\bevent\b/i", $string))
	{
		return alice_events($string);
	}
	else return alice_error_nocommand();
}

function alice_cleanup($string)
{
	$string = " ".strtolower($string)." ";
	$punct_to_remove = array(",", ".", "?", "'", "\"", "!");
	$string = str_replace($punct_to_remove, "", $string);
	$words_to_remove = array(" to ", " a ", " an ", " for ", " the ", " hey ", " you ", " please ", " like ", " is ", " my ", " what ", " i ", " have ", " do ", " me ", " alice ");
	$string = str_replace($words_to_remove, " ", $string);
	$string = trim($string);
	return $string;
}
?>
