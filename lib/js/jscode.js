$(document).ready(function (){
	/* hide Update Notes link and paragraph and show textbox */
	$("a.events").click(function(){
		$("article").slideUp("fast");
		$("section#main").slideUp("slow");
		$("section#events").slideDown("slow");
		return false;
	});
	$("a.xbmc").click(function(){
		$("section#main").slideUp("slow");
		$("section#xbmc").slideDown("slow");
		return false;
	});
	$("a.xbmcControls").click(function(){
		$("section#xbmc").slideUp("slow");
		$("section#xbmcControls").slideDown("slow");
		return false;
	});
	$("a.xbmcWatch").click(function(){
		$("section#xbmc").slideUp("slow");
		$("section#xbmcWatch").slideDown("slow");
		return false;
	});
	$("a.xbmcWatchMovies").click(function(){
		$("section#xbmcWatch").slideUp("slow");
		$("section#xbmcWatchMovies").slideDown("slow");
		return false;
	});
	$("a.xbmcWatchTV").click(function(){
		$("section#xbmcWatch").slideUp("slow");
		$("section#xbmcWatchTV").slideDown("slow");
		return false;
	});
	$("a.xbmcWatchTVEpi").click(function(){
		$("section#xbmcWatchTV").slideUp("slow");
		$("section#xbmcWatchTVEpi").slideDown("slow");
		return false;
	});
});
