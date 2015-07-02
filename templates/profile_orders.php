<?php $title = 'Profile_orders'; ?>
<center>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
        <h3>Все заказы:</h3>
    </div><br>
</center>
<?php foreach ($orders as $value):?>
    <center>
        <?php if($value[4] == "NEW"):?>
            <div style=" width: 450px; background: #EEE9E9; padding: 1px; font-size: 15px" align="center">
            <pre> <?echo 'Номер заказа: ' . $value[0] . ' Сумма: ' . $value[2] .
                    ' Статус:  <font color="green" face="Zapf Chancery, cursive">' . $value[4] .'</font>';?></pre>
            </div>
            <form method='POST' action='/index.php?page=Design'>
                <input type="hidden" name="order_id" value="<? echo $value[0];?>">
                <input type="submit" name="submit" value="Оплатить" style="width:140px; text-align:center;">
            </form>
        <?php elseif($value[4] == "CANCELED"):?>
            <div style=" width: 450px; background: #EEE9E9; padding: 1px; font-size: 15px" align="center">
            <pre> <?echo 'Номер заказа: ' . $value[0] . ' Сумма: ' . $value[2] .
                    ' Статус:  <font color="red" face="Zapf Chancery, cursive">' . $value[4] .'</font>';?></pre>
            </div>
        <?php elseif($value[4] == "FAILED"):?>
            <div style=" width: 450px; background: #EEE9E9; padding: 1px; font-size: 15px" align="center">
            <pre> <?echo 'Номер заказа: ' . $value[0] . ' Сумма: ' . $value[2] .
                    ' Статус:  <font color="orange" face="Zapf Chancery, cursive">' . $value[4] .'</font>';?></pre>
            </div>
        <?php endif;?>
    </center><br>
<? endforeach ?>
