{{include file="header.tpl" page="weather"}}
<div class="container">

<div class="hero-unit">
<h1>{{$masthead}}</h1>
<p>{{$subhead}}</p>
</div>

<div class="row">

<div class="span4">
{{if $alerts}}
<h2>Alerts</h2>
{{foreach from=$alerts key=i item=alert}}
<p><a href="#alert{{$i}}" data-toggle="modal">{{$alert.title}}</a> Expires: {{$alert.expires}}.</p>

<div id="alert{{$i}}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="alert{{$i}}Label" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3 id="alert{{$i}}Label">{{$alert.title}}</h3>
</div>
<div class="modal-body">
<p><strong>Issued:</strong> {{$alert.issued}}<br />
<strong>Expires:</strong> {{$alert.expires}}</p>
<hr />
<p>{{$alert.message}}</p>
<div class="modal-footer"><button class="btn" data-dismiss="modal">Close</button></div>
</div>
</div>

{{/foreach}}

{{/if}}
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
{{if $smarty.now|date_format:"%H" < 18}}
<tr><td><strong>Today</strong></td><td>{{$weather.fcastToday}}</td></tr>
{{/if}}
<tr><td><strong>Tonight</strong></td><td>{{$weather.fcastTonight}}</td></tr>
<tr><td><strong>Tomorrow</strong></td><td>{{$weather.fcastTomorrow}}</td></tr>
<tr><td><strong>Tomorrow night</strong></td><td>{{$weather.fcastTomorrowNight}}</td></tr>
{{if $smarty.now|date_format:"%H" >= 18}}
<tr><td><strong>{{$nextDay}}</strong></td><td>{{$weather.fcastNextday}}</td></tr>
{{/if}}
{{* <tr><td><strong>{{$nextDay}} night</strong></td><td>{{$weather.fcastNextdayNight}}</td></tr> *}}
</tbody>
</table>
</div>

<!--<div class="span4">
<h2>Radar</h2>
<img src="{{$radarimg}}" alt="Radar image for {{$updateCity}}" />
</div>

<div class="span4">
<h2>Satellite</h2>
<img src="{{$satimg}}" alt="Satellite image for {{$updateCity}}" />
</div>-->
<div class="span4">
	<h2>Weather Maps</h2>
	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabRadar" data-toggle="tab">Radar</a></li>
			<li><a href="#tabSat" data-toggle="tab">Satellite</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tabRadar">
				<img src="{{$radarimg}}" alt="Radar image for {{$updateCity}}" />
			</div>
			<div class="tab-pane" id="tabSat">
				<img src="{{$satimg}}" alt="Satellite image for {{$updateCity}}" />
			</div>
		</div>
	</div>
</div>

</div>
{{include file="footer.tpl" page="weather"}}
