<html>
<head>
    <title>Recursion.ru</title>
</head>
<body>
<?php
function recursion(&$spaces, $dir_parts, &$dir_watch, &$key){
    $dir = $dir_parts[$key];
    $dir_watch .= (string)$dir . '\\';
    var_dump($dir_watch);
    if(is_dir($dir_watch)){
        if ($handle = opendir("$dir_watch")) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    if (fnmatch("*.*", $entry) && !fnmatch("*.BIN", $entry)) {
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
            }
            $spaces++;
            $key = $key+1;
            recursion($dir, $spaces, $dir_parts, $dir_watch, $key);
            closedir($handle);
        }

    }
}
/*function recursion(&$spaces, $dir_parts){
    $space = "&nbsp;&nbsp;&nbsp;";
    $dir_watch = '';
    foreach($dir_parts as $dir_part){
        $dir_watch .= $dir_part . '\\';
        if(is_dir($dir_watch)){
            if ($handle = opendir("$dir_watch")) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != ".." && $entry == $dir_part) {
                        if (fnmatch("*.*", $entry) && !fnmatch("*.BIN", $entry)) {
                            for ($i = 0; $i < $spaces; $i++) {
                                echo $space;
                            }
                            echo '<img src="\tasks\2.png"> ' . $entry . '<br>';
                        } else {
                            for ($i = 0; $i < $spaces; $i++) {
                                echo $space;
                            }
                            echo '<img src="\tasks\1.gif">' . $entry . '<br>';
                        }
                        //$new_dir = $dir . "/" . $entry;
                        //if (@filetype($new_dir) == "dir") {
                          //  $dir = $new_dir;
                            //$spaces++;
                            //recursion($dir, $spaces, $dir_parts);
                        }
                    }
                }
            }
            $spaces++;
            //recursion($dir, $spaces, $dir_parts);
            closedir($handle);
        }
    }
}*/
?>
<form method='POST' action='recursion.php'>
    <center>
        <h3>Specify the directory</h3>
        <input type="text" name="dir" style="width:240px; text-align:center;"><br><br>
        <input type="submit" name="submit" value="Send">
    </center>
</form>
<?;
define("SP", "&nbsp;&nbsp;&nbsp;");
$spaces = 0; $dir_watch = ''; $key = 0;
if($_POST["submit"] == 'Send'){
    if(is_dir($_POST["dir"])){
        $dir_parts = explode("\\", $_POST["dir"]);
        recursion($spaces, $dir_parts, $dir_watch, $key);
    }else{
        echo '<center><h4>Wrong name of directory</h4></center>';
    }
}
?>
</body>
</html>
