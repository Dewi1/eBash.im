<?php $title = 'DB_save'; ?>

<?php if($_SESSION['auth']=='admin' || $_SESSION['auth']=='user'):?>
    <form  method="post" action="/index.php?page=DB_save">
        <center>
            <h4>Введите страницу для сохранения в Базу Данных:</h4>
            <p><input name="number" type="number" max="1500" min="1" value="1" style="width:100px" title="1-1500"></p>
        </center>
        <center><br>
            <form action="db_save.php" method="post">
                <input type="submit" value="Сохранить" name="save">
            </form>
        </center><br>
    </form>
    <?php if($_POST['save'] == "Сохранить"):?>
        <center><br>
            <?php $arr_max = max_page();?>
            <?php $num = $_POST['number'];?>
            <?php if($num < $arr_max[1]):?>
                <?php $arr_text = get_jokes('http://bash.im/index/' . $num);?>
                <?php foreach ($arr_text as $value):?>
                    <?php $number = $value[1]; $date = $value[2]; $rating = $value[3];?>
                    <?php $value[4]=iconv("windows-1251","utf-8",$value[4]);?>
                    <?php $joke = $value[4]; $page_id = $num; ?>
                    <?php $result_joke = add_joke($number, $date, $rating, $joke, $page_id);?>
                <?php endforeach ?>
                <?php if ($result_joke == 'true'): ?>
                    <h4>Цитаты были сохранены в Базу Данных</h4><br>
                <?php else:?>
                    <h4>Цитаты НЕ были сохранены в Базу Данных</h4><br>
                <?php endif?>
            <?php else: ?>
                <center><br>
                    <h3>Такой страницы не существует!</h3>
                </center>
            <?php endif?>
        </center>
    <?php endif?>
<?php else:?>
    <center><br>
        <h3>Сперва вы должны авторизироваться на сайте!</h3>
    </center>
<?php endif ?>
<center><br><br><br>
    <div style=" width: 800px; align=center">
        <button type="button">
            <a href="/index.php?page=eBash.im">Вернуться</a>
        </button>
    </div><br>
</center>

