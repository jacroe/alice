<?php
/*
NAME:         Daily mail
ABOUT:        Sends an email each morning with general information about the day
DEPENDENCIES: Location module; Weather module; Email module; Clothes module;
*/
if (date('Hi') == '0700')
{
	$smarty->assign("date", date('l, F j, Y '));
	$smarty->assign("city", $dLocation['city']);
	$smarty->assign("state", $dLocation['state']);
	$smarty->assign("weather", $dWeather['fcastFull']);
	$smarty->assign("clothes", alice_clothes($dWeather));

	$body = $smarty->fetch('dailyEmail.tpl');
	$lines = explode("\n", $body);
	$subject = trim(array_shift($lines));
	$body = join("\n", $lines);

	alice_email_send(NAME, EMAIL, $subject, $body);
	sleep(30);
}

?>
