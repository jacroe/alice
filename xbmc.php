<?php
require "alice.php";
require "data.php";
$smarty = new Smarty;
$smarty->left_delimiter = '{{';
$smarty->right_delimiter = '}}';
$smarty->template_dir = PATH."inc/templates/";
$smarty->compile_dir  = PATH."inc/templates_c/";

if (!alice_xbmc_isOn()) $smarty->assign("error", "XBMC is offline.");

if ($_GET['movie'])
{
	$film = alice_xbmc_getSingleFilm($_GET['movie']);

	$smarty->assign("title", $film->label);
	$smarty->assign("masthead", $film->label);
	$smarty->assign("subhead", $film->tagline);
	$smarty->assign("movieid", $_GET['movie']);
	$smarty->assign("poster", XBMC_SERVER."vfs/{$film->thumbnail}");
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
	$arrayShow = alice_xbmc_getSingleShow($_GET['show']);
	$smarty->assign("title", $arrayShow->label);
	$smarty->assign("masthead", $arrayShow->label);
	$smarty->assign("subhead", $arrayShow->plot);
	$smarty->assign("fanart", XBMC_SERVER."vfs/{$arrayShow->fanart}");
	$smarty->assign("arrayEpisodes", alice_xbmc_getAllEpisodesOfShow($_GET['show']));
	$smarty->display("xbmcShow.tpl");
}
else
{
	$smarty->assign("title", "XBMC");
	$smarty->assign("masthead", "XBMC");
	$smarty->assign("subhead", "Great media center, or greatest media center?");
	$smarty->assign("xbmcserver", XBMC_SERVER);
	$smarty->assign("arrayShows", alice_xbmc_getAllShows());
	$smarty->assign("arrayFilms", alice_xbmc_getAllFilms());
	$smarty->display("xbmc.tpl");
}
?>
