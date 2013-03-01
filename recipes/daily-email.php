<?php
/*
NAME:         Daily mail
ABOUT:        Sends an email each morning with general information about the day
DEPENDENCIES: Location module; Weather module; Email module; Clothes module;
INSTALL:      None;
CONFIG:       Edit the dailyEmail.tpl file in inc/templates_C folder to your liking.
*/
$dailyEmail = false;
if (date('Hi') == '0700' && ((date('N') == '2') || (date('N') == '4')) ) $dailyEmail = true; // TTh @ 7
elseif (date('Hi') == '1100' && ((date('N') == '1') || (date('N') == '3') || (date('N') == '5')) ) $dailyEmail = true; // MWF @ 11
elseif (date('Hi') == '1200' && ((date('N') == '6') || (date('N') == '7')) ) $dailyEmail = true; //SS @ noon

if ($dailyEmail)
{
	$arrayNews = alice_news(4);
	foreach($arrayNews as $newsItem)
	{
		$news .= "<a href='{$newsItem->link}'>{$newsItem->title}</a> - {$newsItem->description}<br />";
	}
	$history = explode("|", file_get_contents("http://jacroe.com/projects/today/api.php"));		// This is another projet of mine that lists things about today. 



	$smarty->assign("date", date('l, F j, Y '));
	$smarty->assign("city", $l['city']);
	$smarty->assign("state", $l['state']);
	$smarty->assign("weather", $w);
	$smarty->assign("clothes", alice_clothes($w));
	$smarty->assign("news", $news);
	$smarty->assign("history", $history);

	$rawBody = $smarty->fetch('dailyEmail.tpl');
	$lines = explode("\n", $rawBody);
	$subject = trim(array_shift($lines));
	$body = join("\n", $lines);

	alice_email_send(NAME, EMAIL, $subject, $body);
	sleep(30);
}

?>
