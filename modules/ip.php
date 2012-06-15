<?php
/*
NAME:         IP address
ABOUT:        Returns the public ip address
DEPENDENCIES: None;
*/
function alice_ip_get()
{
	$ip = file_get_contents('http://jacroe.com/projects/ip.php'); 
	return $ip;
}
