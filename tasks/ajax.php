<html>
    <head>
        <title>Ajax</title>
    </head>
    <body>
        <script type="text/javascript" src="../crop/jquery-1.5.1.min.js"></script>
        <center> <br><br>
            <!--<select name="count" onchange="selectChanged(this.value);">-->
                <select onchange='$.post("ajax_func.php",{count: this.options[this.selectedIndex].value},function(data){alert(data);});'>
                <option value="1">Test_1</option>
                <option value="2">Test_2</option>
            </select>
        </center>
    </body>
</html>
