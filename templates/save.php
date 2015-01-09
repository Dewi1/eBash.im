<?php $title = 'Save'; ?>
<form  method="post" action="/index.php?page=save">
    <?php if($_SESSION['auth']=='admin' || $_SESSION['auth']=='user'):?>
        <center><br>
            <div style=" width: 800px; align=center">
                <a href="/index.php?page=save_file"><h3>Сохранить главную страницу</h3></a>
            </div>
            <br><h3>Документ будет сохранен как "Bash.txt".</h3>
        </center><br>
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
