<?php $title = 'Save'; ?>
<form  method="post" action="/index.php?page=save">
    <?php if($_SESSION['auth']=='admin' || $_SESSION['auth']=='user'):?>
        <center><br>
            <div style=" width: 800px; align=center">
                <input type="submit" value="Сохранить главную страницу" name="save2">
            </div>
            <br><h3>Документ будет сохранен как "Bash.txt".</h3>
        </center><br>
        <?php if($_POST['save2'] == "Сохранить главную страницу"):?>
            <?php $current = file_save($arr_text);?>
            <?php $file = file_download($file)?>
        <?php endif ?>
    <?php else: ?>
        <center><br>
            <h3>Сперва вы должны авторизироваться на сайте!</h3>
        </center>
    <?php endif ?>
</form><br>
<center><br>
    <div style=" width: 800px; align=center">
        <button type="button">
            <a href="/index.php?page=eBash.im">Вернуться</a>
        </button>
    </div><br>
</center>
