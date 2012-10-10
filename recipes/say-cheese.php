<?php
/*
NAME:         Say cheese!
ABOUT:        Takes a photo from the webcam and stores it in Dropbox. Note: This command will not work on Windows. It has only been tested to work on Ubuntu 11.10
DEPENDENCIES: None;
INSTALL:      You may need to install ffmpeg if it isn't already;
CONFIG:       Change the locatoin of your webcam and where you would like the image to be stored;
*/
$date = date('Y/m/d/H-i');
if (!file_exists("/home/jacob/Dropbox/Alice/webcam/".date('Y/m/d/'))) mkdir("/home/jacob/Dropbox/Alice/webcam/".date('Y/m/d/'), 0755, true);
if (!(date('Hi') % 2))
{
	exec("ffmpeg -f video4linux2 -i /dev/video0 -vframes 1 /home/jacob/Dropbox/Alice/webcam/$date.jpg");
	copy("/home/jacob/Dropbox/Alice/webcam/$date.jpg", "/home/jacob/Dropbox/Alice/webcam/latest.jpg");
}
?>
