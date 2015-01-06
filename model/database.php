<?php
function open_database_connection()
{
    include(__DIR__ . DS . '..' . DS . 'config.php');
    $myConnect = mysql_connect($db_host, $db_username, $db_password); //соединяемся с сервером базы данных
    mysql_select_db($db_name,$myConnect);  //подключаемся к базе данных
    mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
    return $myConnect;
}
function qr_result_jokes (){
    $myConnect = open_database_connection();
    $qr_joke = mysql_query("SELECT * FROM joke");
    $jokes = array();
    while ($joke = mysql_fetch_array($qr_joke)) {
        $jokes[] = $joke;
    }
    mysql_close($myConnect);
    return $jokes;
}
function add_joke($number, $date, $rating, $joke, $page_id) {
    $myConnect = open_database_connection();
    $result_joke = mysql_query("INSERT INTO joke (number_joke, date_joke, rating, joke, page_id) VALUES('$number, $date, $rating, $joke, $page_id')");
    mysql_close($myConnect);
    return $result_joke;
}
function add_page($number) {
    $myConnect = open_database_connection();
    $result_page = mysql_query("INSERT INTO page (number) VALUES('$number')");
    mysql_close($myConnect);
    return $result_page;
}
function add_user_page($page_id, $user_id) {
    $myConnect = open_database_connection();
    $result_user_page = mysql_query("INSERT INTO user_page (page_id, user_id) VALUES('$page_id, $user_id')");
    mysql_close($myConnect);
    return $result_user_page;
}
