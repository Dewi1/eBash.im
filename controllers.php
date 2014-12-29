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
    $arr_text = file_find();
    ob_start();
    include 'templates/printing.php';
    $content = ob_get_clean();
    include 'templates/layout.php';
}
function html_parser() {
    $arr_text = file_find();
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

