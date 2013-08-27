{{include file="header.tpl" page="index"}}
<div class="jumbotron">
	<h1>{{$masthead}}</h1>
	<p>{{$subhead}}</p>
</div>

<div class="row">

<div class="col-md-4">
	<h2>Weather</h2>
	{{if $weather.alerts}}<div class="alert alert-danger"><strong>Warning!</strong> Weather alerts issued.</div>{{/if}}
	<p>{{if $smarty.now|date_format:"%H" < 18}}{{$weather.fcastToday}}{{else}}{{$weather.fcastTonight}}{{/if}}</p>
	<p><a class="btn btn-default" href="weather.php">View details &raquo;</a></p>
</div>

<div class="col-md-4">
	<h2>{{if $xbmcBody}}Recently Added Films{{else}}XBMC Offline{{/if}}</h2>
	{{if $xbmcBody}}<p>{{$xbmcBody}}</p>
	<p><a class="btn btn-default" href="xbmc.php">Watch more &raquo;</a></p>
	{{/if}}
</div>

<div class="col-md-4">
	<h2>Modes</h2>
	<p><a class="btn btn-success" onClick='aliceAPI({"method":"Macro.Run","params":{"macro":"home"}})'>Home</a> <a class="btn btn-danger" onClick='aliceAPI({"method":"Macro.Run","params":{"macro":"away"}})'>Away</a></p>
	<h2>Notifications</h2>
	{{if $notifications}}
		<table class="table table-bordered table-condensed">
			<tbody>
			{{foreach $notifications as $notif}}
			<tr><td><strong>{{$notif.title}}</strong></td><td>{{$notif.message}}</td><td><a class="btn btn-default btn-xs" onClick='aliceAPI({"method":"Notify.Remove","params":{"timestamp":"{{$notif.id}}"}});return false;'><span class="glyphicon glyphicon-trash"></span></a></td></tr>
			{{/foreach}}
			</tbody>
		</table>
	{{else}}
		<p>No notifications.</p>
	{{/if}}
</div>

</div>
{{include file="footer.tpl" page="index"}}
