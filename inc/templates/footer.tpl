<hr>
<footer>
{{if $updateTime}}
<p>Last updated at {{$updateTime}} in {{$updateCity}}. <a href="cron.php?purge={{$page}}">Purge</a> </p>
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
<script src="./lib/bootstrap/js/bootstrap-collapse.js"></script>
<script src="./lib/bootstrap/js/bootstrap-modal.js"></script>
<script src="./lib/bootstrap/js/bootstrap-tab.js"></script>
<script>
function aliceAPI(jsonData)
{
	$.post("api.php", {json:JSON.stringify(jsonData)});
}
</script>
</body>
</html>
