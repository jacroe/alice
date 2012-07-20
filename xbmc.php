<?php
require "alice.php";
include "data.php";
$smarty = new Smarty;
$smarty->left_delimiter = '{{';
$smarty->right_delimiter = '}}';
$smarty->template_dir = PATH."inc/templates/";
$smarty->compile_dir  = PATH."inc/templates_c/";

if ($_GET['movie'])
{
	$jsonFilm = json_decode(alice_xbmc_talk(array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetMovieDetails", "params" => array("movieid" => intval($_GET['movie']), "properties" => array("tagline", "plot", "year", "mpaa", "runtime", "thumbnail", "genre")), "id" => 1)));
	$film = $jsonFilm->result->moviedetails;
	
	$smarty->assign("title", $film->label);
	$smarty->assign("masthead", $film->label);
	$smarty->assign("subhead", $film->tagline);
	$smarty->assign("movieid", $_GET['movie']);
	$smarty->assign("poster", "http://$dIP:8090/vfs/{$film->thumbnail}");
	$smarty->assign("summary", $film->plot);
	$smarty->assign("genre", $film->genre);
	$smarty->assign("year", $film->year);
	$smarty->assign("mpaa", $film->mpaa);
	$smarty->assign("runtime", $film->runtime);
	$smarty->assign("finishtime", date("g:i a", time()+$film->runtime*60));
	$smarty->display("xbmcFilm.tpl");
}
elseif ($_GET['show'])
{
	$arrayShow = alice_xbmc_show($_GET['show']);
	$smarty->assign("title", $arrayShow->label);
	$smarty->assign("masthead", $arrayShow->label);
	$smarty->assign("subhead", $arrayShow->plot);
	$smarty->assign("fanart", "http://$dIP:8090/vfs/{$arrayShow->fanart}");
	$smarty->assign("arrayEpisodes", alice_xbmc_episodes($_GET['show']));
	$smarty->display("xbmcShow.tpl");
}
else
{
	$smarty->assign("title", "XBMC");
	$smarty->assign("masthead", "XBMC");
	$smarty->assign("subhead", "Great media center, or greatest media center?");
	$smarty->assign("arrayShows", alice_xbmc_tvshows());
	$smarty->assign("arrayFilms", alice_xbmc_movies());
	$smarty->display("xbmc.tpl");
}
?>
