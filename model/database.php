<?php
function open_database_connection()
{
    include(__DIR__ . DS . '..' . DS . 'config.php');
    $myConnect = mysql_connect($db_host, $db_username, $db_password);
    mysql_select_db($db_name,$myConnect);
    mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
    return $myConnect;
}
function qr_result_jokes($page){
    $qr_joke = mysql_query("SELECT * FROM joke where page_id = ".$page);
    $jokes = array();
    while ($joke = mysql_fetch_array($qr_joke)) {
        $jokes[] = $joke;
    }
    return $jokes;
}
function qr_result_users (){
    $users = $_SESSION['user_id'];
    $qr_user_page = mysql_query("select page_id from user_page where user_id = ".$users);
    $user_pages = array();
    while ($user_page = mysql_fetch_array($qr_user_page)) {
        $user_pages[] = $user_page;
    }
    return $user_pages;
}
function add_joke($number, $date, $rating, $joke, $page_id) {
    $result_joke = mysql_query("INSERT INTO joke (number_joke, date_joke, rating, joke, page_id) VALUES('$number', '$date', $rating, '$joke', $page_id)");
    return $result_joke;
}
function add_page($number_page) {
    $result_page = mysql_query("INSERT INTO page (number_page) VALUES($number_page)");
    return $result_page;
}
function add_user_page($num, $user_id) {
    $result_user_page = mysql_query("INSERT INTO user_page (page_id, user_id) VALUES($num, $user_id)");
    return $result_user_page;
}
