<?php session_start(); $title = "Log-in"; ?>
<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?34"></script>

<center>
    <div style=" width: 808px;" align="center">
        <font color="red" face="Zapf Chancery, cursive"><h1>Вход</h1></font>
    </div>
    <form method='POST' action='/index.php?page=login'>
        <?php if (!isAuthorized()): ?>
            <p><a href="<? echo $url; ?>?<?php echo urldecode(http_build_query($params)); ?>"><img src="images/vk.png" width="30" height="30" alt="Войти через Вконтакте"></a></p>
            <input title="Для ввода разрешены: цифры и латинские символы." type="text" name="username" style="width:140px; text-align:center;">
            <br>
            <input title="Для ввода разрешены: цифры и латинские символы." type="password" name="password" style="width:140px; text-align:center;">
            <br><br>
            <div class="g-recaptcha" data-sitekey="<?php echo $siteKey;?>"></div>
            <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>">
            </script>
            <br/>
            <input type="submit" name='login' value="Вход" style="width:80px; text-align:center;">
        <?php else:?>
            <div style="width:120px; text-align:center;">
                <input name='logout' type='submit' value='Выход'>
            </div>
        <?php endif ?>
    </form>
    <?php if (isAuthorized()): ?>
        <font color="red" face="Zapf Chancery, cursive"><h2>Вы авторизированы как: <?php echo $user_name;?></h2></font>
    <?php else: ?>
        <font color="red" face="Zapf Chancery, cursive"><h2>Вы не авторизированы</h2></font>
    <?php endif; ?>
    <?php if ($is_authorised): ?>
        <?php if ($login == false or $password == false ): ?>
            <h2>Логин или пароль введены не корректно!</h2>
        <?php endif; ?>
    <?php endif; ?>
    <?php if($captcha == false):?>
        <h2>Для авторизации введите каптчу!</h2>
    <?php endif; ?>
</center>
