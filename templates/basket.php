<?php $title = 'Basket'; ?>
<script type="text/javascript" src="../crop/jquery-1.5.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".item_count").change(
            function() {
                $.post("/index.php?page=ajax-cart-update",
                {
                    count: this.options[this.selectedIndex].value,
                    item_id: $(this).parent().attr("item-id"),
                    oldCount: document.getElementById('item-count'),
                    oldTotalSum: document.getElementById('old-total-sum'),
                    itemPrice: document.getElementById('item-price')
                },
                    function(){
                        var total_sum = $('.totalSum').html(data); <?php//"<?php echo $totalSum; ?>//";
                        $('#total_sum').html("<font color='red' face='Zapf Chancery, cursive'><h2>ИТОГО:" + value(total_sum) + "рублей</h2></font>");
                        var total_items_sum = $('.$totalItemsSum').html(data); <?php//"<?php echo $totalSum; ?>//";
                        $('#total_items_sum').html("Общая цена:" + value(total_items_sum) + "рублей</h2></font>");
                    },
                function(data){
                    alert(data);
                });
            }
        );
    });
</script>

<center>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 450px; font-size: 22px" align="center">
        <h3>Ваша корзина, <? echo $userName;?></h3>
    </div><br>
    <?php foreach ($items as $itemIdValue => $itemCount):?>
        <?php $itemId = $itemIdValue?>
        <?php $itemPrint = takeItem($itemId);?>
        <table width="50%" border="2" alert="center"><tr>
            <?php foreach($itemPrint as $value):?>
                <td>
                    <img src="<? echo $value[2];?>" width="100" height="100" alt="<? echo $value[1];?>" align="left">
                </td><td>
                    Наименование товара: <? echo $value[1];?><br>
                </td><td>
                    Цена товара: <? echo $value[3];?> рублей<br>
                    <input type="hidden" name="item_price" item-price = "<?php echo $value[3];?>"/>
                </td><td item-id="<?php echo $value[0];?>">
                    Количество:
                    <select class="item_count"">
                        <?php $i = 1;?>
                        <?php while ($i <= 10):?>
                            <?php if($i != $itemCount):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php else:?>
                                <option selected value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endif;?>
                            <?php $i++;?>
                        <?php endwhile?>
                    </select>
                    <input type="hidden" name="item_count" item-count = "<?php echo $itemCount;?>"/>
                </td><td>
                    <div total-items-sum = "total_items_sum">
                        Общая цена: <? echo $value[3]*$itemCount;?> рублей<br>
                    </div>
                </td>
                <form method='POST' action='/index.php?page=Basket'>
                    <input type="submit" name="order2" value="Удалить" style="width:80px; text-align:center;">
                </form>
            <?php endforeach?>
        </tr></table><br><br>
    <?php endforeach?><br><br>
    <?php if($totalSum != 0):?>
        <form method='POST' action='/index.php?page=Basket'>
            <input type="submit" name="delete" value="Очистить корзину" style="width:180px; text-align:center;">
        </form>
        <form method='POST' action='/index.php?page=Basket'>
            <input type="submit" name="save" value="Сохранить заказ" style="width:180px; text-align:center;">
        </form>
        <div total-sum = "total_sum">
            <input type="hidden" name="old_total_sum" old-total-sum = "<?php echo $totalSum;?>"/>
            <font color="red" face="Zapf Chancery, cursive"><h2>ИТОГО: <?php echo $totalSum;?> рублей</h2></font>
        </div>
        <h2>Введите адрес доставки:</h2>
        <form method='POST' action='/index.php?page=Design'>
            <textarea name="address" size="100" rows="3" cols="22"></textarea><br><br>
            <input type="submit" name="submit" value="Оформить заказ" style="width:140px; text-align:center;"><br><br>
        </form>
    <?php else:?>
        <font color="red" face="Zapf Chancery, cursive"><h1>Ваша корзина пуста</h1></font>
        <form method='POST' action='/index.php?page=Shop'>
            <input type="submit" name="submit" value="Наполнить" style="width:140px; text-align:center;"><br><br>
        </form>
    <?php endif?>
</center>
