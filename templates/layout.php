<?php
    //header('Content-Type: text/html; charset=utf-8');
    //setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
?>
<html>
<head>
    <title><?php echo $title ?></title>
</head>
<body>
<center>
    <div style=" width: 100px; align="center">
    <form action="bash.php" method="post">
        <input type="submit" value="Save text" name="save">
    </form>
    </div>
</center>
<?php foreach ($arr_text as $key => $value):?>
    <center>
        <div style=" width: 808px; background: #CDC5BF; padding: 2px; font-size: 14px" align="center">
            <pre>Rating: <?echo $value[1];?>        Date: <?echo $value[2];?>         Number: <?echo $value[3];?></pre>
        </div>
        <hr align="center" size="3" width="810" color="#8B8682" noshade>
        <div style=" width: 800px; background: #EEE9E9; padding: 6px; font-size: 16px" align="left">
            <p align="justify"><?echo $value[4];?></p>
        </div>
    </center>
    <br><br>
<? endforeach ?>
<center><br>
    <form action="bash.php" method="post">
        <input type="submit" value="Save text" name="save">
    </form>
</center>
</body>
</html>
