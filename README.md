ALICE: Alice Listens Intently and Catches English
=================================================

ALICE monitors email, the weather, turns lights on and off, add torents placed in a dropbox folder (or any folder really) and can even tell you what clothes you should wear outside. All is done in pure PHP with a few web services and PHP libraries to help along the way. 

Setting up
----------

1.	Make a copy of <tt>alice.sample.php</tt> and rename it to <tt>alice.php</tt>.
2.	Open <tt>alice.php</tt> in your favorite text editor and change all variables. An explanation of each is provided. For some items (RottenTomatoes, WUnderground) to work, you'll need to register for an API key. They are all free.<br />
	If you will not use some functionality (e.g., you don't use SABnzbd+), you can leave the defaults. If you don't use it, they will never be called.
3.	If you use X10, you'll need to first be able to control your modules from your command line before you can control your home from Alice. This guide does not go into detail on how to do that. After you have it set up, however, you may edit <tt>modules/x10.php</tt> and change the commands there to match the ones you use (Alice just passes the command through PHP's <code>exec</code> function.). You should also check out <tt>modules/events.php</tt>. There you can add your modules to the events list. This way, you can push the "Lights off" button on the Alice's home page and it will turn out all your lights. I recommend adding a <code>sleep</code> command after each X10 call. 
4.	Make sure the directory is writable by the server. <tt>cron.php</tt> will create a data file aptly named, <tt>data.php</tt>.
5.	Open a web browser and go to the location of Alice. Run the page <tt>cron.php?purge=yes</tt>. This will create the data file and you should also see some nice content now being displayed with Alice. You can purge this data at any time by clicking "Purge" at the bottom of every page. 
6.	Set up a cron job to execute <tt>cron.php</tt> every minute. This will run through all the recipes in your <tt>recipes/</tt> directory. It updates your data file (and only uses your API calls) every 10th minute. 
7.	That's it! Enjoy!

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

I'd also like to thank Marvel and the film <em>Iron Man</em> for giving us the idea of Jarvis, and Chad Barraford for giving us the idea of our own personal Jarvis. 
