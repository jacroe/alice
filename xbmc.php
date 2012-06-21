<?php
require "alice.php";
include "data.php";
/* Movie */
//
if ($_GET['movie'])
{
	$jsonFilm = json_decode(alice_xbmc_talk(array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetMovieDetails", "params" => array("movieid" => intval($_GET['movie']), "properties" => array("tagline", "plot", "year", "mpaa", "runtime", "thumbnail", "genre")), "id" => 1)));
	$film = $jsonFilm->result->moviedetails;
	$masthead = $film->label;
	$subhead = $film->tagline;
	$poster = "http://$dIP:8090/vfs/{$film->thumbnail}";
	$summary = $film->plot;
	$genre = $film->genre;
	$year = $film->year;
	$rating = $film->mpaa;
	$runtime = $film->runtime;
	$finishtime = date("g:i a", time()+$runtime*60);
}
elseif ($_GET['show'])
{
	$arrayShow = alice_xbmc_show($_GET['show']);
	$arrayEpisodes = alice_xbmc_episodes($_GET['show']);
	$masthead = $arrayShow->label;
	$subhead = $arrayShow->plot;
	$fanart = "http://$dIP:8090/vfs/{$arrayShow->fanart}";
	$intFirstSeason = $arrayEpisodes[0]->season;
	$shows = "";
	foreach ($arrayEpisodes as $episode)
	{
		if ($episode->season != $intCurSeason)
		{
			$intCurSeason = $episode->season;
			$shows .= "<strong>Season $intCurSeason</strong><br />\n";
		}
		$shows .= "<a class=\"btn btn-mini\" onclick='$.post(\"api.php\", { episodeid: {$episode->episodeid} } );'><i class=icon-play></i></a> {$episode->episode}. {$episode->title}<br />\n";
	}
}
else
{
	$arrayAllFilms = alice_xbmc_movies();
	$arrayAllTVShows = alice_xbmc_tvshows();
	$masthead = "XBMC";
	$subhead = "Great media center, or greatest media center?";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $masthead; ?> | Alice</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="./lib/bootstrap/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
body {
padding-top: 60px;
padding-bottom: 40px;
}
</style>
<link href="./lib/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="./lib/bootstrap/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="./lib/bootstrap/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="./lib/bootstrap/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="./lib/bootstrap/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>

<div class="navbar navbar-fixed-top">
<div class="navbar-inner">
<div class="container">
<a class="brand" href="index.php">Alice</a>
<div class="nav-collapse">
<ul class="nav">
<li><a href="index.php">Main</a></li>
<li><a href="#weather">Weather</a></li>
<li class="active"><a href=xbmc.php>XBMC</a></li>
<li><a href="#home">Home</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>
</div>

<div class="container">
<?php if(!alice_xbmc_on())
{
?>
<div class="alert alert-error">
<strong>Warning!</strong> XBMC is offline.
</div>
<?php
}
?>
<div class="hero-unit">
<h1><?php echo $masthead; ?></h1>
<p><?php echo $subhead; ?></p>
<?php
if ($_GET['movie'])
//Display information about one specific film
{

?>
<p><a class="btn btn-primary btn-large" onclick='$.post("api.php", { movieid: <?php echo $_GET['movie'];?> } );'>Play &raquo;</a></p>
</div>


<div class="row">

<div class="span5">
<h2>Poster</h2>
<p><img src="<?php echo $poster; ?>" width=300 /></p>
</div>

<div class="span7">
<h2>Information</h2>
<table class="table table-bordered table-condensed">
<tbody>
<tr><td><strong>Summary</strong></td><td><?php echo $summary; ?></td></tr>
<tr><td><strong>Genre</strong></td><td><?php echo $genre; ?></td></tr>
<tr><td><strong>Year</strong></td><td><?php echo $year; ?></td></tr>
<tr><td><strong>Rating</strong></td><td><?php echo $rating; ?></td></tr>
<tr><td><strong>Runtime</strong></td><td><?php echo $runtime; ?> minutes</td></tr>
<tr><td><strong>Finish Time</strong></td><td><?php echo $finishtime; ?></td></tr>
</tbody>
</table>
</div>

</div>

<?php
}
elseif($_GET['show'])
{
?>
</div>


<div class="row">

<div class="span5">
<h2>Fanart</h2>
<p><img src="<?php echo $fanart; ?>" width=400 /></p>
</div>

<div class="span7">
<h2>Shows</h2>
<p><?php echo $shows; ?></p>
</div>

</div>
<?php
}
?>

<?php
// Display posters of all films
if (!$_GET)
{
?>
</div>


<div class=row>
<div class=span12>
<div class="page-header">
<h1>TV Shows</h1>
</div>
<ul class="thumbnails">
<?php
foreach ($arrayAllTVShows as $show) 
	echo "<li class=span3>
  <div class=thumbnail>
  <a href=xbmc.php?show={$show->tvshowid} class=thumbnail><img src=http://$dIP:8090/vfs/{$show->thumbnail} /></a>
  </div>
</li>\n";
?>
</ul>
</div>

<div class=span12>
<div class="page-header">
<h1>Films</h1>
</div>
<ul class="thumbnails">
<?php
foreach ($arrayAllFilms as $movie) 
	echo "<li class=span3>
  <div class=thumbnail>
  <a href=xbmc.php?movie={$movie->movieid} class=thumbnail><img src=http://$dIP:8090/vfs/{$movie->thumbnail} /></a>
  </div>
</li>\n";
?>
</ul>
</div>
</div>

<?php
}
?>

<hr>

<footer>
<p></p>
</footer>

</div> <!-- /container -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="./lib/bootstrap/js/jquery.js"></script>
<script src="./lib/bootstrap/js/bootstrap-transition.js"></script>
<script src="./lib/bootstrap/js/bootstrap-alert.js"></script>
<script src="./lib/bootstrap/js/bootstrap-modal.js"></script>
<script src="./lib/bootstrap/js/bootstrap-dropdown.js"></script>
<script src="./lib/bootstrap/js/bootstrap-scrollspy.js"></script>
<script src="./lib/bootstrap/js/bootstrap-tab.js"></script>
<script src="./lib/bootstrap/js/bootstrap-tooltip.js"></script>
<script src="./lib/bootstrap/js/bootstrap-popover.js"></script>
<script src="./lib/bootstrap/js/bootstrap-button.js"></script>
<script src="./lib/bootstrap/js/bootstrap-collapse.js"></script>
<script src="./lib/bootstrap/js/bootstrap-carousel.js"></script>
<script src="./lib/bootstrap/js/bootstrap-typeahead.js"></script>

</body>
</html>

