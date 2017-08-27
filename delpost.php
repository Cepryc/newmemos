<?php

if($_GET['del']<>"ecibaldo"){
	exit();
}

include_once('backend/curl.php');
include_once('backend/db.php');
$db = new Database();



$id=$_GET['id'];
$db->db_update("items", "SET ignore_post=1 WHERE id='$id'");



?>