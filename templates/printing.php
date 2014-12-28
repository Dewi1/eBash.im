<?php $title = 'Printing'; ?>
<form  method="post" action="/index.php?page=save">
    <?php foreach ($arr_text as $key => $value):?>
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
</form>
<center>
    <div style=" width: 800px; align=center">
        <button type="button">
            <a href="/index.php?page=eBash.im">Вернуться</a>
        </button>
    </div><br>
</center>
