<?php $title = 'eBash.im'; ?>
<form  method="post" action="/index.php?page=save">
    <center>
        <?if($_SESSION['auth']=='admin'):?>
            <div style=" width: 808px;" align="center">
                <font color="red" face="Zapf Chancery, cursive"><h1>Здравствуй, админ!</h1></font>
            </div>
        <?php else:?>
            <?if($_SESSION['auth']=='user'):?>
                <div style="width: 808px;" align="center">
                    <font color="red" face="Zapf Chancery, cursive"><h1>Здравствуйте, <?php echo $_SESSION['user'];?>!</h1></font>
                </div>
            <?php else:?>
                <div style=" width: 808px;" align="center">
                    <font color="red" face="Zapf Chancery, cursive"><h1>Здравствуйте!</h1></font>
                </div>
            <?php endif?>
        <?php endif?>
        <?php /* todo строки 4-18: лучше использовать elseif, а еще лучше определить в контроллере имя пользователя
                 todo и передать его в шаблон, т.к. в трех случаях дублируются три строки html кода*/?>
        <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
            <pre>Этот сайт посвящен сайту Bash.im</pre>
            <pre>У нас вы можете:</pre>
        </div><br><br>
        <div style=" width: 320px; border-radius:6px; border: solid 1px black; background:#8B8682; align=center">
            <a href="/index.php?page=Printing">Читать свежие цитаты с нашего сайта</a>
        </div><br>
        <div style=" width: 320px; border-radius:6px; border: solid 1px black;  background:#8B8682; align=center">
            <a href="/index.php?page=choice">Скачать любые страницы цитат</a>
        </div><br>
        <div style=" width: 320px; border-radius:6px; border: solid 1px black; background:#8B8682; align=center">
            <a href="/index.php?page=save">Скачать свежие цитаты</a>
        </div><br>
    </center>
</form>
