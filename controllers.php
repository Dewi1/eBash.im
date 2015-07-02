<?php
headers();
function html_title() {
    $user_name = $_SESSION['user'];
    render_template($arguments = array('user_name' => $user_name), $file = 'title');
}
function html_printer() {
    $arr_text = get_jokes();
    $max_page = max_page();
    $page = $max_page;
    if($_POST["submit"] == "Следующая") {
        $arr_text = get_jokes($url = 'http://bash.im/index/' . $page);
    }
    /*if(!isset($_POST["submit"])){
        $i = 0;
    }
    if($_POST["submit"] == "Следующая") {
        $i++;
        $page -= $i;
        $arr_text = get_jokes($url = 'http://bash.im/index/'. $page);
    }*/
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
    $redirect_uri = 'http://ebash.local/index.php?page=login';
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
    //-----
    $captcha = null;
    if($_POST["login"]=='Вход' && $resp != null && $resp->success) {
        $login_check = $_POST["username"];
        if (is_login_or_password($login_check)) {
            $login = $_POST["username"];
        } else {
            $login = false;
        }
        $pass_check = sha1($_POST["password"]);
        if (is_login_or_password($pass_check)) {
            $password = $pass_check;
        } else {
            $password = false;
        }
        if($login == true && $password == true) {
            $users = login_in($password, $login);
        }
        if(!$users) {
            $login = false;
            $password = false;
        }
        $captcha = true;
        $is_authorised = true;
    }else{
        $captcha = false;
    }
    if($_POST["logout"]=='Выход') {
        $_SESSION['auth'] = null;
        //header( 'Refresh: 0; url=/index.php?page=login' );
    }
    $user_name = $_SESSION['user'];
    render_template($arguments = array('captcha' => $captcha, 'user_name' => $user_name, 'params' => $params, 'url' => $url, 'is_authorised' => $is_authorised, 'siteKey' => $siteKey, 'password' =>$password, 'login' => $login), $file = 'login');
}
function register() {
    //Upload image
    if(isset($_SESSION['image'])) {
        echo '<br><br><br><br><br>'.$_SESSION['image'];
    }

    //Register form
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
        }else{
            $name = false;
        }
        $email_check = $_POST["email"];
        if (is_email($email_check)) {
            $email = $_POST["email"];
        } else {
            $email = false;
        }
        $about = htmlspecialchars($_POST["about"]);
    }
    $month_word = $_POST["month"];
    $month = month($month_word);
    $day = $_POST["day"];
    $year = $_POST["year"];
    $date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
    if($_POST["submit"] == "Сохранить")
    {
        $register = 1;
    }
    if($_POST["submit"] == "Сохранить" && $_POST["password"] != "" && $_POST["login"] != "" && $_POST["email"] != "" && $password != false && $login != false && $email != false) {
        $register = 2;
        registration($login, $password, $name, $email, $about, $sex, $date);
    }else{
        $register = 0;
    }
    render_template($arguments = array('password' => $password, 'login' => $login, 'email' => $email, 'register' => $register), $file = 'register');
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
    $saved = false;
    if($_POST["import"] == "Импорт") {
        $current = file_get_contents("http://heaven.zz.mu/?page_id=169");
        $current = prepare_joke($current);
        file_put_contents("XML_parser.xml", $current);
        $str = file_get_contents("XML_parser.xml");
        $xml = new SimpleXMLElement($current);
        $key = 0;
        foreach ($xml as $el)
        {
            $url[$key] = $el->url;
            $name[$key] = $el->name;
            $width[$key] = $el->width;
            $height[$key] = $el->height;
            $key++;
        }
        $saved = true;
    }
    render_template($arguments = array('url' => $url, 'name' => $name, 'width' => $width, 'height' => $height, 'saved' => $saved), $file = 'gallery');
}
function donate() {
    $url = 'https://auth.robokassa.ru/Merchant/PaymentForm/FormMS.js';
    $user_name = $_SESSION['user'];
    if($_POST["submit"] == 'Donate'){
        $paid = $_POST['pay'];
        $_SESSION['pay'] = $paid;
        header('Refresh: 0; url=/index.php?page=Donate_choice');
    }
    render_template($arguments = array('user_name' => $user_name, 'url' => $url, 'paid' => $paid), $file = 'donate');
}
function success() {
    $user_name = $_SESSION['user'];
    $paid = $_SESSION['pay'];
    $paid_date = date("Y-m-d h:i:s");
    $user_id = $_SESSION['user_id'];
    donate_add($paid_date, $paid, $user_id);
    render_template($arguments = array('pay' => $paid, 'user_name' => $user_name), $file = 'success');
}
function fail() {
    $user_name = $_SESSION['user'];
    if ($_POST['orderId'] != '') {
        $orderId = $_POST['orderId'];
        orderFail($orderId);
    }
    render_template($arguments = array('user_name' => $user_name), $file = 'fail');
}
function result() {
    $mrh_pass2 = "pass2222";
    $inv_id = $_REQUEST["InvId"];
    $out_summ = $_REQUEST["OutSum"];
    $shp_item = $_REQUEST["Shp_item"];
    $crc = $_REQUEST["SignatureValue"];

    if ($_POST['orderId'] != '') {
        $orderId = $_POST['orderId'];
        orderPayed($orderId);
    }
    $userId = $_SESSION['user_id'];

    $items = Cart::getInstance()->getAll();
    foreach ($items as $itemId => $count) {
        $item = checkItemInProfile($itemId, $userId);
        if($item != false) {
            addItemToProfile($itemId, $userId);
            updateAmountInProfile($itemId, $userId, $count);
        }else{
            updateAmountInProfile($itemId, $userId, $count);
        }
    }

    $crc = strtoupper($crc);
    $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:Shp_item=$shp_item"));
    if ($my_crc !=$crc)
    {
        echo "Ошибка: подпись не корректна.\n";
        exit();
    }
    if ($_POST['SignatureValue'] != md5($out_summ . ":" . $id . ":" . $mrh_pass2)) {
        echo "Ошибка: не совпала контрольная сумма\n";
        exit();
    }
    echo "OK$inv_id\n";
    exit();
}
function profile_donates() {
    $sum_paid = summary_paid();
    $user_id = $_SESSION['user_id'];
    $paids = get_paid($user_id);
    $user_name = $_SESSION['user'];
    render_template($arguments = array('sum_paid' => $sum_paid, 'paids' => $paids, 'user_name' => $user_name), $file = 'profile_donates');
}
function donate_choice() {
    $user_name = $_SESSION['user'];
    render_template($arguments = array('user_name' => $user_name), $file = 'donate_choice');
}
function shop() {
    $items = takeAllItems();
    $inBasket = false;
    if($_POST['order'] == "В корзину") {
        $itemId = $_POST["item_id"];
        $count = $_POST["count"];
        if(Cart::getInstance()->isAdded($itemId) == true) {
            $inBasket = true;
            $inBasketId = $itemId;
        }else{
            Cart::getInstance()->add($itemId, $count);
        }
    }
    if($_POST['orderCancel'] == "Отменить заказ") {
        $userId = $_SESSION['user_id'];
        $orderId = getOrderByUserId($userId);
        orderCancel($orderId);
    }
    render_template($arguments = array('inBasketId' => $inBasketId, 'inBasket' => $inBasket, 'items' => $items), $file = 'shop');
}
function basket() {
    $userName = $_SESSION['user'];
    $userId = $_SESSION['user_id'];
    $items = Cart::getInstance()->getAll();
    $count = $_POST['count'];
    $itemId = $_POST['item_id'];
    $totalSum = takeTotalSum($items);
    if($_POST['order1'] == "Изменить") {
        Cart::getInstance()->setCount($itemId, $count);
        header('Refresh: 0; url=/index.php?page=Basket');
    }
    if($_POST['order2'] == "Удалить") {
        Cart::getInstance()->remove($itemId);
        header('Refresh: 0; url=/index.php?page=Basket');
    }
    if($_POST['delete'] == "Очистить корзину") {
        Cart::getInstance()->clear();
        header('Refresh: 0; url=/index.php?page=Basket');
    }
    if($_POST['save'] == "Сохранить заказ") {
        $orderId = createNewOrder($userId);
        foreach ($items as $itemId => $count) {
            addItemsToDB($itemId, $count, $orderId, $totalSum);
        }
        Cart::getInstance()->clear();
        header('Refresh: 0; url=/index.php?page=Shop');
    }
    render_template($arguments = array('totalSum' => $totalSum, 'userId' => $userId, 'items' => $items, 'userName' => $userName), $file = 'basket');
}
function design() {
    $userId = $_SESSION['user_id'];
    $items = Cart::getInstance()->getAll();
    $totalSum = takeTotalSum($items);
    if($_POST['submit'] == "Оформить заказ") {
        $address = $_POST['address'];
        $orderId = createNewOrder($userId);
        foreach ($items as $itemId => $count) {
            addItemsToDB($itemId, $count, $orderId, $totalSum);
        }
        addNewAddress($address, $userId);
    }
    if($_POST['submit'] == "Оплатить") {
        $orderId = $_POST['order_id'];
        $totalSum = takeTotalSumWithId($orderId);
        $itemsTakeFromBD = takeItemsIds($orderId);
    }else{
        $totalSum = takeTotalSum($items);
        $orderId = getOrderByUserId($userId);
        $itemsTakeFromBD = takeItemsIds($orderId);
    }
    render_template($arguments = array('orderId' => $orderId, 'itemsTakeFromBD' => $itemsTakeFromBD, 'items' => $items, 'totalSum' => $totalSum), $file = 'design');
}
function profile_orders() {
    $userId = $_SESSION['user_id'];
    $orders = takeAllOrders($userId);
    render_template($arguments = array('orders' => $orders), $file = 'profile_orders');
}

function profile_items() {
    $userId = $_SESSION['user_id'];
    $items = takeAllUserItems($userId);
    render_template($arguments = array('items' => $items), $file = 'profile_items');
}
function actions() {
    $count = $_POST['count'];
    $itemId = $_POST['item_id'];
    //--------------------------
    $newCount = $_POST['count'];
    $oldCount = $_POST['oldCount'];
    $itemPrice = $_POST['itemPrice'];
    $oldTotalSum = $_POST['oldTotalSum'];
    $totalItemsSum = $newCount*$itemPrice;
    $totalSum = Cart::getInstance()->totalSum($oldTotalSum, $newCount, $oldCount, $itemPrice);
    //---------------------------------------
    if($count != false && $itemId != false) {
        Cart::getInstance()->setCount($itemId, $count);
    }
    $json = $itemId.', '.$count;
    echo json_decode($json);

    render_template($arguments = array('totalItemsSum' => $totalItemsSum,'totalSum' => $totalSum), $file = 'actions');
}
