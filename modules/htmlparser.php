<?php
/*
NAME:         Simple HTML DOM Parser
ABOUT:        Ridiculously simple method of parsing HTML
DEPENDENCIES: Simple HTML DOM Parser library;
*/
function alice_htmlparser_find($data, $find, $isUrl = false, $element = null)
{
	require_once(PATH."lib/simplehtmldom/simple_html_dom.php");

	if($isUrl)
		$html = file_get_html($data);
	else
		$html = str_get_html($data);

	return $html->find($find, $element);
}