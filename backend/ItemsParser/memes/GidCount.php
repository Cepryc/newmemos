<?php
set_time_limit(0);

$counter=0;
$gids_file=file("GidList.txt");
$gids_count=count($gids_file);

for($j=0;$j<50;$j++){




$gids_list="";
for($i=$counter;$i<$counter+100;$i++){
	$gids_list=$gids_list.",".trim($gids_file[$i]);
	if($gids_file[$i]==""){
		break;
	}
}

	$gids_list=substr($gids_list,1);
	$members_count_arr=json_decode(file_get_contents("https://api.vk.com/method/groups.getById?group_ids=".$gids_list."&fields=members_count"));
	
	for($i=0;$i<count($members_count_arr->response);$i++){
		$gid_members=$members_count_arr->response[$i]->members_count;
		$gid=$members_count_arr->response[$i]->gid;
		
		if($gid<>""){
		$gidzzz_arr[$gid]=$gid_members;
		}else{
			$stop=1;
			break;
		}
	}
	if($stop==1){break;}
	$counter=$counter+100;	

	
	
	if($gids_count==count($gidzzz_arr)){
		file_put_contents("GidCount.txt",json_encode($gidzzz_arr));
		exit();
	}
	
}
	

	
?>