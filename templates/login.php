<?php session_start(); $title = "Log-in"; ?>
<center>
    <div style=" width: 808px;" align="center">
        <font color="red" face="Zapf Chancery, cursive"><h1>Вход</h1></font>
    </div>
    <form method='POST' action='/index.php?page=login'>
        <?php if($_POST['login'] == 'admin' && $_POST['pass'] == 'admin'):?>
            <?php $_SESSION['auth'] = 'admin'; ?>
        <?php endif?>
        <?php if($_SESSION['auth'] == 'admin' || $_SESSION['auth'] == 'user'):?>
            <div style="width:120px; text-align:center;">
                <input name='submit1' type='submit' value='Выход'>
            </div>
        <?php endif?>
        <?php if($_SESSION['auth'] != 'user' && $_SESSION['auth'] != 'admin'):?>
            <input title="Для ввода разрешены: цифры и латинские символы." type="text" name="login" style="width:140px; text-align:center;">
            <br>
            <input title="Для ввода разрешены: цифры и латинские символы." type="password" name="pass" style="width:140px; text-align:center;">
            <br><br>
            <input type="submit" name='submit2' value="Вход" style="width:80px; text-align:center;">
        <?php endif?>
    </form>
    <?if($_SESSION['auth'] == 'user'):?>
        <br><br>
        <font color="red" face="Zapf Chancery, cursive"><h2>Вы авторизированы как USER</h2></font>
    <?endif?>
    <?if($_SESSION['auth'] == 'admin'):?>
        <br><br>
        <font color="red" face="Zapf Chancery, cursive"><h2>Вы авторизированы как ADMIN</h2></font>
    <?endif?>
</center>
