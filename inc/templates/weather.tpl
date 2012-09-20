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
</tbody>
</table>
</div>

<div class="span4">
<h2>Forecast</h2>
<table class="table table-bordered table-condensed">
<tbody>
<tr><td><strong>Today</strong></td><td>{{$weather.fcastTod}}</td></tr>
<tr><td><strong>Tomorrow</strong></td><td>{{$weather.fcastTom}}</td></tr>
</tbody>
</table>
</div>

<div class="span4">
<h2>Radar</h2>
<img src="{{$radarimg}}" />
</div>

</div>
{{include file="footer.tpl"}}
