<?php
function file_find(){
    $html = file_get_contents('http://bash.im');
    $regexp = '#<div class="quote">.*<div class="actions">.*<span class="rating-o">.*>(.+)<.*</span>.*<span class="date">'
        . '(.+)</span>.*<a href="/quote/.+" class="id">(.+)</a>.*</div>.*<div class="text">(.+)</div>.*</div>#Uis';

    preg_match_all($regexp, $html, $arr_text, PREG_SET_ORDER);

    return $arr_text;
}
function file_save(&$arr_text)
{
    $text = 'Bash.txt';
    $f = fopen($text, 'a');
    foreach ($arr_text as $value) {
        $current = "Rating: $value[1]        Date: $value[2]         Number: $value[3]\r\n\r\n$value[4]\r\n\r\n"
            . "-------------------------------------------------------------------------------------------------\r\n";
        $current = preg_replace("/<br\/?>/i", "\r\n", $current);
        $current = preg_replace("/<br\s\/?>/i", "\r\n", $current);
        $current = preg_replace("/&quot;/i", "\"", $current);
        $current = preg_replace("/&lt;/i", "<", $current);
        $current = preg_replace("/&gt;/i", ">", $current);
        fwrite($f, $current);
    }
    fclose($f);

    return $current;
}
function save_all(&$l, &$k)
{
    for($n=$l; $n<=$k; $n++) {
        $html = file_get_contents('http://bash.im/index/' . $n . '');
        $regexp = '#<div class="quote">.*<div class="actions">.*<span class="rating-o">.*>(.+)<.*</span>.*<span class="date">'
            . '(.+)</span>.*<a href="/quote/.+" class="id">(.+)</a>.*</div>.*<div class="text">(.+)</div>.*</div>#Uis';

        preg_match_all($regexp, $html, $arr_text, PREG_SET_ORDER);

        $text = 'Bash_' . $n . '.txt';
        $f = fopen($text, 'a');
        foreach ($arr_text as $value) {
            $current = "Rating: $value[1]        Date: $value[2]         Number: $value[3]\r\n\r\n$value[4]\r\n\r\n"
                . "-------------------------------------------------------------------------------------------------\r\n";
            $current = preg_replace("/<br\/?>/i", "\r\n", $current);
            $current = preg_replace("/<br\s\/?>/i", "\r\n", $current);
            $current = preg_replace("/&quot;/i", "\"", $current);
            $current = preg_replace("/&lt;/i", "<", $current);
            $current = preg_replace("/&gt;/i", ">", $current);
            fwrite($f, $current);
        }
        fclose($f);
    }
}
