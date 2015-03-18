<?php session_start(); $title = "Registration"; ?>
<!--picture load-->

<!--picture crop-->
<link rel="stylesheet" type="text/css" href="../crop/imgareaselect-default.css" />
<script src="../crop/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="../crop/jquery.imgareaselect.pack.js"></script>
<!---->
<form method='POST' action='/index.php?page=register' enctype="multipart/form-data">
    <center>
        <br><font color="red" face="Zapf Chancery, cursive"><h1>Регистрация</h1></font><br>
        <div style="width:300px; text-align:center; font-size:18px;">
            <pre><font color="red" face="Zapf Chancery, cursive">Логин:</font>       <font color="red">*</font><input title="Для ввода разрешены: цифры и латинские символы." type="text" name="login" style="width:140px; text-align:center;"></pre>
        </div>
        <div style="width:300px; text-align:center; font-size:18px;">
            <pre><font color="red" face="Zapf Chancery, cursive">Пароль:</font>      <font color="red">*</font><input title="Для ввода разрешены: цифры и латинские символы." type="text" name="password" style="width:140px; text-align:center;"></pre>
        </div>
        <div style="width:300px; text-align:center; font-size:18px;">
            <pre><font color="red" face="Zapf Chancery, cursive">E-mail:</font>       <font color="red">*</font><input type="text" name="email" style="width:140px; text-align:center;"></pre>
        </div>
        <div style="width:300px; text-align:center; font-size:18px;">
            <pre><font color="red" face="Zapf Chancery, cursive">Имя:</font>          <input title="Для ввода разрешены: русские и латинские символы."  type="text" name="name" style="width:140px; text-align:center;"></pre>
        </div>
        <div style="width:300px; text-align:center; font-size:18px;">
            <pre><font color="red" face="Zapf Chancery, cursive">Возраст:</font>   <select name="day">
                <?php $i = 1;?>
                <?php while ($i <= 31):?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php $i++;?>
                <?php endwhile?>
            </select><select name="month">';
                <?php $month_add = array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");?>
                <?php foreach ($month_add as $m):?>
                    <option value="<?php echo $m;?>"><?php echo $m;?></option>
                <?php endforeach?>
            </select><select name="year">';
                <?php $j = 2014;?>
                <?php while ($j >= 1920):?>
                    <?php $j--;?>
                    <option value="<?php echo $j;?>"> <?php echo $j;?></option>
                <?php endwhile?>
            </select></pre>
        </div>
        <div style="width:300px; text-align:center; font-size:18px;">
            <pre><font color="red" face="Zapf Chancery, cursive">Пол:</font>               <select name="sex">
                <option name="sex_male" value="male">Мужской</option>
                <option name="sex_female" value="female">Женский</option>
            </select></pre>
        </div>
        <div style="width:300px; text-align:center; font-size:18px;">
            <pre><font color="red" face="Zapf Chancery, cursive">О себе:</font>  <textarea name="about" size="50" rows="3" cols="22"></textarea></pre>
        </div>
        <input type="submit" name="submit" value="Сохранить" style="width:80px; text-align:center;"><br><br>
    </center>
</form>
<!--picture load-->
<form id="formUpload" method="post" enctype="multipart/form-data" action="/templates/handler.php">
    <center>
        <input type="file" name="file" id="file" />
        <div id="preview"></div>
    </center>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#file').live('change', function() {
            $("#preview").html('');
            $("#preview").html('Идет загрузка, подождите.');
            $("#formUpload").ajaxForm({
                target: '#preview'
            }).submit();
        });
    });
</script>
<!--picture crop-->
<center>
    <p>
        <img id="photo" src="../crop/photo.jpg" alt="" title="" style="margin: 0 0 0 10px;" />
    </p>
    <form action="../crop/crop.php" method="post">
        <input type="hidden" name="x1" value="" />
        <input type="hidden" name="y1" value="" />
        <input type="hidden" name="x2" value="" />
        <input type="hidden" name="y2" value="" />
        <input type="hidden" name="w" value="" />
        <input type="hidden" name="h" value="" />
        <input type="submit" value="Обрезать" />
    </form>
</center>

<script type="text/javascript">
    function preview(img, selection) {
        var scaleX = 100 / (selection.width || 1);
        var scaleY = 100 / (selection.height || 1);
        $('#photo + div > img').css({
            width: Math.round(scaleX * 600) + 'px',
            height: Math.round(scaleY * 400) + 'px',
            marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
            marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
        });
    }
    $(document).ready(function () {
        $('<div><img src="../crop/photo.jpg" style="position:relative;" /><div>') .css({
            float: 'top',
            position: 'relative',
            overflow: 'hidden',
            width: '100px',
            height: '100px'
        }) .insertAfter($('#photo'));

        $('#photo').imgAreaSelect({
            aspectRatio: '1:1',
            handles: true,
            onSelectChange: preview,
            onSelectEnd: function ( image, selection ) {
                $('input[name=x1]').val(selection.x1);
                $('input[name=y1]').val(selection.y1);
                $('input[name=x2]').val(selection.x2);
                $('input[name=y2]').val(selection.y2);
                $('input[name=w]').val(selection.width);
                $('input[name=h]').val(selection.height);
            }
        });
    });
</script>
<!---->
<center>
    <?php if ($register == 1): ?>
        <?php if (!$login): ?>
            <h2>Логин введен не корректно!</h2>
        <?php endif; ?>
        <?php if(!$password): ?>
            <h2>Пароль введен не корректно!</h2>
        <?php endif; ?>
        <?php if(!$email): ?>
            <h2>Email введен не корректно!</h2>
        <?php endif; ?>
    <?php elseif($register == 2): ?>
        <h2>Регистрация завершена успешно!</h2>
    <?php endif; ?>
</center>
