<?php
set_time_limit(58);

$server_name = $_SERVER['SERVER_NAME'];

include_once('../curl.php');
include_once('../db.php');
$db = new Database();


$items = $db->db_select('memes_items', "id, attachment, text_hash, bad_post", "WHERE attachment_hash='' AND item_hash='' AND good_post<>1 AND ignore_post='0' AND un='0' ORDER BY bad_post ASC, date desc, RAND() LIMIT 1000");

if ($items[0] <> "") {

    foreach ($items as $item) {

        $id = $item['id'];
        $bad_post=$item['bad_post'];
        $file_url = urlencode(trim($item['attachment']));
        $attachment_hash = get_content("http://" . $server_name . "/backend/HashParser/GetHash.php?file=" . $file_url, 6);

        if (!empty($attachment_hash) OR trim($attachment_hash) <> "") {
                $text_hash = $item['text_hash'];
                $item_hash = $text_hash . $attachment_hash;
                $db->db_update("memes_items", "SET attachment_hash='$attachment_hash', item_hash='$item_hash',bad_post='0',un='1' WHERE id='$id'");
				
            }else{
            
			$bad_post++;	
			if($bad_post>6){
				$db->db_update("memes_items", "SET ignore_post=3 WHERE id='$id'");
			}else{
				$db->db_update("memes_items", "SET bad_post='$bad_post' WHERE id='$id'");
			}

	   }



    }

}

if($items[0]==""){

    echo "die";
    exit();

}




?>