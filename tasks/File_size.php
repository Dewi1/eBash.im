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
function picture_get_db() {
    global $wpdb;
    $result_parent_id	=	$wpdb->get_results( $wpdb->prepare( "SELECT ID FROM " . $wpdb->posts . " WHERE post_type = %s", 'gallery' ) , ARRAY_N );
    $array_parent_id	=	array();
    while ( list( $key, $val ) = each( $result_parent_id )) {
        $array_parent_id[] = $val[0];
    }
    $string_parent_id = implode( ",", $array_parent_id );
    $result_attachment_id = $wpdb->get_results( "SELECT `ID` FROM " . $wpdb->posts . " WHERE `post_type` = 'attachment' AND `post_mime_type` LIKE 'image%' AND `post_parent` IN (" . $string_parent_id . ")" );
    echo json_encode( $result_attachment_id );
}
function picture_get_info() {
    if ( $this->file->save( $uploadDirectory . $filename . '.' . $ext ) ){
        list( $width, $height, $type, $attr ) = getimagesize( $uploadDirectory . $filename . '.' . $ext );
        return "{success:true,width:" . $width . ",height:" . $height . "}";
    }
}
function save_xml_info($names, $types, $widths, $heights) {
    $dom = new domDocument("1.0", "utf-8");
    $root = $dom->createElement("pictures");
    $dom->appendChild($root);
    for ($i = 0; $i < count($names); $i++) {
        $id = $i + 1;
        $picture = $dom->createElement("picture");
        $picture->setAttribute("id", $id);
        $name = $dom->createElement("name", $names[$i]);
        $type = $dom->createElement("type", $types[$i]);
        $width = $dom->createElement("width", $widths[$i]);
        $height = $dom->createElement("height", $heights[$i]);
        $picture->appendChild($name);
        $picture->appendChild($type);
        $picture->appendChild($width);
        $picture->appendChild($height);
        $root->appendChild($picture);
    }
    $dom->save("Gallery.xml");
}
