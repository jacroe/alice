ALICE: Alice Listens Intently and Catches English
=================================================

ALICE monitors email, the weather, turns lights on and off, add torents placed in a dropbox folder (or any folder really) and can even tell you what clothes you should wear outside. All is done in pure PHP with a few web services and PHP libraries to help along the way.

Setting up
----------

1.	Make a copy of <tt>alice.sample.php</tt> and rename it to <tt>alice.php</tt>.
2. 	Get access to a MySQL database. Alice does not need to have a database by itself; any one will do. Execute the SQL code in <tt>alice.sql</tt>; this creates two tables, a_modules and a_recipes, and fills in some default values. 
3.	Open <tt>alice.php</tt> in your favorite text editor and change all variables. An explanation of each is provided. For some items (RottenTomatoes, WUnderground) to work, you'll need to register for an API key. Don't worry; all the APIs used are free.<br />
	The variables listed under General, MySQL, Email, Location, Weather, and XBMC are necessary for Alice to work properly. 
4.	If you use X10, you'll need to first be able to control your modules from your command line before you can control your home from Alice. This guide does not go into detail on how to do that. After you have it set up, however, you may edit <tt>modules/x10.php</tt> and change the commands there to match the ones you use (Alice just passes the command through PHP's <code>exec</code> function.). You should also check out <tt>modules/events.php</tt>. There you can add your modules to the events list. This way, you can push the "Lights off" button on the Alice's home page, and it will turn out all your lights. I recommend adding a <code>sleep</code> command after each X10 call.
5.	Create the directory <tt>templates_c/</tt> in the <tt>inc/</tt> and make sure it's writable by the web server.
6.	Open a web browser and go to the location of Alice. Run the page <tt>cron.php?purge=yes</tt>. This will update the database and you should now see some nice content being displayed with Alice. You can purge this data at any time by clicking "Purge" at the bottom of every page.
7.	OPTIONAL: Set up a cron job to execute <tt>cron.php</tt> every minute. This will run through all the recipes in your <tt>recipes/</tt> directory. It also updates your database (and only uses your API calls) every 10th minute.
8.	That's it! Enjoy!

Acknowledgements
----------------

Alice takes advantage of several programs/websites to be useful.
*	Google Latitude
*	WUnderground
*	XBMC
*	Rotten Tomatoes
*	X10
*	SABnzbd+
*	Transmission (soon to be Deluge as well)

The following libraries/utilities have helped Alice become a reality.
*	Bootstrap from Twitter. <http://getbootstrap.com>
*	Smarty Template Engine <http://smarty.net>
*	SwiftMailer <http://swiftmailer.org>
*	Transmission PHP class <https://github.com/johan-adriaans/PHP-Transmission-Class>
*	Weather Icon Pack <http://www.mpetroff.net/archives/2012/09/14/kindle-weather-display/>

I'd also like to thank Marvel and the film <em>Iron Man</em> for giving us the idea of Jarvis, and Chad Barraford for giving us the idea of our own personal Jarvis.
