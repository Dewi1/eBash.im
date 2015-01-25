<?php $title = 'Profile_saves'; ?>
<?php $user_pages = qr_result_users(); //todo передавай данные из контроллера ?>
<center>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
        <h3>Сохранённые прежде страницы:</h3>
    </div><br>
    <?php $top = 92;?>
    <?php foreach($user_pages as $value):?>
        <form  method="post" action="/index.php?page=Profile_saves">
            <div style="position:fixed;top:<?php echo $top;?>px; left:8px; width:180px; border-radius:6px; border: solid 1px black; background:#8B8682; align=center">
                <input type="submit" value="<?php echo $value[0]?>" name="read">
                <a href="http://bash.im/index/<?php echo $value[0]?>">Читать на сайте -></a>
            </div>
        </form>
        <?php $top = $top+25;?>
        <?php if($_POST["read"] == $value[0]): //todo передавай данные из контроллера ?>
            <?php $page = $value[0];?>
            <?php $jokes = qr_result_jokes($page); //todo передавай данные из контроллера?>
            <?php foreach($jokes as $joke):?>
                <center>
                    <div style=" width: 808px; background: #CDC5BF; padding: 2px; font-size: 14px" align="center">
                        <pre>Рейтинг: <?echo $joke[3];?>        Дата: <?echo $joke[2];?>         Номер цитаты: #<?echo $joke[1];?></pre>
                    </div>
                    <hr align="center" size="3" width="810" color="#8B8682" noshade>
                    <div style=" width: 800px; background: #EEE9E9; padding: 6px; font-size: 16px" align="left">
                        <p align="justify"><?echo $joke[4];?></p>
                    </div>
                </center>
                <br><br>
            <?php endforeach?>
        <?php endif?>
    <?php endforeach?>
</center>
<form >
