<?php
if (!$_POST['json']) die("This is Alice's API. She says hi.");
require('alice.php');
echo alice_api($_POST['json'])."\n";