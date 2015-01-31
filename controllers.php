<?php
headers();
function html_title() {
    $user_name = $_SESSION['user'];
    includes($file = 'title');
}
function html_printer() {
    includes($file = 'printing');
}
function html_parser() {
    $arr_text = get_jokes();
    includes($file = 'save');
}
function html_choice() {
    $saved = false;
    $savedPages = array();
    $notSavedPages = array();
    $maxPageNumber = max_page();
    $first_num = $_POST['first'];
    $last_num = $_POST['last'];
    if($_POST['save'] == "Сохранить") {
        if ($last_num >= $first_num) {
            $saved = true;
            for ($num = $first_num; $num <= $last_num; $num++) {
                if ($num <= $maxPageNumber) {
                    save_page($num);
                    $savedPages[] = $num;
                } else {
                    $notSavedPages[] = $num;
                }
            }
        }
    }
    includes($file = 'choice');
}
function login() {
    require_once "recaptchalib.php";
    $siteKey = "6LfXPwETAAAAAKZHOFVAkgj0F7xQ0G0IbHgQm1_W";
    $secret = "6LfXPwETAAAAAEeeVwkU3EEnIMaNTTIHuxvuibtO";
    $lang = "ru";
    $resp = null;
    $error = null;
    $reCaptcha = new ReCaptcha($secret);
    if ($_POST["g-recaptcha-response"]) {
        $resp = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
    }
    if($_POST["login"]=='Вход' && $resp != null && $resp->success) {
        $login_check = $_POST["username"];
        if (is_login_or_password($login_check)) {
            $login = $_POST["username"];
        } else {
            $login = false;
        }
        $pass_check = $_POST["password"];
        if (is_login_or_password($pass_check)) {
            $password = sha1($_POST["password"]);
        } else {
            $password = false;
        }
        login_in($password, $login);
        $is_authorised = true;
        //header( 'Refresh: 0; url=/index.php?page=login' );
    }
    if($_POST["logout"]=='Выход') {
        $_SESSION['auth'] = null;
        //header( 'Refresh: 0; url=/index.php?page=login' );
    }
    //includes($file = 'login');
    ob_start();
    include 'templates/login.php';
    $content = ob_get_clean();
    include 'templates/layout.php';
}
function register() {
    includes($file = 'register');
    if($_POST["sex"]=="male"){
        $sex = "male";
    }
    if($_POST["sex"]=="female") {
        $sex = "female";
    }
    if($_POST["submit"] == "Сохранить") {
        $login_check = $_POST["login"];
        if (is_login_or_password($login_check)) {
            $login = $_POST["login"];
        } else {
            $login = false;
        }
        $pass_check = $_POST["password"];
        if (is_login_or_password($pass_check)) {
            $password = sha1($_POST["password"]);
        } else {
            $password = false;
        }
        $name_check = $_POST["name"];
        if (is_name($name_check)) {
            $name = $_POST["name"];
        } else {
            $name = false;
        }
        $email_check = $_POST["email"];
        if (is_email($email_check)) {
            $email = $_POST["email"];
        } else {
            $email = false;
        }
        $about = convert_uuencode($_POST["about"]); //convert_uudecode для конвертации в нормальный вид
    }
    $month_word = $_POST["month"];
    $month = month($month_word);
    $day = $_POST["day"];
    $year = $_POST["year"];
    $date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
    echo '<center>';
        if($_POST["submit"] == "Сохранить" && $_POST["password"] != "" && $_POST["login"] != "" && $_POST["email"] != ""&& $password != false && $login != false && $name != false && $email != false) {
            $register = true;
            registration($login, $password, $name, $email, $about, $sex, $date);
        }
    echo '</center>';
}
function save_file() {
    $text = combine_jokes_to_string();
    $text = file_download($text);
}
function profile() {
    $user_name = $_SESSION['user'];
    includes($file = 'profile');
}
function profile_saves() {
    $user_pages = qr_result_users();
    $top = 92;
    if($_POST["read"] != false) {
        $page = $_POST["read"];
        $jokes = qr_result_jokes($page);
        $printing = true;
    }
    includes($file = 'profile_saves');
}
function file_download($text) {
    if (ob_get_level()) {
        ob_end_clean();
    }
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="Bash.txt"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($text));
    echo $text;

    return $text;
}
