<!doctype html>
<html>
<head>
<style type="text/css">
	th, td {padding-right: 10px;}
	input {width:70px;}
</style>
</head>
<body>
{{assign var=price value=0}}
<h1>Grocery List</h1>
<table>
<tr><th>&#x2713;</th><th>Name</th><th>Section</th><th>Aisle</th><th>Price</th><th>New Price</th></tr>
{{foreach $data as $section}}
{{foreach $section as $item}}
{{if $item.needed}}<tr><td>&#x2610;</td><td>{{$item.name}}{{if $item.needed > 1}} (Qty: {{$item.needed}}){{/if}}</td><td>{{$item.section}}</td><td>{{$item.aisle}}</td><td>${{($item.price*$item.needed)|string_format:"%.2f"}}</td><td><input type="text" /></td></tr>
{{assign var=price value=$price+$item.price*$item.needed}}
{{/if}}
{{/foreach}}
{{/foreach}}
</table>
<hr />
<p>Total ${{$price}} + tax (about ${{round($price*1.07, 2)}})</p>
</body>
</html>