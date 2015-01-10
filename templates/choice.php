<?php $title = 'choice'; ?>

<?php if($_SESSION['auth']=='admin' || $_SESSION['auth']=='user'):?>
    <form  method="post" action="/index.php?page=choice">
        <center><br>
            <h3>Введите страницы для скачивания:</h3>
            <p>C: <input name="first" type="number" max="1500" min="1" value="1" style="width:100px" title="1-1500">
            По: <input name="last" type="number" max="1500" min="1" value="1" style="width:100px" title="1-1500"></p>
        </center>
        <center><br>
            <form action="choice.php" method="post">
                <input type="submit" value="Сохранить" name="save">
            </form>
        </center>
    </form>
    <?php if($_POST['save'] == "Сохранить"):?>
        <center><br>
        <? $arr_max = max_page();?>
        <?php $first_num = $_POST['first']; $last_num = $_POST['last'];?>
            <?php $text = save_all($first_num, $last_num);?>
        <?php if ($last_num >= $first_num):?>
            В папку "saves" были сохранены файлы:<br><br>
            <?php for($num=$first_num; $num<=$last_num; $num++):?>
                <?php if  ($num <= $arr_max[1]):?>
                    <?php $result_joke = save_joke($num);?>
                    <?php echo 'Bash_'.$num.'.txt';?><br>
                <?php else:?>
                    Файл: <?php echo 'Bash_'.$num.'.txt';?>, не был сохранен.<br>
                <?php endif?>
            <?php endfor ?>
        <?php else:?>
            Файлы не были сохранены.
        <?php endif?><br>
        <?php if  ($num > $arr_max[1]):?>
            Таких страниц не существует.
        <?php endif?>
        </center>
    <?php endif?>
<?php else: ?>
    <center><br>
        <h3>Сперва вы должны авторизироваться на сайте!</h3>
    </center>
<?php endif ?>
<form >
    <div style="position:fixed;top:10px; right:10px; width:80px; text-align:center;">
        <button type="button">
            <a href="/index.php?page=eBash.im">Вернуться</a>
        </button>
    </div>
</form>
