<?php
/*
NAME:         Purging mail
ABOUT:        Does certain actions to an inbox based on rules
DEPENDENCIES: Email module;
INSTALL:      None;
CONFIG:       You'll need to set up your own rules. 
*/
if (!(date('i') % 2))
{
	alice_email_purge(NULL, "Your Order with Amazon.com", NULL, "INBOX.Receipts", "Moved Amazon receipt.");
	alice_email_purge(NULL, "Your Amazon Kindle document is here", "\\Seen", "INBOX.Trash", "The Kindle document was received.");
}
