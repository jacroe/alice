<?php
/*
NAME:         Home automation
ABOUT:        Automates some aspects of my home
DEPENDENCIES: X10;
INSTALL:      None;
CONFIG:       None;
*/


// Setting sun
if (date('Hi') == "1815")
{
	alice_x10("j2", "brighten", 2);
}
elseif (date('Hi') == "1830")
{
	alice_x10("j2", "brighten", 2);
}
elseif (date('Hi') == "1845")
{
	alice_x10("j2", "brighten", 2);
}
elseif (date('Hi') == "1900")
{
	alice_x10("j2", "brighten", 4);
}

// Time to get ready for bed
if (date('Hi') == "2345")
{
	alice_macro_run("chime");
	alice_macro_run("lightsoff");
	sleep(2);
	alice_macro_run("lightson");
}
if (date('Hi') == "0000")
{
	alice_macro_run("chime");
	alice_macro_run("lightsoff");
}
?>
