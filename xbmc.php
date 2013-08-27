<?php
require "alice.php";

if (!alice_xbmc_isOn()) $errors[] = array("warning", "XBMC is offline.");
if ($_GET['movie'])
{
	$film = alice_xbmc_getSingleFilm($_GET['movie']);
	$imdb = str_replace("tt", "", $film->imdbnumber);
	$arrayRT = json_decode(file_get_contents("http://api.rottentomatoes.com/api/public/v1.0/movie_alias.json?apikey=".RTOMATOES_API."&type=imdb&id=$imdb"));
	switch ($arrayRT->ratings->critics_rating)
	{
		case "Fresh":
		$rtImage = "fresh";
		break;
		case "Rotten":
		$rtImage = "rotten";
		break;
		case "Certified Fresh":
		$rtImage = "certified";
		break;
	}

	$smarty->assign("title", $film->label);
	$smarty->assign("masthead", $film->label);
	$smarty->assign("subhead", $film->tagline);
	$smarty->assign("movieid", $_GET['movie']);
	$smarty->assign("summary", $film->plot);
	$smarty->assign("genre", implode(" / ", $film->genre));
	$smarty->assign("year", $film->year);
	$smarty->assign("mpaa", $film->mpaa);
	$smarty->assign("runtime", floor($film->runtime / 60));
	$smarty->assign("finishtime", date("g:i a", time()+$film->runtime));
	$smarty->assign("rt", TRUE);
	$smarty->assign("rtScore", $arrayRT->ratings->critics_score);
	$smarty->assign("rtFreshness", $arrayRT->ratings->critics_rating);
	$smarty->assign("rtImage", $rtImage);
	$smarty->assign("rtConsensus", $arrayRT->critics_consensus);
	$smarty->assign("error", $errors);
	$smarty->display("xbmcFilm.tpl");
}
elseif ($_GET['show'])
{
	$arrayShow = alice_xbmc_getSingleShow($_GET['show']);
	$smarty->assign("showid", $_GET['show']);
	$smarty->assign("title", $arrayShow->label);
	$smarty->assign("masthead", $arrayShow->label);
	$nextEpisode = alice_xbmc_getFirstUnwatchedEpisode($_GET['show']);
	$smarty->assign("nextEpisodeID", $nextEpisode['id']);
	$smarty->assign("nextEpisodeTitle", $nextEpisode['title']);
	$smarty->assign("arrayEpisodes", alice_xbmc_getAllEpisodesOfShow($_GET['show']));
	$smarty->assign("error", $errors);
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
	$smarty->assign("error", $errors);
	$smarty->display("xbmc.tpl");
}
?>
