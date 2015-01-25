<?php
function is_email($email_check) {
    if (! preg_match( '/^[-0-9a-z_\.]+@[-0-9a-z^\.]+\.[a-z]{2,4}$/i', $email_check)) {
        return false;
    } else {
        return true;
    }
}
function is_login($login_check) {
    if (! preg_match( '~^[A-Za-z0-9_\-]*$~i', $login_check)) {
        return false;
    } else {
        return true;
    }
}

function is_pass($pass_check) { //todo удалить, она такая же как is_login
    if (! preg_match( '~^[A-Za-z0-9_\-]*$~i', $pass_check)) {
        return false;
    } else {
        return true;
    }
}
function is_name($name_check) {
    if (! preg_match( '~^[A-Za-zА-Яа-я_\-]*$~i', $name_check)) {
        return false;
    } else {
        return true;
    }
}
