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

function alice_timer_remove($timer)
{
	alice_mysql_remove("modules", "timer", array($timer));
}

function alice_timer_check()
{
	$timers = alice_mysql_get("modules", "timer");
	$now = time();
	foreach($timers as $timer => $message)
	{
		if($timer < $now) 
		{
			if (preg_match("/#chime/i", $message)) alice_macro_run("chime");
			alice_pushover("Timer alert", $message, 1);
			alice_xbmc_notify($message);
			alice_timer_remove($timer);
		}
	}
}

function alice_timer_getAll()
{
	$timers = alice_mysql_get("modules", "timer");
	foreach ($timers as $timer => $message)
		$allTimers[] = array("timer"=>$timer, "message"=>$message, "timeLeft"=>alice_timer_timeLeft($timer));

	return $allTimers;
}

function alice_timer_timeLeft($timer)
{
	$diff = alice_timeDiff(date('c', $timer));
	if ($diff->y) $timeLeft = "{$diff->y} years, {$diff->m} months, {$diff->d} days";
	elseif ($diff->m) $timeLeft = "{$diff->m} months {$diff->d} days";
	elseif ($diff->d) $timeLeft = "{$diff->d} days {$diff->h} hours";
	elseif ($diff->h) $timeLeft = "{$diff->h} hours {$diff->i} minutes";
	else $timeLeft = "{$diff->i} minutes {$diff->s} seconds";
	return $timeLeft;
}
?>
