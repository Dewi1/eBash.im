<?php session_start(); $title = "Donate_choice"; ?>
<center><br>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 480px; font-size: 22px" align="center">
        <h3>Выберите способ оплаты</h3>
    </div><br><br>
    <?php
    $mrh_login = "eBash.shop";
    $mrh_pass1 = "pass1111"; //pass1111 / pass2222
    $inv_id = 0;
    $out_summ  = $_SESSION['pay'];
    $crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");?>
    <p><a href="http://test.robokassa.ru/Index.aspx?MrchLogin=eBash.shop&OutSum=<? echo $_SESSION['pay'];?>&InvId=0&Desc=Donate&SignatureValue=<?echo $crc;?>&Culture=ru">
    <img src="images/robokassa.png" width="200" height="100" alt="Оплата через: Robokassa"></a></p>
</center>
<?   // http://test.robokassa.ru/InputSum.aspx?Culture=ru
