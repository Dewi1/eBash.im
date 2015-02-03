<?php session_start(); $title = "Registration"; ?>

<form method='POST' action='/index.php?page=register'>
    <center>
        <br><font color="red" face="Zapf Chancery, cursive"><h1>Регистрация</h1></font><br>
        <div style="width:300px; text-align:left; font-size:18px; position:absolute; top:190px; left:550px">
            <font color="red" face="Zapf Chancery, cursive">Логин:</font>
        </div>
        <div style="width:300px; text-align:right; font-size:18px; position:absolute; top:190px; left:550px">
            <font color="red">*</font><input title="Для ввода разрешены: цифры и латинские символы." type="text" name="login" style="width:140px; text-align:center;"><br>
        </div>
        <div style="width:300px; text-align:left; font-size:18px; position:absolute; top:220px; left:550px">
            <font color="red" face="Zapf Chancery, cursive">Пароль:</font>
        </div>
        <div style="width:300px; text-align:right; font-size:18px; position:absolute; top:220px; left:550px">
            <font color="red">*</font><input title="Для ввода разрешены: цифры и латинские символы." type="text" name="password" style="width:140px; text-align:center;"><br>
        </div>
        <div style="width:300px; text-align:left; font-size:18px; position:absolute; top:250px; left:550px">
            <font color="red" face="Zapf Chancery, cursive">E-mail:</font>
        </div>
        <div style="width:300px; text-align:right; font-size:18px; position:absolute; top:250px; left:550px">
            <font color="red">*</font><input type="text" name="email" style="width:140px; text-align:center;"><br>
        </div>
        <div style="width:300px; text-align:left; font-size:18px; position:absolute; top:280px; left:550px">
            <font color="red" face="Zapf Chancery, cursive">Имя:</font>
        </div>
        <div style="width:300px; text-align:right; font-size:18px; position:absolute; top:280px; left:550px">
            <input title="Для ввода разрешены: русские и латинские символы."  type="text" name="name" style="width:140px; text-align:center;"><br>
        </div>
        <div style="width:300px; text-align:left; font-size:18px; position:absolute; top:310px; left:550px">
            <font color="red" face="Zapf Chancery, cursive">Возраст:</font>
        </div>
        <div style="width:300px; text-align:right; font-size:18px; position:absolute; top:310px; left:550px">
            <select name="day">
                <?php $i = 1;?>
                <?php while ($i <= 31):?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php $i++;?>
                <?php endwhile?>
            </select>
            <select name="month">';
                <?php $month_add = array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");?>
                <?php foreach ($month_add as $m):?>
                    <option value="<?php echo $m;?>"><?php echo $m;?></option>
                <?php endforeach?>
            </select>
            <select name="year">';
                <?php $j = 2014;?>
                <?php while ($j >= 1920):?>
                    <?php $j--;?>
                    <option value="<?php echo $j;?>"> <?php echo $j;?></option>
                <?php endwhile?>
            </select><br>
        </div>
        <div style="width:300px; text-align:left; font-size:18px; position:absolute; top:340px; left:550px">
            <font color="red" face="Zapf Chancery, cursive">Пол:</font>
        </div>
        <div style="width:300px; text-align:right; font-size:18px; position:absolute; top:340px; left:550px">
            <select name="sex">
                <option name="sex_male" value="male">Мужской</option>
                <option name="sex_female" value="female">Женский</option>
            </select><br>
        </div>
        <div style="width:300px; text-align:left; font-size:18px; position:absolute; top:370px; left:550px">
            <font color="red" face="Zapf Chancery, cursive">О себе:</font>
        </div>
        <div style="width:300px; text-align:right; font-size:18px; position:absolute; top:370px; left:550px">
            <textarea name="about" size="50" rows="3" cols="22"></textarea>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <input type="submit" name="submit" value="Сохранить" style="width:80px; text-align:center;">
    </center>
</form>
<center>
    <?php if (!$login): ?>
        <h2>Логин введен не корректно!</h2>
    <?php elseif(!$password): ?>
        <h2>Пароль введен не корректно!</h2>
    <?php elseif(!$name): ?>
        <h2>Имя введено не корректно!</h2>
    <?php elseif(!$email): ?>
        <h2>Email введен не корректно!</h2>
    <?php endif; ?>
    <?php if ($register == true): ?>
        <h2>Регестрация завершена</h2>
    <?php endif; ?>
</center>
