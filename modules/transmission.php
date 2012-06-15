<?php
/*
NAME:         Transmission
ABOUT:        Interacts with the Transmission program via its API
DEPENDENCIES: Transmission library;
*/
function alice_transmission_add($url)
{
	require_once PATH.'lib/transmission/transmission.php';
	
	$rpc = new TransmissionRPC();
	$rpc->username = TRANSMISSION_SERVER;
	$rpc->username = TRANSMISSION_USER;
	$rpc->password = TRANSMISSION_PASS;
	try {
		$result = $rpc->add($url, TRANSMISSION_DOWNLOAD);
		$id = $result->arguments->torrent_added->id;
		return $result->result;
	}
	catch (Exception $e)
	{
		return $e->getMessage();
	}
}
