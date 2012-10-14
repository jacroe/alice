Daily email for {{$date}}
<h1>{{$date}} - {{$city}}, {{$state}}</h1>
<h2>Weather</h2>
{{$weather}}
<h2>What you should wear</h2>
For right now in {{$city}}, you should wear {{$clothes.top}} and {{$clothes.bottom}}. Keep in mind though, the high for today will be {{$clothes.hi}}F. {{if $clothes.extra}}You may also want to have {{$clothes.extra}}.{{/if}}
