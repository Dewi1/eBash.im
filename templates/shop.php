<?php $title = 'Shop'; ?>
<center>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
        <h3>Список товаров:</h3>
    </div><br>
    <?php foreach($items as $value):?>
        <div style="width: 500px;">
            <img src="<? echo $value[2];?>" width="100" height="100" alt="<? echo $value[1];?>" align="left">
            <h2>Наименование товара: <? echo $value[1];?><br>
            Цена товара: <? echo $value[3];?> рублей<br>
            <form method='POST' action='/index.php?page=Shop'>
                <input type="hidden" name="item_id" value="<? echo $value[0];?>">
                <input type="submit" name="order" value="В корзину" style="width:80px; text-align:center;">
                Количество:
                <select name="count">
                    <?php $i = 1;?>
                    <?php while ($i <= 10):?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php $i++;?>
                    <?php endwhile?>
                </select>
                <?php if($inBasket == true && $value[0] == $inBasketId):?>
                    <font color="red" face="Zapf Chancery, cursive"><h2>Этот товар уже есть в корзине.</h2></font>
                <?php endif?>
            </form>
        </div><br><br><br>
    <?php endforeach?>
</center>