<?php $title = 'Profile_items'; ?>
<center>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
        <h3>Все купленные вами товары:</h3>
    </div><br>
    <?php foreach ($items as $item):?>
        <?php $itemId = $item[1];?>
        <?php $itemPrint = takeItem($itemId);?>
        <?php foreach($itemPrint as $value):?>
            <div style="width: 400px;">
                <img src="<? echo $value[2];?>" width="60" height="60" alt="<? echo $value[1];?>" align="left">
                <h4>Наименование товара: <? echo $value[1];?><br>
                    Количество: <? echo $item[2];?>
            </div>
        <?php endforeach?>
    <? endforeach ?>
</center><br>
