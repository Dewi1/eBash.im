<?php $title = 'choice'; ?>

<form  method="post" action="/index.php?page=choice">
    <center>
        <p>Введите страницы для скачивания:</p>
        <p>C: <input name="first" type="number" max="1500" min="1" value="1" style="width:100px" title="1-1500">
        По: <input name="second" type="number" max="1500" min="1" value="1" style="width:100px" title="1-1500"></p>
    </center>
    <center><br>
        <form action="bash.php" method="post">
            <input type="submit" value="Сохранить" name="save">
        </form>
    </center>
</form>
<?php if($_POST['save'] == "Сохранить"):?>
    <center><br>
    <? $arr_max = max_page();?>
    <?php $l = $_POST['first']; $k = $_POST['second']; ?>
    <?php $text = save_all($l, $k);?>
    <?php if ($k >= $l):?>
        В папку "saves" были сохранены файлы:<br><br>
        <?php for($n=$l; $n<=$k; $n++):?>
            <?php if  ($n <= $arr_max[1]):?>
                <?php echo 'Bash_'.$n.'.txt';?><br>
            <?php else:?>
                Файл: <?php echo 'Bash_'.$n.'.txt';?> не был сохранен.<br>
            <?php endif?>
        <?php endfor ?>
    <?php else:?>
        Файлы не были сохранены.
    <?php endif?><br>
    <?php if  ($n > $arr_max[1]):?>
        Таких страниц не существует.
    <?php endif?>
    </center>
<?php endif?>
<center><br><br><br>
    <div style=" width: 800px; align=center">
        <button type="button">
            <a href="/index.php?page=eBash.im">Вернуться</a>
        </button>
    </div><br>
</center>
