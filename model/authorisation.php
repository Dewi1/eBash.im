<?php
function login_in($password, $login) {
    $qr_result_users = mysql_query("select * from users where login='$login'");
    $users = mysql_fetch_array($qr_result_users);
    if ($password == $users["password"]) {
        $_SESSION['auth'] = 'user';
        $_SESSION['user'] = $users["login"];
        $_SESSION['user_id'] = $users["id"];
    }else{
        return false;
    }
    return $users;
}
function isAuthorized() {
    return $_SESSION['auth'] == true;
}
