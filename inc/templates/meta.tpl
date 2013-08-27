{{include file="header.tpl" page="meta"}}
<div class="jumbotron">
	<h1>{{$masthead}}</h1>
	<p>{{$subhead}}</p>
</div>

<div class="row">

<div class="col-md-4">
	<h2>Services</h2>
	<table class="table table-bordered table-condensed">
		<tbody>
		{{foreach $serviceList as $service}}
		<tr><td><strong>{{$service.title}}</strong></td><td><span class={{if $service.status == 1}}text-warning{{elseif $service.status == 2}}text-error{{else}}text-success{{/if}}>{{$service.message}}</span></td></tr>
		{{/foreach}}
		</tbody>
	</table>
</div>

<div class="col-md-8">
	<h2>Error log</h2>
	<pre class=.pre-scrollable>{{$errorLog}}</pre>
</div>

</div>
{{include file="footer.tpl" page="meta"}}
