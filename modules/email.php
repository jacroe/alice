<?php
/*
NAME:         Email
ABOUT:        Checks for, sends, and organizes email
DEPENDENCIES: Swift library;
*/
function alice_email_openserver()
{
	return imap_open(IMAP_SERVER, IMAP_USER, IMAP_PASS);
}
function alice_email_check($meta = "sentence")
{
	$mbox = alice_email_openserver();
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
	  ->setBody($body.'<br />
Love, Alice', 'text/html');
	if ($attachment) $message->attach(Swift_Attachment::fromPath($attachment));
	$result = $mailer->send($message);
}
function alice_email_purge($from = NULL, $subject = NULL, $flag = NULL, $move = "INBOX.Reference", $callback = NULL)
{
	$mbox = alice_email_openserver();
	$MC = imap_check($mbox);
	$i=0;
	$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
	foreach ($result as $overview)
	{
		$i++;
		if($overview->from == $from && $from)
		{
			if ($flag) imap_setflag_full($mbox, $i, $flag);
			imap_mail_move($mbox, $i, $move);
			$boolCallback = true;
		}
		if($overview->subject == $subject && $subject)
		{
			if ($flag) imap_setflag_full($mbox, $i, $flag);
			imap_mail_move($mbox, $i, $move);
			$boolCallback = true;
		}
		if($boolCallback && $callback) alice_notification_add("Message purged", $callback);
	}
	imap_expunge($mbox);
	imap_close($mbox);
}
