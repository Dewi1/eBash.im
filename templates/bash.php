<?php
    if($_POST['save'] == 'Save text') {
        $text = 'bash.txt';
        $f = fopen ($text,'r+');
        $t= fread($f, filesize('text.txt'));
        foreach ($arr_text as $key => $value) {
            $current .= "Rating: $value[1]        Date: $value[2]         Number: $value[3]\r\n\r\n$value[4]\r\n\r\n"
                . "-------------------------------------------------------------------------------------------------------\r\n";
        }
        $cur = preg_replace("/<br\/?>/i", "\r\n", $current);
        $cur_re = preg_replace("/&quot;/i", "\"", $cur);
        //file_put_contents($text, $cur2);
        fwrite($f, $cur_re);
        fclose($f);
    }






