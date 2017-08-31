<?php

setcookie('rating',$_POST['rating']);
setcookie('time',$_POST['time']);





header("location: ".$_SERVER['HTTP_REFERER']);

?>