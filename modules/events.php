<?php
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
	elseif (preg_match("/\baway\b/i", $string))
	{
		sleep(15);
		alice_x10_check("livingroom off");
		sleep(1);
		alice_x10_check("bedroom off");
	}
	elseif (preg_match("/\bhome\b/i", $string))
	{
		if (date('Hi') >= '1930' || date('Hi') <= '0630')
		{
			alice_x10_check("livingroom on");
			sleep(1);
			alice_x10_check("bedroom brighten");
			return "Welcome Back";
		}
	}
	elseif (preg_match("/\bmovie\b/i", $string))
	{
		alice_xbmc_check("notify Heck yeah! Movie time!");
		alice_x10_check("livingroom off");
		sleep(1);
		alice_x10_check("bedroom off");
		return "Enjoy your film";
	}
	else return alice_error_noevent();
}
?>
