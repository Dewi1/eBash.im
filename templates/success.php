<?php session_start(); $title = "Success"; ?>

<center>
    <font color="red" face="Zapf Chancery, cursive"><h1>Уважаемый <?php echo $user_name;?></h1></font>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 620px; font-size: 22px" align="center">
        <h3>Платеж проведен успешно! Вы внесли <?php echo $pay;?> рублей.</h3>
        <h3>Приносим вам свою благодарность. Администация.</h3>
    </div>
</center>


<!-- Проверка каптчи. Добавить авторизированных черехз ВК в базу