<?php
if (!$_POST) die("This is Alice's API. She says hi.");
require('alice.php');

# XBMC API Calls
if ($_POST['movieid']) alice_xbmc_playFilm($_POST['movieid']);
if ($_POST['episodeid']) alice_xbmc_playEpisode($_POST['episodeid']);
if ($_POST['control']) alice_xbmc_control($_POST['control'], $_POST['param']);

# X10 API Calls
if ($_POST['x10']) alice_x10($_POST['x10'], $_POST['do']);

# Timer API Calls
if ($_POST['timer']) alice_timer_set($_POST['timer'], $_POST['message']);

# Notifications API Calls
if ($_POST['notifyAdd']) alice_notification_add($_POST['notifyAdd'], $_POST['message']);
if ($_POST['notifyRemove']) alice_mysql_remove("modules", "notification", array($_POST['notifyRemove']));

# Grocery list API calls
if ($_POST['groceryList']) alice_groceries_print();
