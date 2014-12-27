<?php
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
?>
<html>
<head>
    <title>Array.ru</title>
</head>
<body>
<center><br><br>
    <div style="font-size: 18px">
        Введите цифры через запятую, для возведения их в квадрат:
    </div><br>
    <form action="array.php" method="post">
        <input type="text" name="arr" pattern="^\d[\d,\s]+?\d$"  title="1, 2, 3, 4,..."><br><br>
        <input type="submit" value="submit">
    </form>
</center>
<?php

function double($n) {
    return $n*$n;
}
if($_POST["arr"] != '') {
    $arr = $_POST["arr"];
    $array = explode(", ", $arr);
    $array_sq = array_map("double", $array);

    echo '<br><center>Ваш массив в Var_dump():<br><br>';
    var_dump($array_sq);
    echo '<br><br><br><br>';
    foreach ($array_sq as $key => $array_n) {
        echo $key . ' элемент массива: ' . $array_n . '<br>';
    }
    echo '</center>';
}else{
    echo '<center>Введите данные!</center>';
}
?>
</body>
</html>

