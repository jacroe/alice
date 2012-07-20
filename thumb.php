<?php
function resize_image($file, $x=600) {
    $img = new Imagick($file);
    $img->thumbnailImage($x, $x, TRUE);

    return $img;
}
header('Content-Type: image/jpg');
echo resize_image("http://".$_GET['i'], $_GET['x']);
?>
