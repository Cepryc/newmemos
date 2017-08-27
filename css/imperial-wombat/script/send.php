
<?php

error_reporting (0);

//подключаем библиотеку
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



$user=file_get_contents("../user.txt");
$pas=file_get_contents("../password.txt");

$post=$_REQUEST['post'];
$text=$_REQUEST['text'];

$tag1=$_POST['tag1'];
$tag2=$_POST['tag2'];
$tag3=$_POST['tag3'];




if (checkbox_verify('tag_check')==1) {
$tagi=$tag1.",".$tag2.",".$tag3; }
else
{$tagi="";}






if (checkbox_verify('checkme')==1) {
$post2=$text."<lj-cut>".$post."</lj-cut>"; }
else
{$post2=$text."".$post;}





//выставляем внутреннюю кодировку,
//чтоб не было проблем с перекодированием
$GLOBALS['xmlrpc_internalencoding'] = 'UTF-8';
header('Content-type:text/html;charset=utf-8');




//логин и пароль к ЖЖ
$u_name = $user;
$u_pass = $pas;



//обращаемся кwww.livejournal.com/interface/xmlrpc
$lj = new xmlrpc_client(
'/interface/xmlrpc','www.livejournal.com',80);
//кодировка клиента
$lj->request_charset_encoding = 'UTF-8';
//чтоб возвращал в виде php-переменных
$lj->return_type = 'phpvals';
//если нужен дебаг
//$lj->setDebug(3);
//получаем chellange
$chellange = $lj->send(
new xmlrpcmsg('LJ.XMLRPC.getchallenge'));
if($chellange->faultCode()){
die(
'Невозможно получить chellange:'.
$chellange->faultString());
}
$c = $chellange->value();




//собираем данные для поста
$data = array();
//имя пользователя
$data['username'] = new xmlrpcval($u_name,'string');
//метод аутентификации: clear, cookie или challenge
$data['auth_method'] = new xmlrpcval('challenge','string');



//строка с challenge
$data['auth_challenge'] = new xmlrpcval($c['challenge'],'string');
//шифруем пароль
$data['auth_response'] = new xmlrpcval(
md5($c['challenge'] . md5($u_pass)),'string');
//версия протокола 0 или 1
//если используется 1, то все данные должны
//быть в кодировке UTF-8
$data['ver'] = new xmlrpcval('1','string');
//символ перевода строк \n или \r\n
$data['lineendings']=new xmlrpcval("\n",'string');


//название поста в UTF-8
$data['subject'] = new xmlrpcval(
mb_convert_encoding($title,
'UTF-8','UTF-8'),'string');


//текст поста в UTF-8
$data['event'] = new xmlrpcval(
mb_convert_encoding($post2,'UTF-8','UTF-8'),'string');



//дата
$data['day'] = new xmlrpcval(date('d'),'string');
$data['mon'] = new xmlrpcval(date('m'),'string');
$data['year'] = new xmlrpcval(date('Y'),'string');
$data['hour'] = new xmlrpcval(date('H'),'string');
$data['min'] = new xmlrpcval(date('i'),'string');
//доступ к посту публичный
$data['security'] = new xmlrpcval('public','string');



//некоторые мета-данные
$data['props'] = new xmlrpcval(array(
//true, если пост в отформатирован в html
'opt_preformatted' => new xmlrpcval(true,'boolean'),
//true, если запись добавляем задним числом
'opt_backdated' => new xmlrpcval(true,'boolean'),



//список тегов через запятую в UTF-8
'taglist' => new xmlrpcval(
mb_convert_encoding(


$tagi


,
'UTF-8','UTF-8')),
),'struct');






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









<a href="index.php"><<<<<<<<<<< </a>





<?php




$d = new xmlrpcval($data,'struct');
//вызываем процедуру LJ.XMLRPC.postevent
$result = $lj->send(new xmlrpcmsg(
'LJ.XMLRPC.postevent', array($d)),0,'http11');
//если произошла ошибка, то сообщаем об ошибке
if($result->faultCode()){

echo "<img src='lib/Okay-guy-face.jpg'><br><br>";

die($result->faultString());


}
//если все нормально, то сервер вернет
//структуру с 3-мя переменными:
//itemid - идентификатор поста
//url - URL-адрес поста
//anum - аутентификационный номер,
//созданный для этой записи
$p_data = $result->value();



?>













<br>
		<img src="lib/post.jpg">
		<br>



<b><font size= 5><a href=" 
<?php
echo $p_data['url'];
//echo $p_data['anum']."<br />";
//echo $p_data['itemid']."<br />";
?>
">
<?php  echo $p_data['url'];  ?>
</a></font></b>

       </div>
     </body>
</html>


<?php


$open_file=fopen("lib/twitter.txt",'a');
$text=$title." ".$p_data['url']."\r\n";
fwrite($open_file, iconv("UTF-8", "WINDOWS-1251", "$text"));
fclose($open_file);







?>
