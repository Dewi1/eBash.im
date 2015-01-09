<?php $title = 'eBash.im'; ?>
<form  method="post" action="/index.php?page=save">
    <center>
        <?if($_SESSION['auth']=='admin'):?>
            <div style=" width: 808px;" align="center">
                <h1>Здравствуй, админ!</h1>
            </div>
        <?php else:?>
            <?if($_SESSION['auth']=='user'):?>
                <div style=" width: 808px;" align="center">
                    <h1>Здравствуйте, <?php echo $_SESSION['user'];?>!</h1>
                </div>
            <?php else:?>
                <div style=" width: 808px;" align="center">
                    <h1>Здравствуйте!</h1>
                </div>
            <?php endif?>
        <?php endif?>
        <div style=" width: 808px; font-size: 22px" align="center">
            <pre>Этот сайт посвящен сайту Bash.im</pre>
            <pre>У нас вы можете:</pre><br>
        </div>
        <div style=" width: 800px; align=center">
            <button type="button">
                <a href="/index.php?page=printing">Читать свежие цитаты с нашего сайта</a>
            </button>
        </div><br>
        <div style=" width: 800px; align=center">
            <button type="button">
                <a href="/index.php?page=choice">Скачать любые страницы цитат</a>
            </button>
        </div><br>
        <div style=" width: 800px; align=center">
            <button type="button">
                <a href="/index.php?page=save">Скачать свежие цитаты</a>
            </button>
        </div><br>
    </center>
    <?if($_SESSION['auth']=='admin'):?>
        <form >
            <div style="position:absolute;top:40px; right:10px; width:80px; text-align:center;">
                <button type="button">
                    <a href="/index.php?page=login">Выйти</a>
                </button>
            </div>
        </form>
    <?endif?>
    <?if($_SESSION['auth']=='user'):?>
        <form >
            <div style="position:absolute;top:10px; right:10px; width:80px; text-align:center;">
                <button type="button">
                    <a href="/index.php?page=login">Выйти</a>
                </button>
            </div>
        </form>
    <?endif?>
    <?if($_SESSION['auth']!='user' && $_SESSION['auth']!='admin'):?>
        <form >
            <div style="position:absolute; top:10px; right:10px; width:80px; text-align:center;">
                <button type="button">
                    <a href="/index.php?page=login">Войти</a>
                </button>
            </div>
            <div style="position:absolute; top:40px; right:20px; width:80px; text-align:center;">
                <button type="button">
                    <a href="/index.php?page=register">Регистрация</a>
                </button>
            </div>
        </form>
    <?endif?>
</form>
