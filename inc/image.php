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
	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	$exists = mysql_fetch_array(mysql_query("SELECT EXISTS(SELECT * FROM a_images WHERE (name = 'xbmcFilm_{$base}'))"));
	if(!$exists[0] || $_GET['purge'])
	{
	
		$img = new Imagick(XBMC_SERVER."image/".urlencode($film->thumbnail));
		$img->thumbnailImage(300, 300, TRUE);
		alice_mysql_putImage("xbmcFilm_".$base, $img);

	}
	mysql_close();

	$imageID = "xbmcFilm_".$base;
	break;

    case "xbmcFilmPoster":
	$film = alice_xbmc_getSingleFilm($base);

	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	$exists = mysql_fetch_array(mysql_query("SELECT EXISTS(SELECT * FROM a_images WHERE (name = 'xbmcFilmPoster_{$base}'))"));
	if(!$exists[0] || $_GET['purge'])
	{
	
		$img = new Imagick(XBMC_SERVER."image/".urlencode($film->thumbnail));
		$img->thumbnailImage(600, 600, TRUE);
		alice_mysql_putImage("xbmcFilmPoster_".$base, $img);

	}
	mysql_close();

	$imageID = "xbmcFilmPoster_".$base;
	break;

    case "xbmcShow":
	$show = alice_xbmc_getSingleShow($base);
	
	
	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	$exists = mysql_fetch_array(mysql_query("SELECT EXISTS(SELECT * FROM a_images WHERE (name = 'xbmcShow_{$base}'))"));
	if(!$exists[0] || $_GET['purge'])
	{
	
		$img = new Imagick(XBMC_SERVER."image/".urlencode($show->thumbnail));
		$img->thumbnailImage(300, 300, TRUE);
		alice_mysql_putImage("xbmcShow_".$base, $img);

	}
	mysql_close();

	$imageID = "xbmcShow_".$base;
	break;

    case "xbmcShowFanart":
	$show = alice_xbmc_getSingleShow($base);
	
	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	$exists = mysql_fetch_array(mysql_query("SELECT EXISTS(SELECT * FROM a_images WHERE (name = 'xbmcShowFanart_{$base}'))"));
	if(!$exists[0] || $_GET['purge'])
	{
	
		$img = new Imagick(XBMC_SERVER."image/".urlencode($show->fanart));
		$img->thumbnailImage(600, 600, TRUE);
		alice_mysql_putImage("xbmcShowFanart_".$base, $img);

	}
	mysql_close();

	$imageID = "xbmcShowFanart_".$base;
	break;

    default:
	$imageID = $prefix."_".$base;
}
$image = alice_mysql_getImage($imageID);
header("Content-type: {$image['mime']}");
echo $image['image'];
