<?php
set_time_limit(3);
$url= "http://".$_SERVER['HTTP_HOST'];

file_get_contents($url."/backend/ItemsParser/memes/index.php?table=memes_items");

?>