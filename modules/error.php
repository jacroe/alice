<?php
/*
NAME:         Error messages
ABOUT:        Location for all error messages. 
DEPENDENCIES: None
*/
function alice_error_nodate()
{
	return "I didn't catch that date.".alice_tryagain();
}
function alice_error_noloc()
{
	return "I would love to look that up for you, but I couldn't see where you specified a location. Remember, I can only understand five digit zip codes.".alice_tryagain();
}
function alice_error_x10()
{
	return "I couldn't find a command in that statement.".alice_tryagain();
}
function alice_error_nocommand()
{
	return "I'm sorry, I didn't quite catch that. Did you want me to do something?";
}
function alice_tryagain()
{
	$lines = "Try again?
Try one more time for me.
One more go?";
	$lines = explode("\n", $lines);
	$chosen = $lines[ mt_rand(0, count($lines) - 1) ];
	return " ".trim($chosen);
}
?>
