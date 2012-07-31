{{include file="header.tpl"}}
<div class="container">

<div class="hero-unit">
<h1>{{$masthead}}</h1>
<p>{{$subhead}}</p>
</div>

<div class="row">

<div class="span4">
<h2>Weather</h2>
<p>Right now it's {{$weather.currTemp}} and {{$weather.currCond}}. The forecast for today calls for {{$weather.fcastTod}}. The high is {{$weather.hiTemp}}F and the low is {{$weather.loTemp}}F.</p>
<p><a class="btn" href="#">View details &raquo;</a></p>
</div>

<div class="span4">
<h2>{{if $xbmcBody}}Recently Added Films{{else}}XBMC Offline{{/if}}</h2>
{{if $xbmcBody}}<p>{{$xbmcBody}}</p>
<p><a class="btn" href="xbmc.php">Watch more &raquo;</a></p>{{else}}<div class="alert"><strong>Warning!</strong> XBMC is offline.</div>{{/if}}
</div>

<div class="span4">
<h2>Home</h2>
<p><a class="btn btn-success" onclick='$.post("api.php",{event:"lOn"});'>Lights On</a> <a class="btn btn-danger" onclick=$.post("api.php",{event:"lOff"});>Lights Off</a></p>
<p><a class="btn" onclick=$.post("api.php",{event:"watch"});>Television</a> <a class="btn" onclick=$.post("api.php",{event:"sleep"});>Sleep</a> <a class="btn" onclick=$.post("api.php",{event:"reading"});>Reading</a></p>
</div>

</div>
{{include file="footer.tpl"}}