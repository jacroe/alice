{{assign var=price value=0}}
<h1>Grocery List</h1>
<table>
<tr><th>Name</th><th>Section</th><th>Aisle</th><th>Price</th></tr>
{{foreach $data as $section}}
{{foreach $section as $item}}
{{if $item.needed}}<tr><td>{{$item.name}}{{if $item.needed > 1}} (Qty: {{$item.needed}}){{/if}}</td><td>{{$item.section}}</td><td>{{$item.aisle}}</td><td>${{($item.price*$item.needed)|string_format:"%.2f"}}</td></tr>
{{assign var=price value=$price+$item.price*$item.needed}}
{{/if}}
{{/foreach}}
{{/foreach}}
</table>
<hr />
<p>Total ${{$price}} + tax (about ${{round($price*1.07, 2)}})</p>
