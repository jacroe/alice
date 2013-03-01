<?php
/*
NAME:         News
ABOUT:        Returns the top stories from USA Today
DEPENDENCIES: None;
*/
function alice_news($num = 5)
{
	if($num > 10) $num = 10;	// Default return by the API.
	$json = json_decode(file_get_contents("http://api.usatoday.com/open/articles/topnews/news?api_key=".USATODAY_API."&encoding=json"));
	for($i = 0; $i < $num; ++$i)
	{
		$arrayReturn[] = $json->stories[$i];
	}
	return $arrayReturn;
}
?>
