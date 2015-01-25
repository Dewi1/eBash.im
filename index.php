<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
require 'model/database.php';
require 'model/authorisation.php';
require 'model/registration.php';
require 'model/functions.php';
require 'model/check.php';
require 'controllers.php';
//error_reporting(E_ALL);

$page = null;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $_SESSION['page'] = $page;
}
// todo индекс 1 не нужен, читай что возвращает функция array_search
$private_pages = array(1 => 'choice', 'save', 'Profile', 'Profile_saves', 'save_file');
$key = array_search($page, $private_pages);
if ($key != 0 && $_SESSION['auth'] == false){
    // todo не использовать абсолютный адрес
    header( 'Refresh: 0; url=http://bash.zz.vc/index.php?page=login' );
}
switch ($page) {
    case null:
    case "eBash.im":
        html_title();
        break;
    case "choice":
        html_choice();
        break;
    case "Printing":
        html_printer();
        break;
    case "save":
        html_parser();
        break;
    case "login":
        login();
        break;
    case "register":
        register();
        break;
    case "save_file":
        save_file();
        break;
    case "Profile":
        profile();
        break;
    case "Profile_saves":
        profile_saves();
        break;
    default:
        echo '<html><body><h1>404: Page not found!</h1></body></html>';
        break;
}
