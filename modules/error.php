<?php
/*
NAME:         Error logging
ABOUT:        Logs error data at PATH/error.log
DEPENDENCIES: None;
*/
function alice_error_add($loc, $error)
{
	error_reporting(-1);
	$log = file_get_contents(PATH."error.log");
	file_put_contents(PATH."error.log", date("Y-m-d-H-i-s")."	ERROR at $loc - $error\n", FILE_APPEND);
}

?>
