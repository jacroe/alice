{{include file="header.tpl" page="xbmc"}}
<div class="hero-unit">
<h1>{{$masthead}}</h1>
{{if $nextEpisodeID}}
<p><a class="btn btn-primary" onclick='aliceAPI({"method":"XBMC.PlayEpisode","params":{"type":"next","showid":"{{$showid}}"}});'><i class="icon-play icon-white"></i> Play next episode</a> <a class="btn" onclick='aliceAPI({"method":"XBMC.PlayEpisode","params":{"type":"last","showid":"{{$showid}}"}});'><i class="icon-play"></i> Play latest</a></p>
{{else}}
<p>All episodes watched</p>
{{/if}}
</div>


<div class="row">

<div class="span5">
<h2>Fanart</h2>
<p><img src="./inc/image.php?i=xbmcShowFanart_{{$showid}}" width=400 alt="Fanart" /></p>
</div>

<div class="span7">
<h2>Episodes</h2>
<p>
{{foreach $arrayEpisodes as $episode}}
{{if $season != $episode->season}}
{{assign var='season' value=$episode->season}}
{{if $season == 0}}
<strong>Specials</strong><br />
{{else}}
<strong>Season {{$season}}</strong><br />
{{/if}}
{{/if}}
<a class="btn btn-mini" onclick='aliceAPI({"method":"XBMC.PlayEpisode","params":{"id":"{{$episode->episodeid}}"}});'><i class=icon-play></i></a>
{{if $episode->playcount}}<i class=icon-ok></i> {{/if}}
{{$episode->episode}}. {{$episode->title}}<br />
{{/foreach}}
</p>
</div>
</div>
{{include file="footer.tpl"}}
