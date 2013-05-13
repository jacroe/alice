<?php
require "alice.php";

/* Masthead */

$masthead = "Home Life";
$subhead = "Or, rather, dorm life.";

$bedroom_x10 = alice_x10_getGroup("bedroom");
$living_x10 = alice_x10_getGroup("living");

$smarty->assign("title", "Home Life");
$smarty->assign("masthead", $masthead);
$smarty->assign("subhead", $subhead);
$smarty->assign("webcamImg", "./inc/image.php?i=webcam_latest");
$smarty->assign("bedroom_x10", $bedroom_x10);
$smarty->assign("living_x10", $living_x10);
$smarty->assign("allTimers", alice_timer_getAll());
$smarty->assign("updateTime", date("g:i a", $u['time']));
$smarty->assign("updateCity", $l['city'].', '.$l['state']);
$smarty->assign("error", $errors);
$smarty->display("home.tpl");
?>
