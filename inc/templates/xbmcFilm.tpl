{{include file="header.tpl" page="xbmc"}}
<div class="jumbotron">
<h1>{{$masthead}}</h1>
<p>{{$subhead}}</p>
<p><a class="btn btn-primary" onclick='aliceAPI({"method":"XBMC.PlayFilm","params":{"id":"{{$movieid}}"}});'><span class="glyphicon glyphicon-play"></span> Play film</a></p>

</div>


<div class="row">

<div class="col-md-5">
<h2>Poster</h2>
<p><img src="./inc/image.php?i=xbmcFilmPoster_{{$movieid}}" width="300" class="img-responsive" alt="Poster" /></p>
</div>

<div class="col-md-7">
<h2>Information</h2>
<table class="table table-bordered table-condensed">
<tbody>
<tr><td><strong>Summary</strong></td><td>{{$summary}}</td></tr>
{{if $rtConsensus}}<tr><td><strong>Review</strong></td><td>{{$rtConsensus}} / {{$rtScore}}%</td></tr>{{/if}}
<tr><td><strong>Genre</strong></td><td>{{$genre}}</td></tr>
<tr><td><strong>Year</strong></td><td>{{$year}}</td></tr>
<tr><td><strong>Rating</strong></td><td>{{$mpaa}}</td></tr>
<tr><td><strong>Runtime</strong></td><td>{{$runtime}} minutes</td></tr>
<tr><td><strong>Finish Time</strong></td><td>{{$finishtime}}</td></tr>
</tbody>
</table>
</div>
</div>
{{include file="footer.tpl"}}
