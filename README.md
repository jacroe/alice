ALICE: Alice Listens Intently and Catches English
=================================================

ALICE monitors email, the weather, turns lights on and off, add torents placed in a dropbox folder (or any folder really) and can even tell you what clothes you should wear outside. All is done in pure PHP with a few web services and PHP libraries to help along the way.

Setting up
----------

1.	Make a copy of <tt>alice.sample.php</tt> and rename it to <tt>alice.php</tt>.
2. 	Get access to a MySQL database. Alice does not need to have a whole database by itself; any one will do. Execute the SQL code in <tt>alice.sql</tt>; this creates three tables, a_modules, a_recipes, and a_images.
3.	Open <tt>alice.php</tt> in your favorite text editor and change all variables. An explanation of each is provided. For some items (RottenTomatoes, WUnderground) to work, you'll need to register for an API key. Don't worry; all the APIs used are free.<br />
	The variables listed under General, MySQL, Email, Location, Weather, and XBMC are necessary for Alice to work properly.
4.	If you use X10, you'll need to first be able to control your modules from your command line before you can control your home from Alice. This guide does not go into detail on how to do that. After you have it set up, however, you may edit <tt>modules/x10.php</tt> and change the commands there to match the ones you use (Alice just passes the command through PHP's <code>exec</code> function.).
5.	Create the directory <tt>templates_c/</tt> in the <tt>inc/</tt> and make sure it's writable by the web server.
6.	Comment out the `foreach` line on <tt>cron.php</tt> until you are able to review each of the recipes and edit them to your liking. Otherwise, you may have things done to your system you don't want.
7.	Open a web browser and go to the location of Alice. Run the page <tt>cron.php?purge=index</tt>. This will update the database and you should now see some nice content being displayed with Alice. You can purge this data at any time by clicking "Purge" at the bottom of every page.
8.	OPTIONAL: Set up a cron job to execute <tt>cron.php</tt> every minute. This will run through all the recipes in your <tt>recipes/</tt> directory. It also updates your database (and only use your API calls) every 10th minute.
9.	That's it! Enjoy!

Acknowledgements
----------------

Alice takes advantage of several programs/websites to be useful.
*	Google Latitude
*	WUnderground
*	XBMC
*	Rotten Tomatoes
*	USA Today
*	X10
*	SABnzbd+
*	The Transmission and Deluge BitTorrent clients

The following libraries/utilities have helped Alice become a reality.
*	Bootstrap from Twitter. <http://getbootstrap.com> Apache License v2.0
*	Smarty Template Engine <http://smarty.net> LGPL v3
*	SwiftMailer <http://swiftmailer.org> LGPL v3
*	Transmission PHP class <https://github.com/johan-adriaans/PHP-Transmission-Class> GPL v3
*	Weather Icon Pack <http://www.mpetroff.net/archives/2012/09/14/kindle-weather-display/> Public Domain

I'd also like to thank Marvel and the film <em>Iron Man</em> for giving us the idea of Jarvis, and Chad Barraford for giving us the idea of our own personal Jarvis.
