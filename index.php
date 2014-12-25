<html>
<head>
    <title>Bash.org</title>
</head>
<body>
<?php
    $html = file_get_contents ('http://bash.im');
    $regexp = '#<div class="quote">.*<div class="actions">.*<span class="rating-o">.*>(.+)<.*</span>.*<span class="date">'
    .'(.+)</span>.*<a href="/quote/.+" class="id">(.+)</a>.*</div>.*<div class="text">(.+)</div>.*</div>#Uis';

    preg_match_all($regexp, $html, $arr_text, PREG_SET_ORDER);

?>

    <?php foreach ($arr_text as $value):?>
        <center>
            <div style=" width: 808px; background: #CDC5BF; padding: 2px; font-size: 14px" align="center">
                <pre>Rating: <?echo $value[1];?>        Date: <?echo $value[2];?>         Number: <?echo $value[3];?></pre>
            </div>
            <hr align="center" size="3" width="810" color="#8B8682" noshade>
            <div style=" width: 800px; background: #EEE9E9; padding: 6px; font-size: 16px" align="left">
                <p align="justify"><?echo $value[4];?></p>
            </div>
        </center>
        <br><br>
    <? endforeach ?>
</body>
</html>
