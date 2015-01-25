<?php $title = 'choice'; ?>
<form  method="post" action="/index.php?page=choice">
    <center><br>
        <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
            <h3>Введите страницы для сохранения в базу данных:</h3>
        </div><br>
        <div style=" width: 320px; border-radius:6px; border: solid 1px black; background:#8B8682; align=center">
            <p>C: <input name="first" type="number" max="1500" min="1" value="1" style="width:100px" title="1-1500">
            По: <input name="last" type="number" max="1500" min="1" value="1" style="width:100px" title="1-1500"></p>
        </div>
    </center>
    <center><br>
        <form action="choice.php" method="post">
            <input type="submit" value="Сохранить" name="save">
        </form>
    </center>
</form>
