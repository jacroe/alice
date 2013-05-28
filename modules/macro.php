<?php
/*
NAME:         Macros
ABOUT:        Sets of tasks that can be triggered with one command
DEPENDENCIES: MySQL module; Any other module that's called by the macro
*/
function alice_macro_run($name)
{
	$allMacros = alice_mysql_get("modules", "macro");
	$data = explode("\n", $allMacros[$name]);
	foreach ($data as $command)
		alice_api($command);
}
