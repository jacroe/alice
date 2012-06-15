<?php
/*
NAME:         Events
ABOUT:        Changes the environment based on variables such as time, user desire, etc.
DEPENDENCIES: X10 module; XBMC module; (Varies depending on programmed events)
*/
function alice_events($string)
{
	if (preg_match("/\bsleep\b/i", $string))
	{
		alice_x10_check("livingroom off");
		sleep(1);
		alice_x10_check("bedroom off");
		sleep(3);
		alice_x10_check("bedroom on");
		sleep(30);
		alice_x10_check("bedroom off");
	}
	elseif (preg_match("/\blOff\b/i", $string))
	{
		//sleep(15);
		alice_x10_check("livingroom off");
		sleep(1);
		alice_x10_check("bedroom off");
	}
	elseif (preg_match("/\blOn\b/i", $string))
	{
		alice_x10_check("livingroom on");
		sleep(1);
		alice_x10_check("bedroom brighten");
		return "Welcome Back";
	}
	elseif (preg_match("/\bmovie\b/i", $string))
	{
		alice_xbmc_check("notify Heck yeah! Movie time!");
		alice_x10_check("livingroom off");
		sleep(1);
		alice_x10_check("bedroom off");
		return "Enjoy your film";
	}
	elseif (preg_match("/\breading\b/i", $string))
	{
		alice_x10_check("bedroom off");
		sleep(1);
		alice_x10_check("bedroom on");
		sleep(1);
		alice_x10_check("livingroom off");
		return "Enjoy your book";
	}
	else return alice_error_noevent();
}
?>
