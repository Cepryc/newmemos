<?php
set_time_limit(58);


$server_name = $_SERVER['SERVER_NAME'];
$today = "2017";

include_once('../curl.php');
include_once('../db.php');


$db = new Database();
$items = $db->db_select("items", "attachment_hash, attachments, bad_post", "WHERE attachment_hash<>'' AND good_post=0 AND un=1 GROUP BY attachment_hash order by bad_post ASC, date ASC, RAND() LIMIT 100");

if ($items[0] == "") {
    echo "die";
    exit();

}



foreach ($items as $item) {

    $good_post = 0;
    $bad_files = 0;
    $check_attachments_count=0;
    $bad_post = $item['bad_post'];
    $attachment_hash = $item['attachment_hash'];
    $attachments_json = $item['attachments'];
    $attachments = json_decode($attachments_json);
    $attachments_count = count($attachments);

    for ($i = 0; $i < $attachments_count; $i++) {
            $save_img = "http://".$server_name."/backend/SaveImage.php?input=".trim($attachments[$i])."&output=".$attachment_hash."_".$i;
            
			$files_status="";
			$files_status = get_content($save_img, 5);
		
            if (trim($files_status) == "OK") {
                $check_attachments_count++;
				
            }


    }

        if ($check_attachments_count>=$attachments_count) {			
                $db->db_update("items", "SET good_post=1, pdate='$today', bad_post=0 WHERE attachment_hash='$attachment_hash'");	
				
        }else{
            $bad_post++;
            $db->db_update("items", "SET bad_post='$bad_post' WHERE attachment_hash='$attachment_hash'");

        }


}
?>