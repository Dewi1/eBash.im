<?php $title = 'Profile_saves'; ?>
<?php if($_SESSION['auth']=='admin' || $_SESSION['auth']=='user'):?>
    <?php $user_pages = qr_result_users();?>
    <center>
        <h3>Сохранённые прежде страницы:</h3>
        <?php $top = 12;?>
        <?php foreach($user_pages as $value):?>
            <div style="position:fixed;top:<?php echo $top;?>px; left:8px; width:160px; text-align:center;">
                <form  method="post" action="/index.php?page=Profile_saves">
                    <input type="submit" value="<?php echo $value[0]?>" name="read">
                    <button type="button">
                        <a href="http://bash.im/index/<?php echo $value[0]?>">Читать на сайте -></a>
                    </button><br>
                </form>
            </div>
            <?php $top = $top+25;?>
            <?php if($_POST["read"] == $value[0]):?>
                <?php $page = $value[0];?>
                <?php $jokes = qr_result_jokes($page);?>
                <?php foreach($jokes as $joke):?>
                    <center>
                        <div style=" width: 808px; background: #CDC5BF; padding: 2px; font-size: 14px" align="center">
                            <pre>Рейтинг: <?echo $joke[1];?>        Дата: <?echo $joke[2];?>         Номер цитаты: <?echo $joke[3];?></pre>
                        </div>
                        <hr align="center" size="3" width="810" color="#8B8682" noshade>
                        <div style=" width: 800px; background: #EEE9E9; padding: 6px; font-size: 16px" align="left">
                            <?php $value[4]=iconv("windows-1251","utf-8",$joke[4]);?>
                            <p align="justify"><?echo $joke[4];?></p>
                        </div>
                    </center>
                    <br><br>
                <?php endforeach?>
            <?php endif?>
        <?php endforeach?>
    </center>
<?php else: ?>
    <center><br>
        <h3>Сперва вы должны авторизироваться на сайте!</h3>
    </center>
<?php endif ?>
<form >
    <div style="position:fixed;top:10px; right:10px; width:80px; text-align:center;">
        <a href="/index.php?page=Profile">Вернуться</a>
    </div>
</form>
<form >
    <div style="position:fixed;top:40px; right:4px; width:100px; text-align:center;">
        <a href="/index.php?page=eBash.im">На главную</a>
    </div>
</form>
