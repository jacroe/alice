<?php
/*
NAME:         Timer
ABOUT:        Sets timers and sends a Pushover notification when the time has expired.
DEPENDENCIES: MySQL module; Pushover module;
*/
function alice_timer_set($strTime, $message)
{
	$valTime = strtotime($strTime);
	alice_mysql_put("modules", "timer", array($valTime => $message));
	return $valTime;
}

function alice_timer_check()
{
	$timers = alice_mysql_get("modules", "timer");
	$now = time();
	foreach($timers as $timer => $message)
	{
		if($timer < $now) 
		{
			alice_pushover("Timer alert", $message, 1);
			alice_mysql_remove("modules", "timer", array($timer));
		}
	}
}
?>
