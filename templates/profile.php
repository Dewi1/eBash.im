<?php $title = 'Profile'; ?>
<?php if($_SESSION['auth']=='admin' || $_SESSION['auth']=='user'):?>
    <center>
        <h1>Уважаемый <?php echo $_SESSION['user'];?></h1>
        <div style=" width: 808px; font-size: 22px" align="center">
            <pre>Вы зашли в сфой профиль,</pre>
            <pre>где вы можете:</pre><br>
        </div>
        <div style=" width: 800px; align=center">
            <a href="/index.php?page=Profile_saves">Просмотреть скачанные ранее цитаты</a>
        </div><br>
    </center>
<?php else: ?>
    <center><br>
        <h3>Сперва вы должны авторизироваться на сайте!</h3>
    </center>
<?php endif ?>
<form >
    <div style="position:fixed;top:10px; right:10px; width:80px; text-align:center;">
        <a href="/index.php?page=eBash.im">Вернуться</a>
    </div>
</form>
