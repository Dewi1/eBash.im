<?php session_start();
function login_in($password=0, $login=0) {
    $myConnect = open_database_connection();
    $qr_result_users = mysql_query("select * from users where login='$login'");
    $users = array();
    while ($users = mysql_fetch_array($qr_result_users)) {
        if ($login == $users["login"] && $password == $users["password"]) {
            $_SESSION['auth'] = 'user';
            $_SESSION['user'] = $users["login"];
        }else{
            return false;
        }
    }
    mysql_close($myConnect);
    return $users;
}
function isAuthorized() {
    return $_SESSION['auth'] == true;
}
/*function sha1($get_pass){
    $pass = $get_pass;

    return $pass;
}*/
//сохранять пароль в хеш. пропускачть через функцию sha1() $pass = '123'; echo sha1($pass);