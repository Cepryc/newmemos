<?php

error_reporting (0);

include('jjport.php');

$title= $_POST['title'];

function checkbox_verify($_name)
{
$result=0;// обязательно прописываем, чтобы функция всегда возвращала результат 
// проверяем, а есть ли вообще такой checkbox на html форме, а то часто промахиваются
if (isset($_REQUEST[$_name]))
{ if ($_REQUEST[$_name]=='on') { $result=1; } else { $result=0; }
}
return $result;
}



$user=file_get_contents("../../user.txt");
$pas=file_get_contents("../../password.txt");

$post=$_REQUEST['post'];
$text=$_REQUEST['text'];

if (checkbox_verify('checkme')==1) {
$post2=$text."<lj-cut>".$post."</lj-cut>"; }
else
{$post2=$text."".$post;}

$port=new port();
$port->add('username',$user, 'string');
$port->add('password',$pas, 'string');

$date = time();
$year = date("Y", $date);
$mon = date("m", $date);
$day = date("d", $date);
$hour = date("G", $date);
$min = date("i", $date);

$port->add('mon',$mon, 'int');
$port->add('day',$day, 'int');
$port->add('year',$year, 'int');
$port->add('hour',$hour, 'int');
$port->add('min',$min, 'int');
//public (default), private and usemask
$port->add('security','public', 'string');
$port->add('subject',$_REQUEST['title'], 'string');
$port->add("lineendings", "unix", "string");
$port->add('event',$post2, 'string');
$port->add('ver','2', 'int');

$res=$port->send();

if(array_key_exists("url",$res)) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
       <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">

        <title>LiveJournal Posting</title>
        <style type="text/css">
body {
margin:0;
padding:0;
background: #f5f5f5;
font-face:Arial;
font-size:12pt;
color:#9FBBEA;
}
div#form {
text-align:center;
width:90%;
font-size:100%;
margin: 0 auto;
text-align:left;
}
h1 {
font-face:Times New Roman;
font-size:26pt;
color:#9FBBEA;
}
</style>
    </head>
    <body>
        <div id="form" align="center">
        <h1> </h1>
         <a href="index.php"><<<<<<<<<<<<</a>
		<br>
		<img src="copy.jpg">
		<br><br><br><br>

		<b><font size= 5><a href="<?php echo $res['url']?>"><?php echo $res['url']?></a></font></b>

<?php
$fp = fopen("../twitter.txt", "a"); // Открываем файл в режиме записи
$mytext = $title." ".$res['url']."\r\n"; // Исходная строка
$test = fwrite($fp, $mytext); // Запись в файл
if ($test) echo '';
else echo 'С твиттером тоже случилась какая- та фигня';
fclose($fp); //Закрытие файла
?>




        </div>
     </body>
</html>
<?
} else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
       <meta http-equiv="content-type" content="text/html; charset=UTF-8">

        <title>LiveJournal Posting</title>
        <style type="text/css">
body {
margin:0;
padding:0;
background: #f5f5f5;
font-face:Arial;
font-size:12pt;
color:#9FBBEA;
}
div#form {
text-align:center;
width:90%;
font-size:100%;
margin: 0 auto;
text-align:left;
}
h1 {
font-face:Times New Roman;
font-size:26pt;
color:#9FBBEA;
}
</style>
    </head>
    <body>
        <div id="form" align="center">
        <h1>Error. Post not created.</h1>
		<img src="fail.jpg">
		
		<p>Error code: <?php echo $res['errorcode'] ?></p>
		<p>Error Text: <?php echo $res['errortext'] ?></p>
        </div>
     </body>
</html>
<?
}