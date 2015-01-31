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
function picture_take_info() {
    if(upload_gallery_image()) {//str. 1566 in "gallery-plugin.php"
        if(save()){
            $text = '';
            $name = getName();
            $size = getSize();
            list($width, $height, $type, $attr) = getimagesize($name);
            save_xml_info($name, $size, $type, $width, $height);
        }
    }
}
function save_xml_info($name, $type, $width, $height) {
    $dom_xml= new DomDocument();
    $dom_xml->loadXML(
        '<picture>
            <name>'.$name.'</name>
            <type>'.$type.'</type>
            <width>'.$width.'</width>
            <height>'.$height.'</height>
        </picture>'
    );
    $path="Gallery.xml";
    echo $dom_xml->save($path);
}