<?php
require "alice.php";

if (time()-$u['time'] > 1200) $errors[] = array("error", "Alice's data is at least 20 minutes old.");

/* Masthead */
$masthead = "Meta";

/* Subhead */
$subhead = "It is ".date("g:i a");

$errorLog = file_get_contents(PATH."error.log");

$smarty->assign("title", "Meta");
$smarty->assign("masthead", $masthead);
$smarty->assign("subhead", $subhead);
$smarty->assign("serviceList", $serviceList);
$smarty->assign("errorLog", $errorLog);
$smarty->assign("updateTime", date("g:i a", $u['time']));
$smarty->assign("updateCity", $u['city']);
$smarty->assign("error", $errors);
$smarty->display("meta.tpl");
?>
