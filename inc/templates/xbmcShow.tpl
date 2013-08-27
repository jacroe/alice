{{include file="header.tpl" page="xbmc"}}
<div class="jumbotron">
<h1>{{$masthead}}</h1>
{{if $nextEpisodeID}}
<p><a class="btn btn-primary" onclick='aliceAPI({"method":"XBMC.PlayEpisode","params":{"type":"next","showid":"{{$showid}}"}});'><span class="glyphicon glyphicon-play"></span> Play next episode</a> <a class="btn btn-default" onclick='aliceAPI({"method":"XBMC.PlayEpisode","params":{"type":"last","showid":"{{$showid}}"}});'><span class="glyphicon glyphicon-play"></span> Play latest</a></p>
{{else}}
<p>All episodes watched</p>
{{/if}}
</div>


<div class="row">

<div class="col-md-5">
<h2>Fanart</h2>
<p><img src="./inc/image.php?i=xbmcShowFanart_{{$showid}}" width="400" class="img-responsive" alt="Fanart" /></p>
</div>

<div class="col-md-7">
<h2>Episodes</h2>
<p>
{{foreach $arrayEpisodes as $episode}}
{{if $season != $episode->season && $episode->season != 0}}
{{assign var='season' value=$episode->season}}
<strong>Season {{$season}}</strong><br />
{{/if}}
<a class="btn btn-default btn-xs" onclick='aliceAPI({"method":"XBMC.PlayEpisode","params":{"id":"{{$episode->episodeid}}"}});'><span class="glyphicon glyphicon-play"></span></a>
{{if $episode->playcount}}<span class="glyphicon glyphicon-ok"></span> {{/if}}
{{if $episode->season == 0}}S{{/if}}{{$episode->episode}}. {{$episode->title}}<br />
{{/foreach}}
</p>
</div>
</div>
{{include file="footer.tpl"}}
