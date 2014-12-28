<?php $title = 'Save'; ?>
<form  method="post" action="/index.php?page=save">
    <center><br>
        <div style=" width: 800px; align=center">
            <input type="submit" value="Сохранить главную страницу" name="save2">
        </div>
    </center><br>
    <?php if($_POST['save2'] == "Сохранить последнюю страницу"):?>
        <?php $current = file_save($arr_text);?>
        <br><center>Документ был сохранен как "Bash.txt".</center>
    <?php endif ?>
</form><br>
<center><br>
    <div style=" width: 800px; align=center">
        <button type="button">
            <a href="/index.php?page=eBash.im">Вернуться</a>
        </button>
    </div><br>
</center>
