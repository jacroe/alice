<?php
require "alice.php";

/* Masthead */

$masthead = "Home Life";
$subhead = "Or, rather, dorm life.";

$livingroom_x10 = alice_x10_getGroup("livingroom");
$bedroom_x10 = alice_x10_getGroup("bedroom");


$smarty->assign("masthead", $masthead);
$smarty->assign("subhead", $subhead);
$smarty->assign("webcamimg", "./inc/image.php?i=webcam_latest");
$smarty->assign("livingroom_x10", $livingroom_x10);
$smarty->assign("bedroom_x10", $bedroom_x10);
$smarty->assign("updateTime", $u['time']);
$smarty->assign("updateCity", $l['city'].', '.$l['state']);
$smarty->assign("error", $errors);
$smarty->display("home.tpl");
?>
