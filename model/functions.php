<?php
function file_find(){
    $html = file_get_contents('http://bash.im');
    $regexp = '#<div class="quote">.*<div class="actions">.*<span class="rating-o">.*>(.+)<.*</span>.*<span class="date">'
        . '(.+)</span>.*<a href="/quote/.+" class="id">(.+)</a>.*</div>.*<div class="text">(.+)</div>.*</div>#Uis';

    preg_match_all($regexp, $html, $arr_text, PREG_SET_ORDER);

    return $arr_text;
}
function max_page(){
    $html = file_get_contents('http://bash.im/index/1');
    //$regexp = '#<input type="text" name="page" class="page" pattern="[0-9]+" numeric="integer" min="1" max="(.+)" value="1">#Uis';
    $regexp = '/max="([\d]*)"/i';
    preg_match($regexp, $html, $arr_max);

    return $arr_max;
}
function file_save(&$arr_text)
{
    $text = 'saves/Bash.txt';
    $f = fopen($text, 'a');
    foreach ($arr_text as $value) {
        $current = "Rating: $value[1]        Date: $value[2]         Number: $value[3]\r\n\r\n$value[4]\r\n\r\n"
        ."-------------------------------------------------------------------------------------------------\r\n";
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
        $arr_max = max_page();
        if($n <= $arr_max[1]) {
            $html = file_get_contents('http://bash.im/index/' . $n . '');
            $regexp = '#<div class="quote">.*<div class="actions">.*<span class="rating-o">.*>(.+)<.*</span>.*<span class="date">'
                . '(.+)</span>.*<a href="/quote/.+" class="id">(.+)</a>.*</div>.*<div class="text">(.+)</div>.*</div>#Uis';

            preg_match_all($regexp, $html, $arr_text, PREG_SET_ORDER);

            $text = 'saves/Bash_' . $n . '.txt';
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
    return $n;
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
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
    return $file;
}
