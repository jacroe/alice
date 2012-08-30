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
	$smarty->assign("clothes", "I don't even know what to tell you.");

	$body = $smarty->fetch('dailyEmail.tpl');
	$lines = explode("\n", $body);
	$subject = trim(array_shift($lines));
	$body = join("\n", $lines);

	alice_email_send(NAME, EMAIL, $subject, $body);
	sleep(30);
}
/*
if (date('Hi') == '2300')
{
	$date = date('l, F j, Y ');
	$loc = alice_loc_get('here');
	$weather = alice_weather_get($loc['zip']);
	
	$subject = "Nightly email for ".$date;
	$body = <<<EOF
<h1>$date - {$loc['city']}, {$loc['state']}</h1>
<h2>Tomorrow</h2>
Tomorrow's forecast calls for <strong>{$weather['fcastTom']}</strong>.<br />
You'll be waking up <strong>at 7 am</strong>.
<br />
EOF;
	alice_email_send(NAME, EMAIL, $subject, $body);
	sleep(30);
}
*/
?>
