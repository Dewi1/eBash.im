<?php
function html_parser() {
    $arr_text = file_find();
    ob_start();
    include 'templates/bash.php';
    $content = ob_get_clean();
    include 'templates/layout.php';
}
