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
	$imdb = str_replace("tt", "", $film->imdbnumber);
	$arrayRT = json_decode(file_get_contents("http://api.rottentomatoes.com/api/public/v1.0/movie_alias.json?apikey=4zexarfb847qe7rjpn8cfq45&type=imdb&id=".$imdb));

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
	$smarty->assign("rtScore", $arrayRT->ratings->critics_score);
	$smarty->assign("rtFreshness", $arrayRT->ratings->critics_rating);
	$smarty->assign("rtConsensus", $arrayRT->critics_consensus);
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
