<?php
require('../alice.php');
if (!$_GET['i']) die("No image requested");
$id = explode("_", $_GET['i']);
$prefix = $id[0];
$base = $id[1];

switch($prefix)
{
    case "xbmcFilm":
	$film = alice_xbmc_getSingleFilm($base);
	$url = "http://localhost:8090/vfs/".$film->thumbnail;

	$arrayURL = explode("/", $url);
	$file = explode(".", $arrayURL[10]);
	$id = $file[0];

	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	$exists = mysql_fetch_array(mysql_query("SELECT EXISTS(SELECT * FROM a_images WHERE (name = 'xbmcFilm_{$id}'))"));
	if(!$exists[0] || $_GET['purge'])
	{
	
		$img = new Imagick("http://localhost:8090/vfs/special://masterprofile/Thumbnails/Video/{$id[0]}/$id.tbn");
		$img->thumbnailImage(300, 300, TRUE);
		alice_mysql_putImage("xbmcFilm_".$id, $img);

	}
	mysql_close();

	$imageID = "xbmcFilm_".$id;
	break;

    case "xbmcFilmPoster":
	$film = alice_xbmc_getSingleFilm($base);
	$url = "http://localhost:8090/vfs/".$film->thumbnail;

	$arrayURL = explode("/", $url);
	$file = explode(".", $arrayURL[10]);
	$id = $file[0];

	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	$exists = mysql_fetch_array(mysql_query("SELECT EXISTS(SELECT * FROM a_images WHERE (name = 'xbmcFilmPoster_{$id}'))"));
	if(!$exists[0] || $_GET['purge'])
	{
	
		$img = new Imagick("http://localhost:8090/vfs/special://masterprofile/Thumbnails/Video/{$id[0]}/$id.tbn");
		$img->thumbnailImage(600, 600, TRUE);
		alice_mysql_putImage("xbmcFilmPoster_".$id, $img);

	}
	mysql_close();

	$imageID = "xbmcFilmPoster_".$id;
	break;

    case "xbmcShow":
	$show = alice_xbmc_getSingleShow($base);
	$url = "http://localhost:8090/vfs/".$show->thumbnail;

	$arrayURL = explode("/", $url);
	$file = explode(".", $arrayURL[10]);
	$id = $file[0];

	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	$exists = mysql_fetch_array(mysql_query("SELECT EXISTS(SELECT * FROM a_images WHERE (name = 'xbmcShow_{$id}'))"));
	if(!$exists[0] || $_GET['purge'])
	{
	
		$img = new Imagick("http://localhost:8090/vfs/special://masterprofile/Thumbnails/Video/{$id[0]}/$id.tbn");
		$img->thumbnailImage(300, 300, TRUE);
		alice_mysql_putImage("xbmcShow_".$id, $img);

	}
	mysql_close();

	$imageID = "xbmcShow_".$id;
	break;

    case "xbmcShowFanart":
	$show = alice_xbmc_getSingleShow($base);
	$url = "http://localhost:8090/vfs/".$show->fanart;

	$arrayURL = explode("/", $url);
	$file = explode(".", $arrayURL[10]);
	$id = $file[0];
	
	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	$exists = mysql_fetch_array(mysql_query("SELECT EXISTS(SELECT * FROM a_images WHERE (name = 'xbmcShowFanart_{$id}'))"));
	if(!$exists[0] || $_GET['purge'])
	{
	
		$img = new Imagick("http://localhost:8090/vfs/special://masterprofile/Thumbnails/Video/Fanart/$id.tbn");
		$img->thumbnailImage(600, 600, TRUE);
		alice_mysql_putImage("xbmcShowFanart_".$id, $img);

	}
	mysql_close();

	$imageID = "xbmcShowFanart_".$id;
	break;

    default:
	$imageID = $prefix."_".$base;
}
$image = alice_mysql_getImage($imageID);
header("Content-type: {$image['mime']}");
echo $image['image'];
