<?php session_start();
function registration($login, $password, $name, $email, $about, $sex, $date) {
    $register = mysql_query("INSERT INTO users (login, password, name, email, about, sex, age) VALUES('$login', '$password', '$name', '$email', '$about', '$sex', '$date')");
    return $register;
}
//нельзя вставлять то, что ввёл пользователь!!!
//sql инъекция
function month($month_word) {
    $months = array(1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
    $month = array_search($month_word, $months);
    return $month;
}
