{{include file="header.tpl" page="index"}}
<div class="container">

<div class="hero-unit">
<h1>{{$masthead}}</h1>
<p>{{$subhead}}</p>
</div>

<div class="row">

<div class="span4">
<h2>Weather</h2>
{{if $weather.alerts}}<div class="alert alert-error"><strong>Warning!</strong> Weather alerts issued.</div>{{/if}}
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
<h2>Timer</h2>
<div class="form-inline">
  <input type="text" class="input-small" id="timer" placeholder="20 minutes">
  <button class="btn" onClick='aliceAPI({"method":"Timer.Set","params":{"datetime":$("#timer").val(),"message":"Timer set from homepage."}});$("#timer").val(null);return false;'>Set timer</button>
</div>

<h2>Notifications</h2>
<table class="table table-bordered table-condensed">
<tbody>
{{foreach $notifications as $notif}}
<tr><td><strong>{{$notif.title}}</strong></td><td>{{$notif.message}}</td><td><a class="btn btn-mini" onClick='aliceAPI({"method":"Notify.Remove","params":{"timestamp":"{{$notif.id}}"}});return false;'><i class=icon-trash></i></a></td></tr>
{{/foreach}}
</tbody>
</table>
</div>

</div>
{{include file="footer.tpl" page="index"}}
