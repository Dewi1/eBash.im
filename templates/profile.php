<?php $title = 'Profile'; ?>
<center>
    <font color="red" face="Zapf Chancery, cursive"><h1>Уважаемый <?php echo $_SESSION['user'];?></h1></font>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
        <pre>Вы зашли в сфой профиль,</pre>
        <pre>где вы можете:</pre>
    </div><br><br>
    <div style=" width: 320px; border-radius:6px; border: solid 1px black; background:#8B8682; align=center">
        <a href="/index.php?page=Profile_saves">Просмотреть скачанные ранее цитаты</a>
    </div><br>
</center>
