{{include file="header.tpl" page="home"}}
<div class="hero-unit">
<h1>{{$masthead}}</h1>
<p>{{$subhead}}</p>
</div>

<div class="row">

<div class="span4">
<h2>Living room</h2>
<table class="table table-bordered table-condensed">
<tbody>
{{foreach $living_x10 as $device}}
{{if $device.type == "lamp"}}
<tr>
	<td><strong>{{$device.name}}</strong></td>
	<td>
	  <a class="{{$device.code}}_on btn btn-success btn-small{{if $device.curState > 0}} disabled{{/if}}" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"on"}});$("a.{{$device.code}}_on").addClass("disabled");$("a.{{$device.code}}_off").removeClass("disabled");$("a.{{$device.code}}_brighten").addClass("disabled");$("a.{{$device.code}}_dim").removeClass("disabled");'>On</a>
	  <a class="{{$device.code}}_off btn btn-danger btn-small{{if !$device.curState}} disabled{{/if}}" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"off"}});$("a.{{$device.code}}_on").removeClass("disabled");$("a.{{$device.code}}_off").addClass("disabled");$("a.{{$device.code}}_brighten").removeClass("disabled");$("a.{{$device.code}}_dim").addClass("disabled");'>Off</a>
	  <a class="{{$device.code}}_brighten btn btn-small{{if $device.curState == 10}} disabled{{/if}}" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"brighten"}});$("a.{{$device.code}}_on").addClass("disabled");$("a.{{$device.code}}_off").removeClass("disabled");$("a.{{$device.code}}_dim").removeClass("disabled");'>Brighten</a>
	  <a class="{{$device.code}}_dim btn btn-small{{if !$device.curState}} disabled{{/if}}" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"dim"}});$("a.{{$device.code}}_brighten").removeClass("disabled");'>Dim</a>
	</td>
</tr>
{{elseif $device.type == "appliance"}}
<tr>
	<td><strong>{{$device.name}}</strong></td>
	<td>
	  <a class="{{$device.code}}_on btn btn-success btn-small{{if $device.curState > 0}} disabled{{/if}}" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"on"}});$("a.{{$device.code}}_on").addClass("disabled");$("a.{{$device.code}}_off").removeClass("disabled");'>On</a>
	  <a class="{{$device.code}}_off btn btn-danger btn-small{{if !$device.curState}} disabled{{/if}}" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"off"}});$("a.{{$device.code}}_off").addClass("disabled");$("a.{{$device.code}}_on").removeClass("disabled");'>Off</a>
	</td>
</tr>
{{else}}
<tr>
	<td><strong>{{$device.name}}</strong></td>
	<td>
		<a class="{{$device.code}}_toggle btn btn-success btn-small" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"on"}});'>Chime</a>
	</td>
</tr>
{{/if}}
{{/foreach}}
</tbody>
</table>
<h2>Bedroom</h2>
<table class="table table-bordered table-condensed">
<tbody>
{{foreach $bedroom_x10 as $device}}
{{if $device.type == "lamp"}}
<tr>
	<td><strong>{{$device.name}}</strong></td>
	<td>
	  <a class="{{$device.code}}_on btn btn-success btn-small{{if $device.curState > 0}} disabled{{/if}}" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"on"}});$("a.{{$device.code}}_on").addClass("disabled");$("a.{{$device.code}}_off").removeClass("disabled");$("a.{{$device.code}}_brighten").addClass("disabled");$("a.{{$device.code}}_dim").removeClass("disabled");'>On</a>
	  <a class="{{$device.code}}_off btn btn-danger btn-small{{if !$device.curState}} disabled{{/if}}" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"off"}});$("a.{{$device.code}}_on").removeClass("disabled");$("a.{{$device.code}}_off").addClass("disabled");$("a.{{$device.code}}_brighten").removeClass("disabled");$("a.{{$device.code}}_dim").addClass("disabled");'>Off</a>
	  <a class="{{$device.code}}_brighten btn btn-small{{if $device.curState == 10}} disabled{{/if}}" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"brighten"}});$("a.{{$device.code}}_on").addClass("disabled");$("a.{{$device.code}}_off").removeClass("disabled");$("a.{{$device.code}}_dim").removeClass("disabled");'>Brighten</a>
	  <a class="{{$device.code}}_dim btn btn-small{{if !$device.curState}} disabled{{/if}}" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"dim"}});$("a.{{$device.code}}_brighten").removeClass("disabled");'>Dim</a>
	</td>
</tr>
{{elseif $device.type == "appliance"}}
<tr>
	<td><strong>{{$device.name}}</strong></td>
	<td>
	  <a class="{{$device.code}}_on btn btn-success btn-small{{if $device.curState > 0}} disabled{{/if}}" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"on"}});$("a.{{$device.code}}_on").addClass("disabled");$("a.{{$device.code}}_off").removeClass("disabled");'>On</a>
	  <a class="{{$device.code}}_off btn btn-danger btn-small{{if !$device.curState}} disabled{{/if}}" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"off"}});$("a.{{$device.code}}_off").addClass("disabled");$("a.{{$device.code}}_on").removeClass("disabled");'>Off</a>
	</td>
</tr>
{{else}}
<tr>
	<td><strong>{{$device.name}}</strong></td>
	<td>
		<a class="{{$device.code}}_toggle btn btn-success btn-small" onclick='aliceAPI({"method":"X10.Do","params":{"device":"{{$device.code}}","action":"on"}});'>Chime</a>
	</td>
</tr>
{{/if}}
{{/foreach}}
</tbody>
</table>
</div>

<div class="span4">
<h2>Webcam</h2>
<img src="{{$webcamImg}}" width=320 alt="Latest image captured from the webcam"/>
</div>

<div class="span4">
<h2>Timers</h2>
{{if $allTimers}}
<table class="table table-bordered table-condensed">
<tbody>
{{foreach $allTimers as $timer}}
<tr><td><strong>{{$timer.message}}</strong></td><td>{{$timer.timeLeft}}</td><td><a class="btn btn-mini" onClick='aliceAPI({"method":"Timer.Remove","params":{"timer":"{{$timer.timer}}"}});return false;'><i class=icon-trash></i></a></td></tr>
{{/foreach}}
</tbody>
</table>
{{else}}
<p>No timers have been set.</p>
{{/if}}

<form class="form-inline">
<input type="text" class="input-small" id="message" placeholder="Drink is cold.">
<input type="text" class="input-small" id="timer" placeholder="20 minutes">
<button class="btn" onClick='aliceAPI({"method":"Timer.Set","params":{"datetime":$("#timer").val(),"message":$("#message").val()}});$("#timer").val(null);$("#message").val(null);return false;'>Set timer</button>
</form>

<h2>Lists</h2>
<a class="list-grocery btn btn-primary" onClick='aliceAPI({"method":"Grocery.Print","params":{}});$("a.list-grocery").addClass("disabled");'>Print Grocery List</a>
</div>
</div>
{{include file="footer.tpl" page="home"}}
