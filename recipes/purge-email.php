<?php
/*
NAME:         Purging mail
ABOUT:        Does certain actions to an inbox based on rules
DEPENDENCIES: Email module;
INSTALL:      None;
CONFIG:       You'll need to set up your own rules. 
*/
if ((date('i') % 2))
{
	$con = alice_email_openServer();
	
	$messages = alice_email_getAllMessages($con);
	foreach($messages as $msg)
	{
		switch($msg["subject"])
		{
			case "Your Order with Amazon.com":
				alice_email_move($con, $msg["id"], "INBOX.Receipts", 1);
				alice_notification_add("Moved Amazon receipt", "Your Amazon order confirmation was moved.");
				break;
			case "Your Amazon Kindle document is here":
				alice_email_delete($con, $msg["id"]);
				alice_notification_add("Kindle document", "Amazon received the Kindle document.");
				break;
			case "New message from Simple":
				alice_email_move($con, $msg["id"], "INBOX.IMPORTANT");
				alice_notification_add("Simple bank", "Simple sent a new message.");
				break;
		}
		switch($msg["from"])
		{
			case "\"Amazon.com\" <ship-confirm@amazon.com>":
				$tracking = alice_packages($msg["body"]);
				alice_email_move($con, $msg["id"], "INBOX.Reference", 1);
				alice_notification_add("Amazon package shipped", "{$tracking["service"]}: <a href=\"{$tracking["url"]}\" target=_blank>{$tracking["number"]}</a>");
				break;
			case "Eagle Alert - The University of Southern Mississippi <noreply@myschoolcast.com>":
				alice_pushover("Eagle Alert", $msg["subject"], 1);
				alice_notification_add("Eagle Alert", $msg["subject"]);
				alice_email_move($con, $msg["id"], "INBOX.IMPORTANT");
				break;
			case "Tumblr <no-reply@tumblr.com>":
				alice_notification_add("Tumblr", $msg["subject"]);
				alice_email_delete($con, $msg["id"]);
				break;
			case "\"service@paypal.com\" <service@paypal.com>":
				alice_email_move($con, $msg["id"], "INBOX.Receipts", 1);
				alice_notification_add("Moved PayPal receipt", $msg["subject"]);
				break;
			case "Redbox <receipts@tx.redbox.com>":
				alice_email_move($con, $msg["id"], "INBOX.Receipts", 1);
				preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $msg["body"], $matches);
				alice_notification_add("Redbox receipt", "<a href=\"{$matches[0]}\" target=_blank>View receipt</a>");
				break;
		}
		sleep(1);
	}
	
	alice_email_closeServer($con);
}
