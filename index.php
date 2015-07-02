<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
require 'model/shop_functions.php';
require 'model/authorisation.php';
require 'model/registration.php';
require 'model/functions.php';
require 'model/database.php';
require 'model/check.php';
require 'model/Cart.php';
require 'controllers.php';
//error_reporting(E_ALL);
open_database_connection();

$page = null;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $_SESSION['page'] = $page;
}
$private_pages = array('Profile_items', 'Profile_orders', 'Design', 'Basket', 'Shop', 'Result', 'Profile_donates', 'Success', 'Fail', 'Donate', 'choice', 'save', 'Profile', 'Profile_saves', 'save_file', 'Gallery');
$key = array_search($page, $private_pages);
if ($key !== false && !isAuthorized()){
    header( 'Refresh: 0; url=/index.php?page=login' );
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
    case "Gallery":
        gallery();
        break;
    case "Donate":
        donate();
        break;
    case "Success":
        success();
        break;
    case "Fail":
        fail();
        break;
    case "Result":
        result();
        break;
    case "Profile_donates":
        profile_donates();
        break;
    case "Donate_choice":
        donate_choice();
        break;
    case "Shop":
        shop();
        break;
    case "Basket":
        basket();
        break;
    case "Design":
        design();
        break;
    case "Profile_orders":
        profile_orders();
        break;
    case "Profile_items":
        profile_items();
        break;
    case "ajax-cart-update":
        actions();
        break;

    default:
        echo '<html><body><h1>404: Page not found!</h1></body></html>';
        break;
}
