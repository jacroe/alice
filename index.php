<?php
require "alice.php";
include "data.php";
$w = $dWeather;

/* Masthead */
if ($dEmailCount)
	if ($dEmailCount == 1) $masthead = "$dEmailCount new message";
	else $masthead = "$dEmailCount new messages";
elseif (alice_xbmc_check('playing'))
{
	$nowPlaying = alice_xbmc_check('playing');
	if ($nowPlaying[0])
	$masthead = "{$nowPlaying[0]} - &ldquo;{$nowPlaying[1]}&rdquo;";
	else $masthead = $nowPlaying[1];
}
else
{
	$w = $dWeather;
	$masthead = "{$w['currTemp']}&deg;F - {$w['currCond']}";
}

/* Subhead */
if (alice_xbmc_check('playing'))
{
	$subhead = <<<SHEAD
<a class="btn" onclick='$.post("api.php", { control: "rewind" } );'><i class=icon-backward></i></a> <a class="btn btn-primary" onclick='$.post("api.php", { control: "pause" } );'><i class="icon-play icon-white"></i><i class="icon-pause icon-white"></i></a> <a class="btn" onclick='$.post("api.php", { control: "forward" } );'><i class=icon-forward></i></a> <a class="btn" onclick='$.post("api.php", { control: "volume up" } );'><i class=icon-volume-up></i></a> <a class="btn" onclick='$.post("api.php", { control: "volume down" } );'><i class=icon-volume-down></i></a> <a class="btn" onclick='$.post("api.php", { control: "volume mute" } );'><i class=icon-volume-off></i></a>
SHEAD;
}
elseif (date('H') == 23)
{
	$now = new DateTime();
	$ref = new DateTime("tomorrow 6:30am");
	$diff = $now->diff($ref);
	if ($diff->h) $time = "{$diff->h} hours and {$diff->i} minutes";
	else $time = "{$diff->i} minutes"; 
	$subhead = "You will be waking up in $time.";
}
else
{
$subhead = "It is ".date('g:i a');
}

/* Weather */
$weather = "Right now it's {$w['currTemp']} and {$w['currCond']}. The forecast for today calls for {$w['fcastTod']}. The high is {$w['hiTemp']}F and the low is {$w['loTemp']}F.";

/* XBMC */
/* Get three most recent films */
if (alice_xbmc_on())
{
	$jsonThreeFilms = json_decode(alice_xbmc_talk(array("jsonrpc" => "2.0", "method" => "VideoLibrary.GetRecentlyAddedMovies", "params" => array("limits" => array("end" => 3), "properties" => array("mpaa", "runtime")), "id" => 1)));
	$arrayThreeFilms = $jsonThreeFilms->result->movies;
	$films = "";
	foreach ($arrayThreeFilms as $movie)
	{
		$films .= "<a href=xbmc.php?movie={$movie->movieid}><strong>{$movie->label}</strong></a> - {$movie->mpaa} - {$movie->runtime} mins<br />\n";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Alice</title>
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
<li class="active"><a href="#">Main</a></li>
<li><a href="#weather">Weather</a></li>
<li><a href="xbmc.php">XBMC</a></li>
<li><a href="#home">Home</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>
</div>

<div class="container">

<div class="hero-unit">
<h1><?php echo $masthead; ?></h1>
<p><?php echo $subhead; ?></p>
</div>

<div class="row">

<div class="span4">
<h2>Weather</h2>
<p><?php echo $weather; ?>
<p><a class="btn" href="#">View details &raquo;</a></p>
</div>

<div class="span4">
<?php
if (alice_xbmc_on())
{
?>
<h2>Recently Added Films</h2>
<p><?php echo $films; ?></p>
<p><a class="btn" href="xbmc.php">Watch more &raquo;</a></p>
<?php
}
else
{
?>
<h2>XBMC Offline</h2>
<div class="alert">
<strong>Warning!</strong> XBMC is offline.
</div>
<?php
}
?>
</div>

<div class="span4">
<h2>Home</h2>
<p><a class="btn btn-success" onclick='$.post("api.php",{event:"lOn"});'>Lights On</a> <a class="btn btn-danger" onclick=$.post("api.php",{event:"lOff"});>Lights Off</a></p>
<p><a class="btn" onclick=$.post("api.php",{event:"watch"});>Television</a> <a class="btn" onclick=$.post("api.php",{event:"sleep"});>Sleep</a> <a class="btn" onclick=$.post("api.php",{event:"reading"});>Reading</a></p>
</div>

</div>
<hr>

<footer>
<p>Last updated at <?php echo $dUpdated; ?> in <?php echo $dLocation['city'].', '.$dLocation['state']; ?>. <a href=cron.php?purge=yes>Purge</a></p>
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

