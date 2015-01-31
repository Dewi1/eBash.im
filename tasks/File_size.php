<?php
/**
 * @package File_size
 * @version 1.0
 */
/*
Plugin Name: File_size
Plugin URI: https://test.ru/wordpress/
Description: File_size
Armstrong: My Plugin.
Author: Dewi1
Version: 1.0
Author URI: https://test.ru/wordpress/
*/
function pict_info() {
    if(upload_gallery_image()) {//str. 1566 in "gallery-plugin.php"
        if(save()){
            $text = '';
            $name = getName();
            $size = getSize();
            list($width, $height, $type, $attr) = getimagesize($name);
            $string = write_string($name, $size, $type, $width, $height);
            file_put_contents($text, $string);
            file_download($text);
        }
    }
}
function write_string($name, $size, $type, $width, $height, $string = 0){
    $string .= 'Name: '.$name.'Type: '.$type.'Size: '.$size.'Width: '.$width.'Height: '.$height;
    return $string;
}
function file_download($text) {
    if (ob_get_level()) {
        ob_end_clean();
    }
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="Pictures_info.txt"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($text));
    echo $text;

    return $text;
}