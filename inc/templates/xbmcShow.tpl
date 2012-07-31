{{include file="header.tpl"}}
<div class="container">
<div class="hero-unit">
<h1>{{$masthead}}</h1>
<p>{{$subhead}}</p>
</div>


<div class="row">

<div class="span5">
<h2>Fanart</h2>
<p><img src="{{$fanart}}" width=400 /></p>
</div>

<div class="span7">
<h2>Shows</h2>
<p>
{{foreach $arrayEpisodes as $episode}}
{{if $season != $episode->season}}
{{assign var='season' value=$episode->season}}
<strong>Season {{$season}}</strong><br />
{{/if}}
<a class="btn btn-mini" onclick='$.post("api.php", { episodeid: {{$episode->episodeid}} } );'><i class=icon-play></i></a>
{{if $episode->playcount}}<i class=icon-ok></i> {{/if}}
{{$episode->episode}}. {{$episode->title}}<br />
{{/foreach}}
</p>
</div>
</div>
{{include file="footer.tpl"}}