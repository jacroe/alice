<?php
function alice_ip_get()
{
	$ip = file_get_contents('http://jacroe.com/projects/ip.php'); 
	return $ip;
}
