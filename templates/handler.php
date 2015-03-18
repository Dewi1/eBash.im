<?php
define('UPLOAD_FILE', 'W:\domains\ebash.local\images');
$valid_formats = array("jpg", "png", "gif","jpeg");

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    if(strlen($name))
    {
        list($txt, $ext) = explode(".", $name) ;
        if(in_array($ext,$valid_formats))
        {
            if($size < (1024 * 1024 * 1024))
            {
                $actual_image_name = 'image'.date("m.d.y").'_'.rand(5, 1500) . $ext;
                $tmp = $_FILES['file']['tmp_name'];
                if(move_uploaded_file($tmp, UPLOAD_FILE . $actual_image_name))
                {
                    //echo "<img src=\"" . UPLOAD_FILE . "/{$actual_image_name}\" class=\"preview\" alt="JavaScript: Загрузка картинок с помощью jQuery и PHP" /> "; // показываем превьюшку
                    ?><img src="<?php echo UPLOAD_FILE . $actual_image_name;?>" class="preview" alt="JavaScript: Загрузка картинок с помощью jQuery и PHP"><?php
                 }
                else echo "Ошибка.";
            }
            else echo "Максимальный размер файла не должен превышать 1MB.";
        }
        else echo "Допустимые форматы: jpg, jpeg, png, gif)";
    }
    else die("Пожалуйста выберите изображение!") ;
}

/*
$dir = '../images/';
$name = 'image'.date("m.d.y").'_'.rand(5, 1500).'.jpg';
$file = $dir . $name;
//$file_square = $dir . 'cut_square_'.$name;
//$file_half = $dir . 'cut_half_'.$name;
//$success = move_uploaded_file('cut_square_'.$name, $file_square);
//$success = move_uploaded_file('cut_half_'.$name, $file_half);
$success = move_uploaded_file($_FILES['loadfile']['tmp_name'], $file);
/*$size = getimagesize($_FILES['loadfile']['tmp_name']);
$width = $size[0]; $height = $size[1];
if ($width > $height) {
    imagecopyresampled('cut_square_'.$name, $name, 0, 0, 0, 0, $height, $height, $height, $height);
    $height = $height/2;
    imagecopyresampled('cut_half_'.$name, 'cut_square_'.$name, 0, 0, 0, 0, $height, $height, $height, $height);
}elseif($width <= $height){
    imagecopyresampled('cut_square_'.$name, $name, 0, 0, 0, 0, $width, $width, $width, $width);
    $width = $width/2;
    imagecopyresampled('cut_half_'.$name, 'cut_square_'.$name, 0, 0, 0, 0, $width, $width, $width, $width);
}*/

jsOnResponse("{'filename':'" . $name . "', 'success':'" . $success . "'}");