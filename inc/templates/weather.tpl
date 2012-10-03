{{include file="header.tpl" page="weather"}}
<div class="container">

<div class="hero-unit">
<h1>{{$masthead}}</h1>
<p>{{$subhead}}</p>
</div>

<div class="row">

<div class="span4">
<h2>Current Conditions</h2>
<table class="table table-bordered table-condensed">
<tbody>
<tr><td><strong>High / Low</strong></td><td>{{$weather.hiTemp}}F / {{$weather.loTemp}}F</td></tr>
<tr><td><strong>Wind</strong></td><td>{{$weather.currWind}}</td></tr>
<tr><td><strong>Humidity</strong></td><td>{{$weather.currHumidity}}</td></tr>
</tbody>
</table>

<h2>Forecast</h2>
<table class="table table-bordered table-condensed">
<tbody>
<tr><td><strong>Today</strong></td><td>{{$weather.fcastToday}}</td></tr>
<tr><td><strong>Tomorrow</strong></td><td>{{$weather.fcastTomorrow}}</td></tr>
</tbody>
</table>
</div>

<div class="span4">
<h2>Radar</h2>
<img src="{{$radarimg}}" />
</div>

<div class="span4">
<h2>Satellite</h2>
<img src="{{$satimg}}" />
</div>

</div>
{{include file="footer.tpl"}}
