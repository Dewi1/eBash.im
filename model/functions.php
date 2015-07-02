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
    $max_page = $arr_max[1];

    return $max_page;
}
function combine_jokes_to_string(){
    $arr_text = get_jokes();
    $current = '';
    foreach ($arr_text as $value) {
        $current .= "Rating: $value[1]        Date: $value[2]         Number: $value[3]\r\n\r\n$value[4]\r\n\r\n"
            ."-------------------------------------------------------------------------------------------------\r\n";
        $current = prepare_joke($current);
    }
    return $current;
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
    $number = substr($number, 1);
    return $number;
}
/*function file_save($text = 'saves/Bash.txt')
{
    $string = combine_jokes_to_string();
    file_put_contents($text, $string);
}*/
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
    $arr_text = get_jokes('http://bash.imz/index/'. $num);
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
function render_template($arguments, $file = ''){
    extract($arguments, EXTR_SKIP);
    ob_start();
    include 'templates/'. $file .'.php';
    $content = ob_get_clean();
    include 'templates/layout.php';
}
function headers(){
    header('Content-Type: text/html; charset=utf-8');
    setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
}
