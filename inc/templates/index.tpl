{{include file="header.tpl" page="index"}}
<div class="container">

<div class="hero-unit">
<h1>{{$masthead}}</h1>
<p>{{$subhead}}</p>
</div>

<div class="row">

<div class="span4">
<h2>Weather</h2>
<p>{{if $smarty.now|date_format:"%H" < 18}}{{$weather.fcastToday}}{{else}}{{$weather.fcastTonight}}{{/if}}</p>
<p><a class="btn" href="weather.php">View details &raquo;</a></p>
</div>

<div class="span4">
<h2>{{if $xbmcBody}}Recently Added Films{{else}}XBMC Offline{{/if}}</h2>
{{if $xbmcBody}}<p>{{$xbmcBody}}</p>
<p><a class="btn" href="xbmc.php">Watch more &raquo;</a></p>
{{/if}}
</div>

<div class="span4">
<h2>Home</h2>
<p><a class="btn btn-success" onclick='$.post("api.php",{event:"lOn"});'>Lights On</a> <a class="btn btn-danger" onclick=$.post("api.php",{event:"lOff"});>Lights Off</a></p>
<p><a class="btn" onclick=$.post("api.php",{event:"watch"});>Television</a> <a class="btn" onclick=$.post("api.php",{event:"sleep"});>Sleep</a> <a class="btn" onclick=$.post("api.php",{event:"reading"});>Reading</a></p>
</div>

</div>
{{include file="footer.tpl" page="index"}}
