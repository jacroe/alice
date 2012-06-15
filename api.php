<?php
if (!$_POST) die("This is Alice's API. She says hi.");
require('alice.php');
if ($_POST['movieid']) alice_check_command("xbmc movie {$_POST['movieid']}");
if ($_POST['event']) alice_check_command("event {$_POST['event']}"); 
