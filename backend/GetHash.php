<?php
error_reporting(0);

ini_set('max_execution_time',3);
ini_set ('max_input_time', 3);
set_time_limit(3);


$file=$_GET['file'];

include("vendor/autoload.php");
use Jenssegers\ImageHash\ImageHash;

$hasher = new ImageHash;
$hash = $hasher->hash($file);

if($hash<>"" AND $hash<>0){
	
	echo $hash;
	
}



?>