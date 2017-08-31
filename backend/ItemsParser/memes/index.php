<?php
set_time_limit(10);

include_once('../../curl.php');
include_once('../../db.php');
$db = new Database();

$access_token="83650e4bf8158c0aacf430b5661c520ca74c41e625b04f8b766113c2fdfe2a3ca3e714dfc207d2191a651";
$db_table=trim($_GET['table']);

$cat="memes";
$type="photo";



for ($k = 0; $k < 300; $k++) {
	//СЧЕТЧИКИ
	$gid_members_count_file=json_decode(file_get_contents("GidCount.txt"),true);
	$gid_file = file("GidList.txt");
    $counter1 = (int)trim(file_get_contents("counter1.txt"));
    $counter2 = (int)trim(file_get_contents("counter2.txt"));
  
    $gid_file_count = count($gid_file)-1;
    $gid = trim($gid_file[$counter1]);
    $members_count=(int)(trim($gid_members_count_file[$gid]));
    


    if ($counter1 == "" OR $counter1 < $counter2) {
        $counter1 = $counter2;
    }

    if ($counter1 >= $gid_file_count) {
        $counter1 = 0;
        $counter2 = 0;
        file_put_contents("counter1.txt", $counter1);
        file_put_contents("counter2.txt", $counter2);
    }
	//---
	
	
	
	//Запрос к API
    $api_response = get_content("https://api.vk.com/method/wall.get?owner_id=-" . trim($gid) . "&count=30&access_token=".$access_token, 4);
    $items_array = json_decode($api_response);
	//---

	
    for ($j = 1; $j < 31; $j++) {

        if ($items_array->response[$j]->id <> "") {
            $is_pinned = $items_array->response[$j]->is_pinned;
            $marked_as_ads = $items_array->response[$j]->marked_as_ads;
            $wall_id = $items_array->response[$j]->to_id . "_" . $items_array->response[$j]->id;

         
			//Стоит ли ингнорировать данный пост?
            $ignore = 0;

			//Если прикреп, или явная - неявная реклама в посте
			if ($is_pinned == 1 OR $marked_as_ads == 1) {
				$ignore = 2;
			} 
			
			if (
				stristr($items_array->response[$j]->text, "club") OR
				stristr($items_array->response[$j]->text, "http") OR
				stristr($items_array->response[$j]->text, "[id")
				){
				$ignore = 2;		
			}
			//--
	
	
			//Если тип не фото
			for ($i = 0; $i < 10; $i++) {
				if (trim($items_array->response[$j]->attachments[0]->type <> "photo")) {
					$ignore = 1;			
				}
			}
			//--
			//-------------------------
			
			echo $ignore."<br>";

			
			
			
			
			
			
			
			
			
			
					//Добавить или обновить запись?
					$update_item = 0;
					if ($ignore == 0){
						if (strpos(file_get_contents("update.txt"), substr($wall_id, 1))) {
							$update_item = 1;
						} else {
							$update_item = 0;
						}
					}
					//--------
					
					
						
						//Есть ли в базе эта запись? Нужно после того, как временные файлы обнуляться
						if ($update_item == 0 AND $ignore == 0) {

							$wall_id_check = $db->db_select($db_table, "wall_id,ignore_post", "WHERE wall_id='$wall_id' LIMIT 1");
							
							if ($wall_id_check[0]['wall_id'] <> "") {
								$fp = fopen("update.txt", "a");
								$mytext = $wall_id . "\r\n";
								$test = fwrite($fp, $mytext);
								fclose($fp);
								
								$update_item = 1;
							}
												
						}
						//-------------------------------------
						
					
					
					
					
					
					
					
					
					
					
					
					

							//Добавить запись
							if ($update_item == 0 AND $ignore == 0) {
								$items_insert_array['gid'] = trim($gid);
								$items_insert_array['wall_id'] = $wall_id;
								$items_insert_array['text'] = $items_array->response[$j]->text;

						  
								$attachments_array = "";
								for ($i = 0; $i < 10; $i++) {

									if ($items_array->response[$j]->attachments[$i]->photo->src_big <> "") {
										$attachments_array[] = $items_array->response[$j]->attachments[$i]->photo->src_big;
									} else {
										break;
									}
								}

								$items_insert_array['attachments'] = json_encode($attachments_array);
								$items_insert_array['attachment'] = $items_array->response[$j]->attachments[0]->photo->src_big;

								if (trim($items_array->response[$j]->text) <> "") {
									$items_insert_array['text_hash'] = hash('md5', $items_array->response[$j]->text);
								} else {
									$items_insert_array['text_hash'] = "";
								}
								$items_insert_array['date'] = $items_array->response[$j]->date;
								$items_insert_array['likes'] = $items_array->response[$j]->likes->count;
								$items_insert_array['reposts'] = $items_array->response[$j]->reposts->count;
								if($members_count<>""){
									$items_insert_array['rating'] = ($items_array->response[$j]->likes->count + $items_array->response[$j]->reposts->count*10)/$members_count;
								}else{
									$items_insert_array['rating'] = 0;
								}

								if(($items_array->response[$j]->likes->count/100)>$items_array->response[$j]->reposts->count){
									$items_insert_array['ignore_post']=1;
								}else{     
									$items_insert_array['ignore_post']=0;
								}
								
								$items_insert_array['cat']=$cat;
								$items_insert_array['post_type']=$type;								
								
								
								$db->db_insert($db_table, $items_insert_array);

								if ($items_insert_array['attachment'] == "" AND $items_insert_array['text_hash'] <> "") {
									$item_hash = $items_insert_array['text_hash'];
									$db->db_update($db_table, "SET good_post=1,item_hash='$item_hash' WHERE wall_id='$wall_id'");

								}

								$fp = fopen("update.txt", "a");
								$mytext = $wall_id . "\r\n";
								$test = fwrite($fp, $mytext);
								fclose($fp);

								}
								//---------

							
					
					
					
					
					
					
					
					
					
									
									
									//Обновить запись
									if ($update_item == 1 AND $ignore <> 2) {

										$likes = $items_array->response[$j]->likes->count;
										$reposts = $items_array->response[$j]->reposts->count;
										
										if($members_count<>""){
											$rating = ($likes + $reposts*10)/$members_count;
										}else{
											$rating=0;
										}
										
										if(($likes/100)>$reposts){
											$item_ignore=1;
										}else{     
											$item_ignore=0;
										}
										
										$db->db_update($db_table,"SET likes='$likes',reposts='$reposts',rating='$rating',ignore_post='$item_ignore' WHERE wall_id='$wall_id'"); 
											
									}

					
			
			
			
			
        }

    }


	
	
	
	
	
	//Плюсуем в счёчик	
    $counter1++;
    file_put_contents("counter1.txt", $counter1);

    $counter2_rand = rand(0, 7);
    if ($counter2_rand == 3) {
        $counter2++;
        file_put_contents("counter2.txt", $counter2);
    }




}



?>