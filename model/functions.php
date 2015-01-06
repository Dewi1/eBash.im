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
        $patterns[0] = "/<br\/?>/i";
        $patterns[1] = "/<br\s\/?>/i";
        $patterns[2] = "/&quot;/i";
        $patterns[3] = "/&lt;/i";
        $patterns[4] = "/&gt;/i";
        $replacements[4] = "\r\n";
        $replacements[3] = "\r\n";
        $replacements[2] = "\"";
        $replacements[1] = "<";
        $replacements[0] = ">";;
        $current = preg_replace($patterns, $replacements, $current);
        fwrite($f, $current);
    }
    fclose($f);

    return $current;
}
function save_all(&$first_num, &$last_num)
{
    for($num=$first_num; $num<=$last_num; $num++) {
        $arr_max = max_page();
        if($num <= $arr_max[1]) {
            $arr_text = get_jokes('http://bash.im/index/' . $num);
            $current = file_save($arr_text, $text = 'saves/Bash_' . $num . '.txt');
        }
    }
    return $num;
}
function file_download() {
    $file = 'saves/Bash.txt';
    if (file_exists($file)) {
        if (ob_get_level()) {
            ob_end_clean();
        }
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file)); //вместо Content-Length вернуть контент строки str-length
        readfile($file);
        //собрать все цитаты в 1 переменную, получить размер и зделать echo
        //вместо скачки на комп - сразу юзеру
    }
    return $file;
}
