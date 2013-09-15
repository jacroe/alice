<?php
error_reporting(0);

/* GENERAL SETTINGS */
define("NAME", "Bob");				// The name you wish to be referenced by in correspondence (emails, tweets, etc.)
define("EMAIL", "bob@bob.com");			// Where we should be sending you emails
define("DISPLAYNOTICES", TRUE); 		// Whether or not API information notices should be displayed. Keys could be revoked if off
define("PATH", "/var/www/alice/");		// Root directory of install
define("DROPBOX", "/home/bob/Dropbox/Alice/");	// Location in Dropbox where Alice, or you, can store files that interact with Alice
define("LINKLIGHTSXBMC", TRUE);			// Executes the 'lightson' and 'lightsoff' events in conjunction with XBMC playing or not playing.

/* MODULE: MySQL */
define("MYSQL_SERVER", "localhost");						// MySQL server
define("MYSQL_USER", "root");							// MySQL username
define("MYSQL_PASS", "password");						// MySQL password
define("MYSQL_DB", "alice");							// MySQL Database

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

/* MODULE: Weather */
define("WUNDERGROUND_API", "123abc");	// Free API key available @ http://api.wunderground.com/api/

/* MODULE: XBMC */
define("XBMC_SERVER", "http://localhost:8090/");	// Where the server is set up. Used for both HTTP and jsonRPC (default is shown)
define("RTOMATOES_API", "123abc");			// Your RottenTomatoes api key. Used to get RT's freshness and blurb. Get one at http://developer.rottentomatoes.com/

/* MODULE: Transmission */
define("TRANSMISSION_SERVER", "http://localhost:9091/transmission/rpc");	// Location of Transmission (default is shown)
define("TRANSMISSION_USER", NULL);						// Username. Use NULL if you haven't set one
define("TRANSMISSION_PASS", NULL);						// Password. Use NULL if you haven't set one
define("TRANSMISSION_DOWNLOAD", "/home/bob/Downloads");				// Where the files should be downloaded to

/* MODULE: Deluge */
define("DELUGE_SERVER", "http://localhost:8112/json");				// Location of Deluge's Web json server (default shown)
define("DELUGE_PASS", "password");						// Password set to access web client
define("DELUGE_DOWNLOAD", "/home/bob/Downloads");				// Where the files should be downloaded to

/* MODULE: Pushover */
define("PUSHOVER_APP", "123abc");	// Your local Alice Pushover application. Make one at https://pushover.net/apps/build
define("PUSHOVER_USER", "456def");	// Your Pushover user key. https://pushover.net/

/* MODULE: News */
define("USATODAY_API", "123abc");	// Your USA Today api key. Used to allow getting the news. Get one at http://developer.usatoday.com/

/* RECIPE: NZB */
define("SABNZBD_SERVER", "http://localhost:8080/sabnzbd/");	// Location of your SABnzbd setup (default is shown)
define("SABNZBD_API", ""); 					// Found in Config > General > SABnzbd Web Server > API Key

/* THAT'S IT! Don't edit anything below this line */
foreach (glob(PATH."modules/_*.php") as $includes) require_once($includes); // Load parents first
foreach (glob(PATH."modules/*.php") as $includes) require_once($includes);
require_once(PATH."lib/smarty/Smarty.class.php");
$smarty = new Smarty;
$smarty->left_delimiter = '{{';
$smarty->right_delimiter = '}}';
$smarty->setTemplateDir(PATH."inc/templates/");
$smarty->setCompileDir(PATH."inc/templates_c/");
$smarty->assign("dispLicense", DISPLAYNOTICES);
$w = alice_mysql_get("modules", "weather");
$l = alice_mysql_get("modules", "location");
$u = alice_mysql_get("modules", "update");
$e = alice_mysql_get("modules", "email");
