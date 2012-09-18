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

<div class="navbar navbar-fixed-top navbar-inverse">
<div class="navbar-inner">
<div class="container">
<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="brand" href="index.php">Alice</a>
<div class="nav-collapse collapse">
<ul class="nav">
<li class="{{if $page=='index'}}active{{/if}}"><a href="index.php">Main</a></li>
<li class="{{if $page=='weather'}}active{{/if}}"><a href="#weather">Weather</a></li>
<li class="{{if $page=='xbmc'}}active{{/if}}"><a href="xbmc.php">XBMC</a></li>
<li class="{{if $page=='home'}}active{{/if}}"><a href="#home">Home</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>
</div>
{{if $error}}
<div class="container">
{{foreach $error as $issue}}
<div class="alert alert-{{$issue[0]}}"><strong>Warning!</strong> {{$issue[1]}}</div>
{{/foreach}}
</div>
{{/if}}
