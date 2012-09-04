<?php
error_reporting(0); 

/* GENERAL SETTINGS */
define("NAME", "Bob");		// The name you wish to be referenced by in correspondence (emails, tweets, etc.)
define("EMAIL", "bob@bob.com");	// Where we should be sending you emails
define("DISPLAYNOTICES", TRUE); // Whether or not API information notices should be displayed. Your keys could be revoked if off

/* RECIPE: NZB */
define("SABNZBD_SERVER", "http://localhost:8080/sabnzbd/");	// Location of your SABnzbd setup (default is shown)
define("SABNZBD_API", ""); 					// Found in Config > General > SABnzbd Web Server > API Key

/* MODULE: Transmission */
define("TRANSMISSION_SERVER", "http://localhost:9091/transmission/rpc");	// Location of Transmission (default is shown)
define("TRANSMISSION_USER", NULL);						// Username. Use NULL if you haven't set one
define("TRANSMISSION_PASS", NULL);						// Password. Use NULL if you haven't set one
define("TRANSMISSION_DOWNLOAD", "/home/bob/Downloads");				// Where the files should be downloaded to

/* MODULE: Email */
define("IMAP_SERVER", "{mail.bob.com:993/imap/ssl/novalidate-cert}INBOX");	// In a PHP readable format
define("IMAP_USER", "bob");							// IMAP Username
define("IMAP_PASS", "bobandalice");						// IMAP Password
define("SMTP_SERVER", "mail.bob.com");						// SMTP Server
define("SMTP_PORT", 465);							// SSL port of server
define("SMTP_USER", "bob");							// SMTP Username
define("SMTP_PASS", "bobandalice");						// SMTP 
define("SMTP_FROM", "alice@bob.com");						// Where should it look like it's come from

/* MODULE: Location */
define("LOCATION_LOOKUP", "here");		// Set your physical location using a zipcode. Can also be set to "here" which will cause your location to be determined by Google Latitude
define("LATITUDE_API", "1234567890123467890");	// Can grab your user ID @ https://www.google.com/latitude/b/0/apps (Must enable Google Public Location Badge)

/* MODULE: Weather */
define("WUNDERGROUND_API", "123abc");	// Free API key available @ http://api.wunderground.com/api/

/* MODULE: XBMC */
define("XBMC_SERVER", "http://localhost:8090/");	// Where the server is set up. Used for both HTTP and jsonRPC (default is shown)
define("RTOMATOES_API", "123abc");			// Your RottenTomatoes api key. Used to get RT's freshness and blurb

/* ALICE SETTINGS */
define("PATH", "/var/www/alice/");						// Root directory of install

/* THAT'S IT! Don't edit anything below this line */
foreach (glob(PATH."modules/*.php") as $includes) require_once($includes);
require_once(PATH."lib/smarty/Smarty.class.php");
$smarty = new Smarty;
$smarty->left_delimiter = '{{';
$smarty->right_delimiter = '}}';
$smarty->setTemplateDir(PATH."inc/templates/");
$smarty->setCompileDir(PATH."inc/templates_c/");
$smarty->assign("dispLicense", DISPLAYNOTICES); 
