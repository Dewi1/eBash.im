<?php $title = 'Gallery'; ?>
<center><br>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
        <h3>Галерея</h3>
    </div><br>
    <form  method="post" action="/index.php?page=Gallery">
        <div style=" width: 320px; border-radius:6px; border: solid 1px black; background:#8B8682; align=center">
            <p>Загрузите галерею:
            <input type="submit" value="Импорт" name="import"></p>
        </div>
    </form>
</center><br>
<center>
    <?php if ($saved): ?>
        <h2>Галлерея была успешно импортирована.</h2><br>
        <?php for($i=0; $i<count($name); $i++):?>
            <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 16px" align="left">
                URL: <?php echo $url[$i];?><br>
                Name: <?php echo $name[$i];?><br>
                Width: <?php echo $width[$i];?><br>
                Height: <?php echo $height[$i];?><br>
            </div>
        <?php endfor?>
    <?php endif; ?>
</center>
