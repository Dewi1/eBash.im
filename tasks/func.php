<?php
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
?>
<html>
<head>
    <title>Functions.ru</title>
</head>
<body>
<?php
    function foo()
    {
        echo 'Функция "foo" была выполнена';
    }
    function bar()
    {
        echo 'Функция "bar" была выполнена';
    }

    function baz()
    {
        echo 'Функция "baz" была выполнена';
    }
?>
<center><br><br>
    <form action="func.php" method="post">
        <input type="text" name="func"><br><br>
        <input type="submit" value="submit">
    </form>
</center>
<?php
    echo '<center>';
    if(function_exists($_POST['func'])){
        $_POST['func']();
    }elseif($_POST['func'] == ''){
        echo 'Введите имя функции!';
    }else{
        echo 'Функция не найдена';
    }
    echo '<br></center>';
?>
</body>
</html>
