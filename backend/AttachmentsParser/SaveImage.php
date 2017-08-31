<?php
ini_set('max_input_time', 4);
ini_set('max_execution_time', 4);
set_time_limit(4);
error_reporting(0);


include_once ("../curl.php");
$input=$_GET['input'];
$output=$_GET['output'];


$temp_img=get_content($input,"2");

if($temp_img<>"" AND !empty($temp_img)){
	file_put_contents("temp.jpg", $temp_img);
}else{
    exit();
}




function saveimage($input="temp.jpg", $output)
{
	$today = "2017";
    // файл и новый размер

    // исходная картинка
    $img = $input;

    // получаем размер картинки
    $size = getimagesize($img);
    $height = $size[1]; // высота
    $width = $size[0]; // ширина
    // картинка, которая будет использована
    // в качестве водяного знака
    $watermark_src = 'watermark.png';
    // получаем размер водяного знака
    $sizeWM = getimagesize($watermark_src);
    $heightWM = $sizeWM[1]; // высота водяного знака
    $widthWM = $sizeWM[0]; // ширина водяного знака
    // задаем прозрачность водяного знака
    $opacity = 0;
    //Загружаем изображения
    $image = imagecreatefromjpeg($img);
    $watermark = imagecreatefrompng($watermark_src);
    // высчитываем координаты, для водяного знака.
    // Внизу справа
    $x = $width - $widthWM;
    $y = $height - $heightWM;
    //Копируем водяной знак на изображение
    imagecopymerge(
        $image, $watermark, $x, $y, 0, 0,
        $widthWM, $heightWM, $opacity
    );
    // задаем заголовок, чтоб вывести результат в браузере
    //header('Content-Type: image/jpeg');
    // выводим картинку
    imagejpeg($image, "../../images/".$today."/".$output.".jpg");
    // очищаем память
    imagedestroy($image);
    imagedestroy($watermark);
	
	return "OK";
}


echo saveimage("temp.jpg", $output);
unlink("temp.jpg");
exit();


?>