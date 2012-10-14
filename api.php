<?php
if (!$_POST) die("This is Alice's API. She says hi.");
require('alice.php');
if ($_POST['movieid']) alice_xbmc_check("movie {$_POST['movieid']}");
if ($_POST['episodeid']) alice_xbmc_check("episode {$_POST['episodeid']}");
if ($_POST['event']) alice_events("{$_POST['event']}");
if ($_POST['control']) alice_xbmc_check("{$_POST['control']}");
if ($_POST['x10']) alice_x10("{$_POST['x10']}", "{$_POST['do']}"); 
