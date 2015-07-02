<?php $title = 'Design'; ?>
<center>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
        <h2>Оформление заказа</h2>
    </div><br>
    <?/*?> <?php foreach($items as $itemIdValue => $itemCount):?>
        <?php $itemId = $itemIdValue?>
        <?php $itemPrint = takeItem($itemId);?>
        <?php foreach($itemPrint as $value):?>
            <div style="width: 400px;">
                <img src="<? echo $value[2];?>" width="60" height="60" alt="<? echo $value[1];?>" align="left">
                <h4>Наименование товара: <? echo $value[1];?><br>
                    Цена товара: <? echo $value[3];?> рублей<br>
                    Количество: <? echo $itemCount;?>
            </div>
        <?php endforeach?>
    <?php endforeach?> <?*/?>
    <?php foreach($itemsTakeFromBD as $itemValue):?>
        <? $itemId = $itemValue[0];?>
        <?php $itemPrint = takeItem($itemId);?>
        <?php $itemCount = takeItemCount($itemId, $orderId);?>
        <?php foreach($itemPrint as $value):?>
            <div style="width: 400px;">
                <img src="<? echo $value[2];?>" width="60" height="60" alt="<? echo $value[1];?>" align="left">
                <h4>Наименование товара: <? echo $value[1];?><br>
                    Цена товара: <? echo $value[3];?> рублей<br>
                    Количество: <? echo $itemCount;?>
            </div>
        <?php endforeach?>
    <?php endforeach?>

    <div style="width: 808px;" align="center">
        <font color="red" face="Zapf Chancery, cursive"><h1>Сумма к оплате: <? echo $totalSum." рублей";?></h1></font>
    </div>
    <form method='POST' action='/index.php?page=Shop'>
        <input type="submit" name="orderCancel" value="Отменить заказ" style="width:140px; text-align:center;">
    </form>
    <h3>Оплатить через робокассу</h3>
    <?php
    $mrh_login = "eBash.shop";
    $mrh_pass1 = "pass1111"; //pass1111 / pass2222
    $inv_id = 0;
    $out_summ  = $totalSum;
    $crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");?>
    <p><a href="http://test.robokassa.ru/Index.aspx?MrchLogin=eBash.shop&OutSum=<? echo $out_summ;?>&InvId=0&Desc=Donate&SignatureValue=<?echo $crc;?>&Culture=ru&orderId=<? echo $orderId;?>">
    <img src="images/robokassa.png" width="200" height="100" alt="Оплата через: Robokassa"></a></p>
</center>