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
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');

function picture_get_db() {
    global $wpdb;
    $result_parent_id = $wpdb->get_results($wpdb->prepare("SELECT ID FROM " . $wpdb->posts . " WHERE post_type = %s", 'gallery'), ARRAY_N);
    $array_parent_id = array();
    while (list($key, $val) = each($result_parent_id)) {
        $array_parent_id[] = $val[0];
    }
    $string_parent_id = implode(",", $array_parent_id);
    $result_attachment_id = $wpdb->get_results("SELECT post_title FROM " . $wpdb->posts . " WHERE `post_type` = 'attachment' AND `post_mime_type` LIKE 'image%' AND `post_parent` IN (" . $string_parent_id . ")");
    //$urls = array();$names = array();$width = array();$height = array();
    for ($i=0; $i<count($result_attachment_id); $i++) {
        //$url = $result_attachment_id[$i]->guid;
        if($i == 0){
            $names[$i] = $result_attachment_id[$i]->post_title .'2.jpg';
        }else{
            $names[$i] = $result_attachment_id[$i]->post_title;
        }
        $url = $urls[$i] = "http://heaven.zz.mu/wp-content/uploads/2015/01/" . $names[$i];
        $size = picture_get_info($url);
        $widths[$i] = $size['width'];
        $heights[$i] = $size['height'];
    }
    save_xml_info($urls, $names, $widths, $heights);
}
function picture_get_info($url) {
    list( $width, $height, $type, $attr ) = getimagesize( $url );
    $size = array('width' => $width, 'height' => $height);
    return $size;
}
function save_xml_info($urls, $names, $widths, $heights) {
    $dom = new domDocument("1.0", "utf-8");
    $root = $dom->createElement("pictures");
    $dom->appendChild($root);
    for ($i = 0; $i < count($names); $i++) {
        $id = $i + 1;
        $picture = $dom->createElement("picture");
        $picture->setAttribute("id", $id);
        $url = $dom->createElement("url", $urls[$i]);
        $name = $dom->createElement("name", $names[$i]);
        $width = $dom->createElement("width", $widths[$i]);
        $height = $dom->createElement("height", $heights[$i]);
        $picture->appendChild($url);
        $picture->appendChild($name);
        $picture->appendChild($width);
        $picture->appendChild($height);
        $root->appendChild($picture);
    }
    $dom->formatOutput = true;
    $gallery = $dom->saveXML();
    $dom->save('Gallery.xml');
    echo htmlspecialchars($gallery);
}
function load_gallery () {
    picture_get_db();
}
add_shortcode ('l_gall', 'load_gallery');
