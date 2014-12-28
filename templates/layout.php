<html>
<head>
    <title><?php echo $title ?></title>
    <style>
        a {
            text-decoration: none; /* Отменяем подчеркивание у ссылки */
        }
        li {
            list-style-type: none; /* Убираем маркеры */
        }
        textarea {
            resize: none; /* Запрещаем изменять размер */
        }
    </style>
</head>
<body>
<?php echo $content; ?>
</body>
</html>
