<?php $title = 'Printing'; ?>
<?php $arr_text = get_jokes();?>
<?php foreach ($arr_text as $value):?>
    <center>
        <div style=" width: 808px; background: #CDC5BF; padding: 2px; font-size: 14px" align="center">
            <pre>Рейтинг: <?echo $value[1];?>        Дата: <?echo $value[2];?>         Номер цитаты: <?echo $value[3];?></pre>
        </div>
        <hr align="center" size="3" width="810" color="#8B8682" noshade>
        <div style=" width: 800px; background: #EEE9E9; padding: 6px; font-size: 16px" align="left">
            <?php $value[4]=iconv("windows-1251","utf-8",$value[4]);?>
            <p align="justify"><?echo $value[4];?></p>
        </div>
    </center>
    <br><br>
<? endforeach ?>
