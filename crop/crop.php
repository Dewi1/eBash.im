<?php
$dir = '../crop/';
$filename = 'photo.jpg';
$new_filename = 'photo1.jpg';
$file_dir = $dir . $filename;
$new_file_dir = $dir . $new_filename;
//die(print_r($_POST));

list($current_width, $current_height) = getimagesize($file_dir);

$x1 = $_POST['x1'];
$y1 = $_POST['y1'];
$x2 = $_POST['x2'];
$y2 = $_POST['y2'];
$w = $_POST['w'];
$h = $_POST['h'];

//die(print_r($_POST));

$crop_width = 100;
$crop_height = 100;

$new = imagecreatetruecolor($crop_width, $crop_height);
$current_image = imagecreatefromjpeg($file_dir);
imagecopyresampled($new, $current_image, 0, 0, $x1, $y1, $crop_width, $crop_height, $w, $h);
imagejpeg($new, $new_file_dir, 95);

header( 'Refresh: 0; url=/index.php?page=register' );
