<?php $title = 'Save'; ?>
<form  method="post" action="/index.php?page=save">
    <center><br>
        <div style=" width: 800px; align=center">
            <input type="submit" value="Сохранить главную страницу" name="save2">
        </div>
        <br><h3>Документ будет сохранен как "Bash.txt" через 5 секунд после нажатия кнопки.</h3>
    </center><br>
    <?php if($_POST['save2'] == "Сохранить главную страницу"):?>
        <?php $current = file_save($arr_text);?>
        <?php sleep(5); ?>
        <?php $file = file_download($file)?>
    <?php endif ?>
</form><br>
<center><br>
    <div style=" width: 800px; align=center">
        <button type="button">
            <a href="/index.php?page=eBash.im">Вернуться</a>
        </button>
    </div><br>
</center>
