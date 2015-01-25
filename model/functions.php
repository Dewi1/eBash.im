<?php
function get_jokes($url = 'http://bash.im'){
    $html = file_get_contents($url);
    $regexp = '#<div class="quote">.*<div class="actions">.*<span class="rating-o">.*>(.+)<.*</span>.*<span class="date">'
        . '(.+)</span>.*<a href="/quote/.+" class="id">(.+)</a>.*</div>.*<div class="text">(.+)</div>.*</div>#Uis';

    preg_match_all($regexp, $html, $arr_text, PREG_SET_ORDER);

    return $arr_text;
}
function max_page(){
    $html = file_get_contents('http://bash.im/index/1');
    $regexp = '/max="([\d]*)"/i';
    preg_match($regexp, $html, $arr_max);

    return $arr_max;
}
function file_save($arr_text, $text = 'saves/Bash.txt')
{
    $f = fopen($text, 'a');
    foreach ($arr_text as $value) {
        $current = "Rating: $value[1]        Date: $value[2]         Number: $value[3]\r\n\r\n$value[4]\r\n\r\n"
            ."-------------------------------------------------------------------------------------------------\r\n";
        $current = prepare_joke($current);
        fwrite($f, $current);
    }
    fclose($f);

    return $current;
}
function combine_jokes_to_string(){
    //сделать функцию - массив шуток переводит в строку и использовать вместо string_save и юзать в file_save
    $arr_text = get_jokes();
    $text = 0;
    foreach ($arr_text as $value) {
        $text .= $value[1] . $value[2] . $value[3] . $value[4];
    }
    return $text;
}
function prepare_joke($current){
    $patterns[0] = "/<br\/?>/i";
    $patterns[1] = "/<br\s\/?>/i";
    $patterns[2] = "/&quot;/i";
    $patterns[3] = "/&lt;/i";
    $patterns[4] = "/&gt;/i";
    $replacements[4] = "\r\n";
    $replacements[3] = "\r\n";
    $replacements[2] = "\"";
    $replacements[1] = "<";
    $replacements[0] = ">";
    $current = preg_replace($patterns, $replacements, $current);
    return $current;
}
function prepare_number($number){
    $pattern = "/#/";
    $replacement = "";
    $number = preg_replace($pattern, $replacement, $number);
    return $number;
}
/*function save_all($first_num, $last_num)
{
    for($num=$first_num; $num<=$last_num; $num++) {
        $arr_max = max_page();
        if($num <= $arr_max[1]) {
            $arr_text = get_jokes('http://bash.im/index/' . $num);
            $current = file_save($arr_text, $text = 'saves/Bash_' . $num . '.txt');
        }
    }
    return $num;
}*/
function save_page($num){
    $arr_text = get_jokes('http://bash.im/index/'. $num);
    foreach ($arr_text as $value) {
        $rating = $value[1]; $date = $value[2]; $number = $value[3];
        $number = prepare_number($number);
        $value[4]=iconv("windows-1251","utf-8",$value[4]);
        $current = $value[4]; $page_id = $num;
        $current = prepare_joke($current);
        $joke = $current;
        $result_joke = add_joke($number, $date, $rating, $joke, $page_id);
    }
    $number_page = $num;
    $user_id = $_SESSION['user_id'];
    $result_page = add_page($number_page);
    $result_user_page = add_user_page($num, $user_id);
    return $result_joke;
}
function file_search(){
    $file_pages = array('choice' => 'choice', 'save' => 'save', 'profile' => 'Profile', 'profile_saves' => 'Profile_saves',
    'save_file' => 'save_file', 'title' => 'eBash.im', 'printing' => 'Printing', 'login' => 'login', 'register' => 'register');
    $file = array_search($_SESSION['page'], $file_pages);
    return $file;
}
function includes(){
    $file = file_search();
    ob_start();
    include 'templates/'. $file .'.php';
    $content = ob_get_clean();
    include 'templates/layout.php';
}
function headers(){
    header('Content-Type: text/html; charset=utf-8');
    setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
    $myConnect = open_database_connection();
}
