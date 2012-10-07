<?php
/*
NAME:         Daily mail
ABOUT:        Sends an email each morning with general information about the day
DEPENDENCIES: Location module; Weather module; Email module; Clothes module;
INSTALL:      None;
CONFIG:       Edit the dailyEmail.tpl file in inc/templates_C folder to your liking.
*/
if (date('Hi') == '0700')
{
	$smarty->assign("date", date('l, F j, Y '));
	$smarty->assign("city", $l['city']);
	$smarty->assign("state", $l['state']);
	$smarty->assign("weather", $w['fcastToday']);
	$smarty->assign("clothes", alice_clothes($w));

	$body = $smarty->fetch('dailyEmail.tpl');
	$lines = explode("\n", $body);
	$subject = trim(array_shift($lines));
	$body = join("\n", $lines);

	alice_email_send(NAME, EMAIL, $subject, $body);
	sleep(30);
}

?>
