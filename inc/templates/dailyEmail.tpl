Daily email for {{$date}}
<h1>{{$date}} - {{$city}}, {{$state}}</h1>

<h2>Breaking News</h2>
{{$news}}

<h2>Weather</h2>
<strong>High:</strong> {{$weather.hiTemp}} <strong>Low:</strong> {{$weather.loTemp}}<br />
{{$weather.fcastToday}}

<h2>What you should wear</h2>
{{$clothes.top|ucfirst}} / {{$clothes.bottom|ucfirst}}{{if $clothes.extra}} / {{$clothes.extra}}.{{/if}}

<h2>Today in History</h2>
In {{$history[0]}}, {{$history[1]}}
