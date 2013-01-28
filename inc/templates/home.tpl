{{include file="header.tpl" page="home"}}
<div class="container">

<div class="hero-unit">
<h1>{{$masthead}}</h1>
<p>{{$subhead}}</p>
</div>

<div class="row">

<div class="span4">
<h2>Bedroom</h2>
<table class="table table-bordered table-condensed">
<tbody>
{{foreach $bedroom_x10 as $device}}
{{if $device.type == "lamp"}}
<tr>
	<td><strong>{{$device.name}}</strong></td>
	<td>
	  <a class="{{$device.code}}_on btn btn-success btn-small{{if $device.curState > 0}} disabled{{/if}}" onclick='$.post("api.php",{"x10":"{{$device.code}}","do":"on"});$("a.{{$device.code}}_on").addClass("disabled");$("a.{{$device.code}}_off").removeClass("disabled");$("a.{{$device.code}}_brighten").addClass("disabled");$("a.{{$device.code}}_dim").removeClass("disabled");'>On</a>
	  <a class="{{$device.code}}_off btn btn-danger btn-small{{if !$device.curState}} disabled{{/if}}" onclick='$.post("api.php",{"x10":"{{$device.code}}","do":"off"});$("a.{{$device.code}}_on").removeClass("disabled");$("a.{{$device.code}}_off").addClass("disabled");$("a.{{$device.code}}_brighten").removeClass("disabled");$("a.{{$device.code}}_dim").addClass("disabled");'>Off</a>
	  <a class="{{$device.code}}_brighten btn btn-small{{if $device.curState == 10}} disabled{{/if}}" onclick='$.post("api.php",{"x10":"{{$device.code}}","do":"brighten"});$("a.{{$device.code}}_on").addClass("disabled");$("a.{{$device.code}}_off").removeClass("disabled");$("a.{{$device.code}}_dim").removeClass("disabled");'>Brighten</a>
	  <a class="{{$device.code}}_dim btn btn-small{{if !$device.curState}} disabled{{/if}}" onclick='$.post("api.php",{"x10":"{{$device.code}}","do":"dim"});$("a.{{$device.code}}_brighten").removeClass("disabled");'>Dim</a>
	</td>
</tr>
{{else}}
<tr>
	<td><strong>{{$device.name}}</strong></td>
	<td>
	  <a class="{{$device.code}}_on btn btn-success btn-small{{if $device.curState > 0}} disabled{{/if}}" onclick='$.post("api.php",{"x10":"{{$device.code}}","do":"on"});$("a.{{$device.code}}_on").addClass("disabled");$("a.{{$device.code}}_off").removeClass("disabled");'>On</a>
	  <a class="{{$device.code}}_off btn btn-danger btn-small{{if !$device.curState}} disabled{{/if}}" onclick='$.post("api.php",{"x10":"{{$device.code}}","do":"off"});$("a.{{$device.code}}_off").addClass("disabled");$("a.{{$device.code}}_on").removeClass("disabled");'>Off</a>
	</td>
</tr>
{{/if}}
{{/foreach}}
</tbody>
</table>
</div>

<div class="span4">
<h2>Webcam</h2>
<img src="{{$webcamImg}}" alt="Latest captured image from the webcam"/>
</div>

</div>
{{include file="footer.tpl" page="home"}}
