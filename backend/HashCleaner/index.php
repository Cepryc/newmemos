<?php
set_time_limit(58);
include_once('../db.php');
include("../vendor/autoload.php");
use Jenssegers\ImageHash\ImageHash;
$hasher = new ImageHash;

$db = new Database();
$check_arr[]="";



for($k=0;$k<18;$k++){

$counter = file_get_contents('counter.txt');

$sort_file = file("sort_temp.txt");
$sort_param = $sort_file[$counter];
$sort_param_count=count($sort_file)-1;

if ($counter == "" or $counter>=$sort_param_count) {
    $counter = 0;
}

$items_file=file_get_contents("hash_temp/".trim($sort_param).".json");
$items=json_decode($items_file);
$items_count=count($items);

//print_r($items[0]->id);
//$sort_param="30dl";
//echo $sort_param."<hr>";


	for($j=0;$j<$items_count;$j++){
	
		$old_hash=$items[$j]->hash;
		
		
		for($i=0;$i<$items_count;$i++){
		
			$new_hash=$items[$i]->hash;
		
		if($old_hash<>"" AND $new_hash<>""){	
					
				$item_id=$items[$i]->id;		
				$comp = $hasher->distance($old_hash, $new_hash);
				


				if($comp>0 AND $comp<4){
					
					if(in_array($old_hash, $check_arr)==false){

						$db->db_update("items","SET attachment_hash='$old_hash' WHERE attachment_hash='$new_hash'");
						//echo $item_id."//1- ".$comp." | ".$new_hash." | ".$old_hash." // <img src='../../images/04052017/".$items[$j]->hash."_0.jpg' width=300px;>//<img src='../../images/04052017/".$items[$i]->hash."_0.jpg' width=300px;><hr>";
						
						$check_arr[]=$new_hash;	

					}
				
				}
							
			}
			
		}

	}



//print_r($check_arr);
unset($check_arr);

$counter++;
file_put_contents("counter.txt", $counter);

}



?>