<?php
/*
NAME:         X10
ABOUT:        Turns off and on X10 devices. Must be preset as shown
DEPENDENCIES: None
*/
function alice_x10_check($string)
{ 
	if(preg_match("/\blivingroom\b/i", $string))
	{
		if(preg_match("/\bon\b/i", $string)) {exec("nohup flipit flip j3 on > /dev/null 2>&1 & echo $!"); return true;}
		elseif(preg_match("/\boff\b/i", $string)) {exec("nohup flipit flip j3 off > /dev/null 2>&1 & echo $!"); return true;}
		elseif(preg_match("/\bbrighten\b/i", $string)) {exec("nohup flipit brighten j3 2 > /dev/null 2>&1 & echo $!"); return true;}
		elseif(preg_match("/\bdim\b/i", $string)) {exec("nohup flipit dim j3 2 > /dev/null 2>&1 & echo $!"); return true;}
		else return false;
	}
	elseif(preg_match("/\bbedroom\b/i", $string))
	{
		if(preg_match("/\bon\b/i", $string)) {exec("nohup flipit flip j2 on on > /dev/null 2>&1 & echo $!"); return true;}
		elseif(preg_match("/\boff\b/i", $string)) {exec("nohup flipit flip j2 off > /dev/null 2>&1 & echo $!"); return true;}
		elseif(preg_match("/\bbrighten\b/i", $string)) {exec("nohup flipit brighten j2 2 > /dev/null 2>&1 & echo $!"); return true;}
		elseif(preg_match("/\bdim\b/i", $string)) {exec("nohup flipit dim j2 2 > /dev/null 2>&1 & echo $!"); return true;}
		else return false;
	}
	elseif(preg_match("/\bbill\b/i", $string))
	{
		if(preg_match("/\on\b/i", $string)) {exec("nohup flipit flip j1 on > /dev/null 2>&1 & echo $!"); return true;}
		elseif(preg_match("/\off\b/i", $string)) {exec("nohup flipit flip j1 off > /dev/null 2>&1 & echo $!"); return true;}
		else return false;
	}
	else return false;
}

?>
