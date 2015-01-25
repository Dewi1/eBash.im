<?php
headers();
function html_title() {
    includes();
}
function html_printer() {
    includes();
}
function html_parser() {
    $arr_text = get_jokes();
    includes();
}
function html_choice() {
    includes();
    if($_POST['save'] == "Сохранить"){
        echo '<center><br>';
            $arr_max = max_page();
            $first_num = $_POST['first']; $last_num = $_POST['last'];
            if ($last_num >= $first_num){
                echo '<div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 16px" align="center">';
                echo 'В базу данных были сохранены страницы цитат:<br><br>';
                for ($num = $first_num; $num <= $last_num; $num++) {
                    if ($num <= $arr_max[1]) {
                        $result_joke = save_page($num);
                        echo 'Страница_' . $num . '<br>';
                    } else {
                        echo 'Страница_' . $num . ' не была сохранена. <br></div>';
                    }
                }
            }else {
                echo 'Файлы не были сохранены.';
            }
            if  ($num > $arr_max[1]){
                echo 'Таких страниц не существует.';
            }
        echo '</center>';
    }
}
function login() {
    includes();
    if($_POST["submit2"]=='Вход') {
        $login_check = $_POST["login"];
        if (is_login($login_check)) {
            $login = $_POST["login"];
        } else {
            echo '<center><h2>Логин введен не корректно!<h2></center>';
            $login = false;
        }
        $pass_check = $_POST["pass"];
        if (is_pass($pass_check)) {
            $password = sha1($_POST["pass"]);
        } else {
            echo '<center><h2>Пароль введен не корректно!<h2></center>';
            $password = false;
        }
        $users = login_in($password, $login);
        header( 'Refresh: 0; url=http://bash.zz.vc/index.php?page=login' );
    }
    if($_POST["submit1"]=='Выход') {
        $_SESSION['auth'] = null;
        echo '<br><br><center><h2>Вы вышли из системы!</h2></center>';
        header( 'Refresh: 0; url=http://bash.zz.vc/index.php?page=login' );
    }
}
function register() {
    includes();
    if($_POST["sex"]=="male"){
        $sex = "male";
    }
    if($_POST["sex"]=="female") {
        $sex = "female";
    }
    if($_POST["submit"] == "Сохранить") {
        $login_check = $_POST["login"];
        if (is_login($login_check)) {
            $login = $_POST["login"];
        } else {
            echo '<center><h2>Логин введен не корректно!<h2></center>';
            $login = false;
        }
        $pass_check = $_POST["password"];
        if (is_pass($pass_check)) {
            $password = sha1($_POST["password"]);
        } else {
            echo '<center><h2>Пароль введен не корректно!<h2></center>';
            $password = false;
        }
        $name_check = $_POST["name"];
        if (is_name($name_check)) {
            $name = $_POST["name"];
        } else {
            echo '<center><h2>Имя введено не корректно!<h2></center>';
            $name = false;
        }
        $email_check = $_POST["email"];
        if (is_email($email_check)) {
            $email = $_POST["email"];
        } else {
            echo '<center><h2>Email введен не корректно!<h2></center>';
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
        if($_POST["submit"] == "Сохранить" && $_POST["login"] == "") {
            echo '<center><h2>Поле "Логин" не должно быть пустым!<h2></center>';
        }
        if($_POST["submit"] == "Сохранить" && $_POST["password"] == "") {
            echo '<center><h2>Поле "Пароль" не должно быть пустым!<h2></center>';
        }
        if($_POST["submit"] == "Сохранить" && $_POST["email"] == "") {
            echo '<center><h2>Поле "E-mail" не должно быть пустым!<h2></center>';
        }
        if($_POST["submit"] == "Сохранить" && $_POST["password"] != "" && $_POST["login"] != "" && $_POST["email"] != ""&& $password != false && $login != false && $name != false && $email != false) {
            echo '<h2>Поздравляем! Вы успешно зарегестрировались на нашем сайте!</h2>';
            $register = registration($login, $password, $name, $email, $about, $sex, $date);
        }
    echo '</center>';
}
function save_file() {
    include 'templates/save_file.php';
}
function profile() {
    includes();
}
function profile_saves() {
    includes();
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
