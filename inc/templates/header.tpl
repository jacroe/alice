<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>{{if $title}} {{$title}} | {{/if}}Alice</title>
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

<div class="navbar navbar-fixed-top navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Alice</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="{{if $page=='index'}}active{{/if}}"><a href="index.php">Main</a></li>
				<li class="{{if $page=='weather'}}active{{/if}}"><a href="weather.php">Weather</a></li>
				<li class="{{if $page=='xbmc'}}active{{/if}}"><a href="xbmc.php">XBMC</a></li>
				<li class="{{if $page=='home'}}active{{/if}}"><a href="home.php">Home</a></li>
				<li class="{{if $page=='meta'}}active{{/if}}"><a href="meta.php">Meta</a></li>
			</ul>
		</div><!--/.navbar-collapse -->
	</div>
</div>

{{if $error}}
<div class="container">
{{foreach $error as $issue}}
	<div class="alert alert-{{$issue[0]}}"><strong>Warning!</strong> {{$issue[1]}}</div>
{{/foreach}}
</div>
{{/if}}

<div class="container">
