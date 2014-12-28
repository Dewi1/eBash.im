<?php
require 'model/functions.php';
require 'controllers.php';
//error_reporting(E_ALL);

$page = null;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
switch ($page) {
    case null:
    case "eBash.im":
        html_title();
        break;
    case "choice":
        html_choice();
        break;
    case "printing":
        html_printer();
        break;
    case "save":
        html_parser();
        break;
    default:
        echo '<html><body><h1>Page Not Found</h1></body></html>';
        break;
}
//сделать форму с какой до какой страницы..
//для каждой страницы своё имя. вывести имена созданных файлов (сколько файлов найдено, сколько - нет)
//и кнопку скачать главную страницу (как создать и скачать файл на пхп?). ограничитель на страницу
//прочитать про ресурсы b функции
// сделать страницу скачивания
