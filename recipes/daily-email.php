<?php
/*
NAME:         Daily mail
ABOUT:        Sends an email each morning with general information about the day
DEPENDENCIES: Location module; Weather module; Email module; Clothes module;
*/
if (date('Hi') == '0700')
{
	$date = date('l, F j, Y ');
	$loc = alice_loc_get('here');
	$weather = alice_weather_get($loc['zip']);
	$clothes = alice_clothes($string);
	$return = "For right now in ".$clothes['city'].", you should wear ".$clothes['top']." and ".$clothes['bottom']." as the high today will be ".$clothes['hi']."F.";
	if ($clothes['extra']) $return .= " You should also consider ".$extra.". Just in case.";
	$clothes = $return;
	
	$subject = "Daily email for ".$date;
	$body = <<<EOF
<h1>$date - {$loc['city']}, {$loc['state']}</h1>
<h2>Weather</h2>
Right now it's <strong>{$weather['currTemp']}&deg;F and {$weather['currCond']}</strong>. The forecast calls for <strong>{$weather['fcastTod']}</strong>. The high for today is <strong>{$weather['hiTemp']}</strong> and the low is <strong>{$weather['loTemp']}</strong>.
<h2>What you should wear</h2>
$clothes
<br />
<br />
EOF;
	alice_email_send("Jacob", "jacob@jacroe.com", $subject, $body);
	sleep(30);
}
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
	alice_email_send("Jacob", "jacob@jacroe.com", $subject, $body);
	sleep(30);
}

