<?php $title = 'Gallery'; ?>
<center><br>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
        <h3>Введите страницы для сохранения в базу данных:</h3>
    </div><br>
    <form  method="post" action="/index.php?page=Gallery">
        <div style=" width: 320px; border-radius:6px; border: solid 1px black; background:#8B8682; align=center">
            <p>Введите путь к файлу галлереи: </p>
            <input type="text" name="road_to_file" style="width:300px"><br><br>
            <input type="submit" value="Импорт" name="import"><br><br>
        </div>
    </form>
</center><br>
<center>
    <?php if ($saved): ?>
        <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 16px" align="center">
            <h4>Галлерея была успешно импортирована.</h4><br>
        </div>
        <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 16px" align="left">
            ID: <?php echo $id;?><br>
            Name: <?php echo $name;?><br>
            Type: <?php echo $type;?><br>
            Width: <?php echo $width;?><br>
            Height: <?php echo $height;?><br>
        </div>
    <?php else: ?>
        <h4>Галлерея не была импортирована!</h4>
    <?php endif; ?>
</center>
