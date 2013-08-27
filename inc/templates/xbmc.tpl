{{include file="header.tpl" page="xbmc"}}
<div class="jumbotron">
<h1>{{$masthead}}</h1>
<p>{{$subhead}}</p>
</div>


<div class="row">
<div class="col-md-12">
<div class="page-header">
<h1>TV Shows</h1>
</div>
<div class="row">
{{foreach $arrayShows as $show}}
<div class="col-sm-6 col-md-3">
  <a href="xbmc.php?show={{$show->tvshowid}}" class="thumbnail"><img src="inc/image.php?i=xbmcShow_{{$show->tvshowid}}" alt="{{$show->label}}" /></a>
</div>
{{/foreach}}
</div>
</div>

<div class="col-md-12">
<div class="page-header">
<h1>Films</h1>
</div>
<div class="row">
{{foreach $arrayFilms as $film}}
<div class="col-sm-6 col-md-3">
  <a href="xbmc.php?movie={{$film->movieid}}" class=thumbnail><img src="inc/image.php?i=xbmcFilm_{{$film->movieid}}" alt="{{$film->label}}"/></a>
</div>
{{/foreach}}
</div>
</div>
</div>
{{include file="footer.tpl" page="xbmc"}}
