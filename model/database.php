<?php
function open_database_connection()
{
    include(__DIR__ . DS . '..' . DS . 'config.php');
    $myConnect = mysql_connect($db_host, $db_username, $db_password);
    mysql_select_db($db_name,$myConnect);
    mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
    //mysql_close($myConnect)
    return $myConnect;
}
function qr_result_jokes($page){
    $myConnect = open_database_connection();
    $qr_joke = mysql_query("SELECT * FROM joke where page_id = ".$page);
    $jokes = array();
    while ($joke = mysql_fetch_array($qr_joke)) {
        $jokes[] = $joke;
    }
    return $jokes;
}
function qr_result_users (){
    $myConnect = open_database_connection();
    $users = user_id();
    $qr_user_page = mysql_query("select page_id from user_page where user_id = ".$users[0][0]);
    $user_pages = array();
    while ($user_page = mysql_fetch_array($qr_user_page)) {
        $user_pages[] = $user_page;
    }
    return $user_pages;
}
function add_joke($number, $date, $rating, $joke, $page_id) {
    $myConnect = open_database_connection();
    $result_joke = mysql_query("INSERT INTO joke (number_joke, date_joke, rating, joke, page_id) VALUES('$number', '$date', $rating, '$joke', $page_id)");
    return $result_joke;
}
function add_page($number_page) {
    $myConnect = open_database_connection();
    $result_page = mysql_query("INSERT INTO page (number_page) VALUES($number_page)");
    return $result_page;
}
function add_user_page($page_id, $user_id) {
    $myConnect = open_database_connection();
    $result_user_page = mysql_query("INSERT INTO user_page (page_id, user_id) VALUES($page_id, $user_id)");
    return $result_user_page;
}
function user_id(){
    $myConnect = open_database_connection();
    $user_id = mysql_query("select id from users where login = ".$_SESSION['user']);
    if (!$user_id) {
        die('Неверный запрос: ' . mysql_error());
    }
    $users = array();
    while ($user = mysql_fetch_array($user_id)) {
        $users[] = $user;
    }
    return $users;
}
