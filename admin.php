<?php

$login=$_POST['login'];
$password=$_POST['password'];

if($login="admin123" AND $password="777smu15"){
	setcookie('admin','1',time() + 60 * 60 * 24 * 30 * 12);
	echo "Успешно залезли! =)";
}else{
	exit();
}




?>

<div style="width:200px; margin:0 auto">
	<form action="index.php" method="POST">
	<input type="text" size="10" name="login">
	<br>
	<input type="text" size="10" name="password">
	<br>
	<input type="submit" value="Отправить">
	</form>
</div>