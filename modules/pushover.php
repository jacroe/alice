<?php
/*
NAME:         Pushover
ABOUT:        Sends notifications to any Pushover enabled device
DEPENDENCIES: None directly. Internet access.
NOTES:        This should never need to be called by the user. Always with a recipe or module.
*/
function alice_pushover($title, $message, $pri = 0)
{
	curl_setopt_array($ch = curl_init(), array(
	CURLOPT_URL => "https://api.pushover.net/1/messages",
	CURLOPT_POSTFIELDS => array(
	  "token" => PUSHOVER_APP,
	  "user" => PUSHOVER_USER,
	  "title" => $title,
	  "message" => $message,
	  "priority" => $pri )));
	$message = curl_exec($ch);
	curl_close($ch);
	if ($message == '{"status":1}') return true;
	else return false;
}
?>
