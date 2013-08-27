<hr>
<footer>
{{if $updateTime}}
<p>Last updated at {{$updateTime}} in {{$updateCity}}. <a href="#" onclick="aliceSetLocation();return false;">Purge</a> </p>
{{/if}}
{{if $dispLicense}}
{{if $rt}}
<p>Reviews provided by <a href=http://rottentomatoes.com>Rotten Tomatoes</a>. Flixster, Rotten Tomatoes, and the Certified Fresh Logo are trademarks or registered trademarks of Flixster, Inc. in the United States and other countries.</p>
{{/if}}
{{if $weather}}
<p><img src=./inc/images/wundergroundLogo.png class=pull-left /> Weather information provided by <a href="http://www.wunderground.com/?apiref=c8bf8532378d1e09">wunderground.com</a>
{{/if}}
{{/if}}
</footer>

</div> <!-- /container -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="./lib/bootstrap/js/jquery.js"></script>
<script src="./lib/bootstrap/js/bootstrap.min.js"></script>
<script>
function aliceAPI(jsonData)
{
	$.post("api.php", {json:JSON.stringify(jsonData)});
}
function aliceSetLocation()
{
	navigator.geolocation.getCurrentPosition(
		function(position)
		{
			var latitude = position.coords.latitude;
			var longitude = position.coords.longitude;
			$.post(
				"api.php",
				{json:JSON.stringify({"method":"Location.Set","params":{"lat":latitude,"lon":longitude}})},
				function(returnData){ window.location.href = "cron.php?purge={{$page}}"; }
			);
		},
		function(err)
		{
			alert('ERRORS');
		},
		{enableHighAccuracy: true}
	);
}
</script>
</body>
</html>
