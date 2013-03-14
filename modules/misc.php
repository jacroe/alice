<?php
/*
NAME:         Miscellaneous
ABOUT:        Functions for Alice that are too small to be modules but necessary
DEPENDENCIES: None;
*/
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

function alice_onlineCheck()
{
	if (file_get_contents("http://google.com")) return true;
	else return false;
}

function alice_timeDiff($date)
{
	$now = new DateTime();
	$ref = new DateTime($date);
	$diff = $now->diff($ref);
	return $diff;
}

function alice_error_add($loc, $error)
{
	$log = file_get_contents(PATH."error.log");
	file_put_contents(PATH."error.log", date("Y-m-d H-i-s")."	ERROR at $loc - $error\n", FILE_APPEND);
}
?>
