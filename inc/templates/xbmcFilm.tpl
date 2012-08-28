{{include file="header.tpl"}}
<div class="container">
<div class="hero-unit">
<h1>{{$masthead}}</h1>
<p>{{$subhead}}</p>
<p><a class="btn btn-primary btn-large" onclick='$.post("api.php", { movieid: {{$movieid}} } );'>Play &raquo;</a></p>
</div>


<div class="row">

<div class="span5">
<h2>Poster</h2>
<p><img src="{{$poster}}" width=300 /></p>
</div>

<div class="span7">
<h2>Information</h2>
<table class="table table-bordered table-condensed">
<tbody>
<tr><td><strong>Summary</strong></td><td>{{$summary}}</td></tr>
<tr><td><strong>Genre</strong></td><td>{{$genre}}</td></tr>
<tr><td><strong>Year</strong></td><td>{{$year}}</td></tr>
<tr><td><strong>Rating</strong></td><td>{{$mpaa}}</td></tr>
<tr><td><strong>Rotten Tomatoes</strong></td><td>{{$rtFreshness}}. {{$rtConsensus}}</td></tr>
<tr><td><strong>Runtime</strong></td><td>{{$runtime}} minutes</td></tr>
<tr><td><strong>Finish Time</strong></td><td>{{$finishtime}}</td></tr>
</tbody>
</table>
</div>
</div>
{{include file="footer.tpl"}}
