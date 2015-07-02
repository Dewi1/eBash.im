<?php session_start(); $title = "Donate"; ?>

<center>
    <font color="red" face="Zapf Chancery, cursive"><h1>Уважаемый <?php echo $user_name;?></h1></font>
    <div style=" border-radius:6px; background:#CDC5BF;border: solid 1px black; width: 480px; font-size: 22px" align="center">
        <h3>На этой страничке вы можете финансово помочь развитию сайта. Администрация заранее благодарит вас за принятие участия в поддержке сайта.</h3>
    </div><br><br>
    <img src="images/donate.png" width="125" height="125" alt="Помочь проекту"><br><br><br>

    <form method='POST' action='/index.php?page=Donate'>
        <select name="pay">
            <option value="10">10 рублей</option>
            <option value="50">50 рублей</option>
            <option value="100">100 рублей</option>
            <option value="250">250 рублей</option>
            <option value="500">500 рублей</option>
        </select>
        <?/*<form action="http://test.robokassa.ru/ReturnResults.aspx?Culture=ru&OutSum=<?php echo $pay;?>" method="GET">
            <input type="submit" name="submit" value="Donate" style="width:80px; text-align:center;">
        </form>*/?>
        <input type="submit" name="submit" value="Donate" style="width:80px; text-align:center;">
    </form>
