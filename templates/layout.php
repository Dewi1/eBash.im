<html>
    <head>
        <title><?php echo $title ?></title>
        <style>
            a { text-decoration: none; }
            li { list-style-type: none; }
            textarea { resize: none; }
            body {
                background: white url('/images/body.jpg');
                background-repeat: no-repeat;
                background-position: right top;
                background-attachment: fixed;
            }

        </style>
    </head>
    <body>
    <body>
    <div class="top_head" style="position:fixed;width:3000px; height: 70px; top:0px; left:0px; border: solid 1px black; background: url(/images/head.jpg); font-size: 14px" align="center">
        <div style="position:fixed; top:0px; left:30px; width:80px; text-align:center;">
            <font color="red" face="Zapf Chancery, cursive"><h1>eBash.im</h1></font>
        </div>
        <div style="position:fixed; border: solid 1px black; border-radius:6px; background:#CDC5BF; top:27px; right:180px; width:90px; text-align:center;">
            <a href="/index.php?page=eBash.im">На главную</a>
        </div>
        <?php if(!isAuthorized()):?>
            <div style="position:fixed; border: solid 1px black; border-radius:6px; background:#CDC5BF; top:27px; right:400px; width:70px; text-align:center;">
                <a href="/index.php?page=login">Войти</a>
            </div>
        <?php else:?>
            <div style="position:fixed; border: solid 1px black; border-radius:6px; background:#CDC5BF; top:27px; right:400px; width:70px; text-align:center;">
                <a href="/index.php?page=login">Выйти</a>
            </div>
            <div style="position:fixed; border: solid 1px black; border-radius:6px; background:#CDC5BF; top:27px; right:490px; width:80px; text-align:center;">
                <a href="/index.php?page=Profile">Профиль</a>
            </div>
        <?php endif?>
        <div style="position:fixed; border: solid 1px black; border-radius:6px; background:#CDC5BF; top:27px; right:290px; width:90px; text-align:center;">
            <a href="/index.php?page=register">Регистрация</a>
        </div>
    </div><br><br><br><br>
        <?php echo $content; ?>
    </body>
</html>
