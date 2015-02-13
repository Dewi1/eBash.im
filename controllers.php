<?php
headers();
function html_title() {
    $user_name = $_SESSION['user'];
    render_template($arguments = array('user_name' => $user_name), $file = 'title');
}
function html_printer() {
    $arr_text = get_jokes();
    render_template($arguments = array('arr_text' => $arr_text), $file = 'printing');
}
function html_parser() {
    $arr_text = get_jokes();
    render_template($arguments = array('arr_text' => $arr_text), $file = 'save');
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
    render_template($arguments = array('savedPages' => $savedPages, 'notSavedPages' => $notSavedPages, 'saved' => $saved), $file = 'choice');
}
function login() {
    //vk_auth
    $client_id = '4766442';
    $client_secret = 'Ni6JaDROwPPricLPclgl';
    $redirect_uri = 'http://ebash.im/index.php?page=login';
    $url = 'http://oauth.vk.com/authorize';
    $params = array('client_id' => $client_id, 'redirect_uri'  => $redirect_uri, 'response_type' => 'code');
    echo '<br><br><br><br><br><br>';

    if (isset($_GET['code'])) {
        $result = 0;
        $params = array('client_id' => $client_id, 'client_secret' => $client_secret, 'code' => $_GET['code'], 'redirect_uri' => $redirect_uri);
        $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
    }
    if (isset($token['access_token'])) {
        $params = array(
            'uids'         => $token['user_id'],
            'fields'       => 'uid,first_name,last_name',
            'access_token' => $token['access_token']
        );
        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['uid'])) {
            $_SESSION['user'] = $userInfo['response'][0]['first_name'] .' ' . $userInfo['response'][0]['last_name'];
            $_SESSION['auth'] = true;
        }
    }

    //captcha
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
    $login = $_SESSION['user'];
    render_template($arguments = array('params' => $params, 'url' => $url, 'is_authorised' => $is_authorised, 'siteKey' => $siteKey, 'login' => $login), $file = 'login');
}
function register() {
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
    if($_POST["submit"] == "Сохранить" && $_POST["password"] != "" && $_POST["login"] != "" && $_POST["email"] != ""&& $password != false && $login != false && $name != false && $email != false) {
        $register = true;
        registration($login, $password, $name, $email, $about, $sex, $date);
    }
    render_template($arguments = array('password' => $password, 'name' => $name, 'login' => $login, 'email' => $email, 'register' => $register), $file = 'register');
}
function save_file() {
    $text = combine_jokes_to_string();
    $text = file_download($text);
}
function profile() {
    $user_name = $_SESSION['user'];
    render_template($arguments = array('user_name' => $user_name), $file = 'profile');
}
function profile_saves() {
    $user_pages = qr_result_users();
    $top = 92;
    if($_POST["read"] != false) {
        $page = $_POST["read"];
        $jokes = qr_result_jokes($page);
        $printing = true;
    }
    render_template($arguments = array('user_pages' => $user_pages, 'printing' => $printing, 'jokes' => $jokes, 'top' => $top), $file = 'profile_saves');
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
function gallery() {

    $xml = file_get_contents("http://heaven.zz.mu/?page_id=169");
    $regexp = "#<pre>(.+)</pre>#Uis";
    preg_match_all($regexp, $xml, $pic_xml, PREG_SET_ORDER);
    $xml_dom = $pic_xml[0][0];

    $saved = false;
    if($_POST["import"] == "Импорт") {
        $dom = new domDocument("1.0", "utf-8");
        //$dom->load($xml_dom);
        $dom = new SimpleXMLElement($xml_dom);
        $childs = $dom->documentElement->childNodes;
        for ($i = 0; $i < $childs->length; $i++) {
            $picture = $childs->item($i);
            $lp = $picture->childNodes;
            $id = $picture->getAttribute("id");
            $url = $lp->item(0)->nodeValue;
            $name = $lp->item(1)->nodeValue;
            $width = $lp->item(2)->nodeValue;
            $height = $lp->item(3)->nodeValue;
        }
        echo '<br><br><br><br><br><br>'.'url = ' . $picture;
        //$saved = true;
    }
    render_template($arguments = array('url' => $url, 'name' => $name, 'width' => $width, 'height' => $height, 'saved' => $saved), $file = 'gallery');
}
