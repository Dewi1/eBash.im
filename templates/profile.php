<?php $title = 'Profile'; ?>
<center>
    <font color="red" face="Zapf Chancery, cursive"><h1>Уважаемый <?php echo $user_name;?></h1></font>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
        <pre>Вы зашли в сфой профиль,</pre>
        <pre>где вы можете:</pre>
    </div><br><br>
    <div style=" width: 320px; border-radius:6px; border: solid 1px black; background:#8B8682; align=center">
        <a href="/index.php?page=Profile_saves">Просмотреть скачанные ранее цитаты</a>
    </div><br><br><br><br><br><br><br>
    <font color="red" face="Zapf Chancery, cursive">
        <h2>За всё время вы пожертвовали сайту: <?php echo $paid;?> рублей.</h2>
        <h2>Администрация благодарит вас за помощь в развитии сайта!</h2>
    </font><br>
</center>
