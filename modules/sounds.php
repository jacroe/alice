<?php
/*
NAME:         Play Sounds
ABOUT:        Plays a specified sound as called by other modules/recipes
DEPENDENCIES: None;
*/
function alice_sound_play($file)
{
	$file = str_replace(" ", "-", $file);
	exec('nohup mpg123 '.PATH.'sounds/'.$file.'.mp3 > /dev/null 2>&1 & echo $!');
}
?>
