<?php
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
function html_title() {
    ob_start();
    include 'templates/title.php';
    $content = ob_get_clean();
    include 'templates/layout.php';
}
function html_printer() {
    $arr_text = get_jokes();
    ob_start();
    include 'templates/printing.php';
    $content = ob_get_clean();
    include 'templates/layout.php';
}
function html_parser() {
    $arr_text = get_jokes();
    ob_start();
    include 'templates/save.php';
    $content = ob_get_clean();
    include 'templates/layout.php';
}
function html_choice() {
    ob_start();
    include 'templates/choice.php';
    $content = ob_get_clean();
    include 'templates/layout.php';
}
function login() {
    ob_start();
    include 'templates/login.php';
    $content = ob_get_clean();
    include 'templates/layout.php';
}
function register() {
    ob_start();
    include 'templates/register.php';
    $content = ob_get_clean();
    include 'templates/layout.php';
}
function save_file() {
    include 'templates/save_file.php';
}
