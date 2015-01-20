<html>
<head>
    <title>Recursion.ru</title>
</head>
<body>
<?php
function recursion($count_parts, &$spaces, $dir_parts, &$dir_watch, &$key){
    $dir = $dir_parts[$key];
    $dir_watch .= $dir . '\\';
    if(is_dir($dir_watch)){
        if ($handle = opendir("$dir_watch")) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != $dir_parts[$key+1]){
                    if ($entry != "." && $entry != "..") {
                        if (fnmatch("*.*", $entry) && !fnmatch("*.BIN", $entry) && !fnmatch("*.Bin", $entry) && !fnmatch(".*", $entry)) {
                            for ($i = 0; $i < $spaces; $i++) {
                                echo SP;
                            }
                            echo '<img src="\tasks\2.png"> ' . $entry . '<br>';
                        } else {
                            for ($i = 0; $i < $spaces; $i++) {
                                echo SP;
                            }
                            echo '<img src="\tasks\1.gif">' . $entry . '<br>';
                        }
                    }
                }else{
                    for ($i = 0; $i < $spaces; $i++) {
                        echo SP;
                    }
                    echo '<img src="\tasks\1.gif">' . $entry . '<br>';
                    break;
                }
            }
            while ($key < $count_parts-1){
                $spaces++;
                $key = $key+1;
                recursion($count_parts, $spaces, $dir_parts, $dir_watch, $key);
            }
            closedir($handle);
        }

    }
}
    /*$new_dir = $dir . "/" . $entry;
    if (is_dir(filetype($new_dir) == "dir")) {
        $dir = $new_dir;
        $spaces++;
        recursion($dir, $spaces, $dir_parts);*/

?>
<form method='POST' action='recursion.php'>
    <center>
        <h3>Specify the directory</h3>
        <input type="text" name="dir" style="width:240px; text-align:center;"><br><br>
        <input type="submit" name="submit" value="Send">
    </center>
</form>
<?
define("SP", "&nbsp;&nbsp;&nbsp;");
$spaces = 0; $dir_watch = ''; $key = 0;
if($_POST["submit"] == 'Send'){
    if(is_dir($_POST["dir"])){
        $dir_parts = explode("\\", $_POST["dir"]);
        $count_parts = count($dir_parts);
        echo '<h3>Directory: '. $dir_parts[0].'/'.'</h3>';
        recursion($count_parts, $spaces, $dir_parts, $dir_watch, $key);//рекурсия должна принимать только папку и кол-во пробелов
    }else{
        echo '<center><h4>Wrong name of directory</h4></center>';
    }
}
?>
</body>
</html>
