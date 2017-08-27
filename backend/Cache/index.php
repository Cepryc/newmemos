<?php
set_time_limit(58);
include_once('../db.php');
$db = new Database();


for($k=0;$k<27;$k++){

$counter = file_get_contents('counter.txt');

$sort_file = file("sort_temp.txt");
$sort_param = $sort_file[$counter];
$sort_param_count=count($sort_file)-1;

if ($counter == "" or $counter>=$sort_param_count) {
    $counter = 0;
}



//Лайки или репосты
if (stristr($sort_param, 'l')) {
    $rating = "likes";
} else {
    $rating = "reposts";
}
//или рейтинг
if (stristr($sort_param, 'm')) {
    $rating = "rating";
}



//Время от и до
if (substr($sort_param, 0, 2) == "1h") {
    $time = mktime(date("H") - 1, date("i"), 0, date("m"), date("d"), date("Y"));
}
if (substr($sort_param, 0, 2) == "3h") {
    $time = mktime(date("H") - 3, date("i"), 0, date("m"), date("d"), date("Y"));
}
if (substr($sort_param, 0, 2) == "6h") {
    $time = mktime(date("H") - 6, date("i"), 0, date("m"), date("d"), date("Y"));
}
if (substr($sort_param, 0, 3) == "12h") {
    $time = mktime(date("H") - 12, date("i"), 0, date("m"), date("d"), date("Y"));
}
if (substr($sort_param, 0, 3) == "24h") {
    $time = mktime(date("H") - 24, date("i"), 0, date("m"), date("d"), date("Y"));
}
if (substr($sort_param, 0, 2) == "3d") {
    $time = mktime(date("H") - 24 * 3, date("i"), 0, date("m"), date("d"), date("Y"));
}
if (substr($sort_param, 0, 2) == "7d") {
    $time = mktime(date("H") - 24 * 7, date("i"), 0, date("m"), date("d"), date("Y"));
}
if (substr($sort_param, 0, 3) == "14d") {
    $time = mktime(date("H") - 24 * 14, date("i"), 0, date("m"), date("d"), date("Y"));
}
if (substr($sort_param, 0, 3) == "30d") {
    $time = mktime(date("H") - 24 * 30, date("i"), 0, date("m"), date("d"), date("Y"));
}


$items = $db->db_select("items", "id,wall_id,gid,date,pdate,attachments,attachment_hash,item_hash,text, text_hash,likes,reposts, rating", "WHERE good_post=1 AND date>'$time' AND ignore_post=0 AND attachment_hash<>'' AND pdate<>'' AND un=1 GROUP BY attachment_hash ORDER BY $rating DESC LIMIT 5000");


$p=0;
$i=0;
$j=0;
$cache="";


if (is_array($items) || is_object($items)){

//кэш базы на проверку
foreach ($items as $item) {
    
    $save_arr[$p]['id']=$item['id'];
    $save_arr[$p]['hash']=$item['attachment_hash'];
    $p++;
}

file_put_contents("../HashCleaner/hash_temp/".trim($sort_param).".json", json_encode($save_arr));



    foreach ($items AS $item){

        $i++;
        $cache[$i]['id']=$item['id'];
        $cache[$i]['gid']=$item['gid'];
        $cache[$i]['name']=file_get_contents("../../images/avatars/".$item['gid'].".txt");
        $cache[$i]['date']=date("d.m.Y",$item['date']);
        $cache[$i]['pdate']=$item['pdate'];
        $cache[$i]['text']=$item['text'];
        $cache[$i]['likes']=$item['likes'];
        $cache[$i]['reposts']=$item['reposts'];
		$cache[$i]['rating']=$item['rating'];
		
        $attachments_count=count(json_decode($item['attachments']));
        $cache[$i]['counters']=$attachments_count;
        $cache[$i]['hash']=$item['attachment_hash'];
        $cache[$i]['hash_text']=$item['text_hash'];

        if($i==10){
            file_put_contents("../../date/".trim($sort_param)."/".$j.".json",json_encode($cache));
            unset($cache);
            $i=0;
            $j++;
            }
        }

}



//удаляем лишнее, если есть
for($d=$j; $d<501; $d++){
    $del_file="../../date/".trim($sort_param)."/".$d.".json";
    if(file_exists($del_file)){
        unlink("../../date/".trim($sort_param)."/".$d.".json");
    }else{
        break;
    }
}


$counter++;
file_put_contents("counter.txt", $counter);



}

?>