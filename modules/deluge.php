<?php
/*
NAME:         Deluge
ABOUT:        Adds either local files or files located on the internet to Deluge
DEPENDENCIES: None;
*/
function alice_deluge_auth()
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, DELUGE_SERVER);
	curl_setopt($curl, CURLOPT_POSTFIELDS, '{"method": "auth.login", "params": ["'.DELUGE_PASS.'"], "id": 1}');
	curl_setopt($curl, CURLOPT_HEADER, true);  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($curl, CURLOPT_ENCODING, "gzip"); 
	$data = curl_exec($curl);
	curl_close($curl);

	preg_match_all('|Set-Cookie: (.*);|U', $data, $matches);   
	$cookies = implode('; ', $matches[1]);
	return $cookies;
}

function alice_deluge_addLocal($file, $downloadDir = DELUGE_DOWNLOAD)
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, DELUGE_SERVER);
	curl_setopt($curl, CURLOPT_POSTFIELDS, '{"method":"web.add_torrents","params":[[{"path":"'.$file.'","options": {"download_location": "'.DELUGE_DOWNLOAD.'"}}]],"id":1}');
	curl_setopt($curl, CURLOPT_COOKIE, alice_deluge_auth()); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($curl, CURLOPT_ENCODING, "gzip"); 
	$data = curl_exec($curl);
	curl_close($curl);
	
	return json_decode($data); 
}

function alice_deluge_addWeb($url, $downloadDir = DELUGE_DOWNLOAD)
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, DELUGE_SERVER);
	curl_setopt($curl, CURLOPT_POSTFIELDS, '{"method": "web.download_torrent_from_url", "params": ["'.$url.'"], "id": 1}');
	curl_setopt($curl, CURLOPT_COOKIE, alice_deluge_auth()); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($curl, CURLOPT_ENCODING, "gzip"); 
	$data = curl_exec($curl);
	curl_close($curl);
	
	return alice_deluge_addLocal(json_decode($data)->result, $downloadDir); 
}
