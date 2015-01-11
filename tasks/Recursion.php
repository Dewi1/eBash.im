<?php
//header('Content-Type: text/html; charset=utf-8');
//setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
?>
<html>
<head>
    <title>Recursion.ru</title>
</head>
<body>
<?php

function recursion($dir){
    $space = "&nbsp;";
    if ($handle = opendir("$dir")) {
        $arr = array();
        $i=0;
        echo "<form method='POST' action='recursion.php'>";
        while (false !== ($entry = readdir($handle))) {
            $arr[] = $entry;
            if (fnmatch("*.*", $entry) && $entry != "." && $entry != "..") {
                echo '<img src="\tasks\2.png"> '.$arr[$i] .'<br>';
            }else{
                echo '<img src="\tasks\1.gif"><input type="submit" name="submit" value="'.$arr[$i] .'"><br>';
            }
            if($_POST["submit"] == $arr[$i])
            {
                $dir = "e:/../".$arr[$i];
                recursion($dir);
            }
            $i++;
        }
        echo "</form>";
        closedir($handle);
    }
}
$dir = "e:/";
recursion($dir);



?>
</body>
</html>
