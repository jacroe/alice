<?php
if (!$_POST) die("This is Alice's API. She says hi.");
require('alice.php');
if ($_POST['movieid']) alice_check_command("xbmc movie {$_POST['movieid']}");
if ($_POST['episodeid']) alice_check_command("xbmc episode {$_POST['episodeid']}");
if ($_POST['event']) alice_check_command("event {$_POST['event']}"); 
if ($_POST['control']) alice_check_command("xbmc {$_POST['control']}"); 
