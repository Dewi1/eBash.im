<?php $title = 'choice'; ?>
<center><br>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
        <h3>Введите страницы для сохранения в базу данных:</h3>
    </div><br>
    <form  method="post" action="/index.php?page=choice">
        <div style=" width: 320px; border-radius:6px; border: solid 1px black; background:#8B8682; align=center">
            <p>C: <input name="first" type="number" max="1500" min="1" value="1" style="width:100px" title="1-1500">
            По: <input name="last" type="number" max="1500" min="1" value="1" style="width:100px" title="1-1500"></p>
        </div><br>
        <input type="submit" value="Сохранить" name="save">
    </form>
</center><br>
<center>
    <?php if ($saved): ?>
        <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 16px" align="center">
            <h4>В базу данных были сохранены страницы цитат: </h4><?php implode(', ', $savedPages); ?><br>
            <h4>Не сохраненные страницы: </h4><?php implode(', ', $notSavedPages); ?><br>
        </div>
    <?php else: ?>
        <h4>Файлы не были сохранены.</h4>
    <?php endif; ?>
</center>

