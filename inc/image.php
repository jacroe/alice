<?php
require('../alice.php');

if (!$_GET['i']) die("No image requested");
$image = alice_mysql_getImage($_GET['i']);
header("Content-type: {$image['mime']}");
echo $image['image'];
