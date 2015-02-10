<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
require 'model/authorisation.php';
require 'model/registration.php';
require 'model/functions.php';
require 'model/database.php';
require 'model/check.php';
require 'controllers.php';
//error_reporting(E_ALL);
open_database_connection();

$page = null;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $_SESSION['page'] = $page;
}
$private_pages = array('choice', 'save', 'Profile', 'Profile_saves', 'save_file');
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

    default:
        echo '<html><body><h1>404: Page not found!</h1></body></html>';
        break;
}
