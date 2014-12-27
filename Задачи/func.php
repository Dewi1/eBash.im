<html>
<head>
    <title>Functions.ru</title>
</head>
<body>
<?php
    function foo()
    {
        echo 'Function "foo" vas completed';
    }
    function bar()
    {
        echo 'Function "bar" vas completed';
    }

    function baz()
    {
        echo 'Function "baz" vas completed';
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
    if($_POST['func'] == 'foo'){
        foo();
    }elseif($_POST['func'] == 'bar'){
        bar();
    }elseif($_POST['func'] == 'baz'){
        baz();
    }elseif($_POST['func'] == ''){
        echo 'Enter function name!';
    }else{
        echo 'Function vas not completed';
    }
    echo '<br></center>';
?>
</body>
</html>
