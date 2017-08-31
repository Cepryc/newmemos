<?php
set_time_limit(59);

include("../../curl.php");

$server_name = $_SERVER['SERVER_NAME'];
$cron_path="http://".$server_name."/backend/Global/cron/1.php";
$backend_path="http://".$server_name."/backend/";


get_content($backend_path."ItemsParser/index.php",14);
get_content($backend_path."HashParser/index.php",14);
get_content($backend_path."AttachmentsParser/index.php",14);
get_content($backend_path."Cache/index.php",14);


?>