<?php
/*
NAME:         Email
ABOUT:        Checks for, sends, and organizes email
DEPENDENCIES: Swift library;
*/

$serviceList[] = alice_email_status();

function alice_email_status()
{
	$lData = alice_mysql_get("modules", "email");

	if($lData["status"])
	{
		$sMessage = "Mail man's running.";
		$sStatus = "0";
	}
	else
	{
		$sMessage = "Postal holiday.";
		$sStatus = "2";
	}

	return array("title"=>"Email", "message"=>$sMessage, "status"=>$sStatus);
}


function alice_email_openServer()
{
	if($con = imap_open(IMAP_SERVER, IMAP_USER, IMAP_PASS))
		alice_mysql_put("modules", "email", array("status"=>"1"));
	else
	{
		alice_mysql_put("modules", "email", array("status"=>"0"));
		alice_error_add("Email module", "Couldn't open IMAP connection");
	}
	return $con;
}
function alice_email_closeServer(&$con)
{
	imap_expunge($con);
	imap_close($con);
}
function alice_email_check($meta = "sentence")
{
	$mbox = alice_email_openserver();
	if(!$mbox)
		return -1;
	$check = imap_mailboxmsginfo($mbox); 
	imap_close($mbox);
	$count = $check->Unread;
	if ($meta == "sentence")
	{
		if ($count == 1) return "You have 1 unread message.";
		elseif ($count == 0) return "You're all good! No new messages.";
		else return "You have ".$count." unread messages.";
	}
	elseif ($meta == "num") return $count;
}
function alice_email_send($user, $email, $subject, $body, $attachment = NULL)
{
	require_once PATH.'lib/swift/swift_required.php';
	$transport = Swift_SmtpTransport::newInstance(SMTP_SERVER, SMTP_PORT, 'ssl')
	  ->setUsername(SMTP_USER)
	  ->setPassword(SMTP_PASS);
	$mailer = Swift_Mailer::newInstance($transport);
	$message = Swift_Message::newInstance('(no subject)')
	  ->setFrom(array(SMTP_FROM => 'Alice'))
	  ->setTo(array($email => $user))
	  ->setSubject($subject)
	  ->setBody($body.'<br /><br />
Love, Alice', 'text/html');
	if ($attachment) $message->attach(Swift_Attachment::fromPath($attachment));
	$result = $mailer->send($message);
}
function alice_email_getAllMessages(&$con)
{
	$MC = imap_check($con);
	$result = imap_fetch_overview($con,"1:{$MC->Nmsgs}",0);
	foreach($result as $msg)
	{
		$array[] = array("id"=>$msg->msgno,
		"from"=>$msg->from,
		"to"=>$msg->to,
		"subject"=>$msg->subject,
		"date"=>$msg->date,
		"seen"=>$msg->seen,
		"body"=>imap_fetchbody($con, $msg->msgno, "1", FT_PEEK)
		);
	}
	return $array;
}
function alice_email_move(&$con, $msgno, $folder = "INBOX.Archives", $read = 0)
{
	if($read) imap_setflag_full($con, $msgno, "\\Seen");
	imap_mail_move($con, $msgno, $folder);
}
function alice_email_delete(&$con, $msgno)
{
	imap_setflag_full($con, $msgno, "\\Seen");
	imap_mail_move($con, $msgno, "INBOX.Trash");
}

