<?php $title = 'Profile_donates'; ?>
<center>
    <font color="red" face="Zapf Chancery, cursive"><h1>Уважаемый <?php echo $user_name;?></h1></font>
    <div style=" width: 600px; border-radius:6px; border: solid 1px black; background:#8B8682;  font-size: 22px" align="center">
        <pre>Всего вы внесли: <? echo $sum_paid;?> руб.</pre>
    </div><br>
    <div style=" width: 300px; background: #CDC5BF; font-size: 16px" align="center">
        <pre>Последние взносы:</pre>
    </div><br>
    <?php foreach ($paids as $value):?>
        <center>
            <div style=" width: 500px; background: #EEE9E9; padding: 1px; font-size: 15px" align="left">
                <pre> Дата: <?echo $value[1];?>        Сумма: <?echo $value[2];?> рублей</pre>
            </div>
        </center>
        <br>
    <? endforeach ?>
</center>
