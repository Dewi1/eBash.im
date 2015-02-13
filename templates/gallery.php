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
        <?php for($i=0; $i<count($url); $i++):?>
            <center><br>
                <img src="<?php echo $url[$i]?>" widht="500px" height="500px"/><br>
                <div style=" width: 800px; border-radius:6px; border: solid 1px black; background:#8B8682; align=center">
                    <p><a href="<?php echo $url[$i]?>">Name: <?php echo $name[$i];?></a></p>
                    <pre>Width: <?php echo $width[$i];?>     Height: <?php echo $height[$i];?>     Size: <?php echo round(strlen(file_get_contents($url[$i]))/1024, 1)."КБ";?></pre>
                </div>
            </center><br><br>
        <?php endfor?>
    <?php endif; ?>
</center>
