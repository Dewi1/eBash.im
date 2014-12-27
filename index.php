<?php
require 'model/functions.php';
require 'controllers.php';

$page = null;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
switch ($page) {
    case null:
    case "bash":
        html_parser();
        break;
    default:
        echo '<html><body><h1>Page Not Found</h1></body></html>';
        break;
}
