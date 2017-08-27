<?php


set_time_limit(0);


include_once('db.php');
$db = new Database();


$del_time = mktime(date("H"), date("i"), 0, date("m")-1, date("d"), date("Y"));
$files = scandir("../images/2017/");
$files_count=count($files);
$del_files_count=0;

$db->db_delete("items","WHERE date<$del_time");


for($i=2;$i<$files_count; $i++){
	
		$file_time=filemtime("../images/2017/".$files[$i]);
		if($file_time<$del_time){
			unlink("../images/2017/".$files[$i]);	
			$del_files_count++;
			
		}
}

echo $files_count;
echo "<br>";
echo $del_files_count;


?>