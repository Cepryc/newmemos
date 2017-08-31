<?php
include_once('../backend/db.php');

$id=$_GET['id'];
$url= "http://".$_SERVER['SERVER_NAME']."/";

$db = new Database();
$items = $db->db_select("memes_items", "gid, text, attachment_hash", "WHERE id='$id'");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Рейтинг постов всея ВКонтакта</title>
	<meta charset="utf-8" name="viewport"
          content="initial-scale=0.5,maximum-scale=0.5, width=device-width,  user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="/css/reset2.0.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/style_mobile.css">
    <link rel="stylesheet" href="/css/jquery.webui-popover.css"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Righteous" rel="stylesheet">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.webui-popover.js"></script>
	<script src="/js/clipboard.min.js"></script>
</head>


<body>
<style type="text/css">
	.ddd{
		position: fixed;
		width: 200px;
		height: 100%;
		color:black;
		border:1px solid black;
	}
</style>



<div class='modal_header'>
   <a href="/" style="color:#484848"><div class='modal_close' id='modal_close'><span class='glyphicon glyphicon-chevron-left'></span><b>НАЗАД</b></div></a>

    <div class='modal_share'>
        <div class='item_share_modal' data-placement='auto-bottom' style="opacity: 1;"><span
                    class='glyphicon glyphicon-send'></span> ПОДЕЛИТЬСЯ
        </div>
    </div>
</div>

<div class='modal'>
<a href="/"><div id="modal_big_close" class="modal_big_close"></div></a>
	    <div class="modal_content">
	    <?php

	    for($i=0;$i<10;$i++){
	    	
	    	if( file_exists("../images/2017/".$items[0]["attachment_hash"]."_".$i.".jpg") ){
	    		echo "<img class='item_img' src='../images/2017/".$items[0]["attachment_hash"]."_".$i.".jpg'></br>";
	    	}

	    }	    
		
	    
	    
	    	?>
	    </div>
	    <div class="modal_text_outer">
	        	<div class="modal_text"><?= $items[0]["text"] ?></div>     
	    </div>

	<div class='modal_gids_body'>
	<div class="modal_gids">
        <div class="modal_gids_avatar"><img src="/images/avatars/<?= $items[0]["gid"] ?>.jpg" width="30px"></div>
        <div class="modal_gids_name"> - <a href="https://vk.com/club<?= $items[0]["gid"] ?>" target="_blank"><?= file_get_contents($url."/images/avatars/".$items[0]["gid"].".txt") ?></a></div>
    </div>
	    </div>
	

</div>
</div>




<div id="popover_content" style="display:none; text-align: center;">
    <p class='copy_rez'></p>
    <textarea id="share_text" style='border-radius: 3px; padding:5px;'>
<?php
			echo $items[0]["text"];
			echo "
			";
	    	if( file_exists("/images/2017/".$items[0]["attachment_hash"]."_".$i.".jpg") ){
	    		echo $url."/images/2017/".$items[0]["attachment_hash"]."_".$i.".jpg'";
	    		echo "
			";
	    	}

?></textarea>
    <div class="btn_copy" data-clipboard-action="copy" data-clipboard-target="#share_text" style="color:#23527C; text-align: center;">
    <span class="glyphicon glyphicon-floppy-saved"></span> копировать в буфер обмена
    </div>
    <br>   
    <div style='padding: 13px; border:1px dashed #dddddd; font-size: 12px; width: 300px; text-align: left;'>
   <span class='glyphicon glyphicon-alert' style='color:red;'></span> Скопируйте содержимое текстового поля, затем  вставьте в редактор соц. сети, месседжера, или блога!
     </div>
</div>






<script type="text/javascript">
$( document ).ready(function() {

    new Clipboard('.btn_copy');
    $(".item_share_modal").webuiPopover({url: '#popover_content', trigger: 'click', backdrop:true, cache: false});

    $(".btn_copy").click(function () {
        $(".copy_rez").show();
        $(".copy_rez").html("<span class='glyphicon glyphicon-alert'></span> Контент добавлен в буфер обмена!<br>");
    }); 


    $(".modal").scrollTop(0);
    $(".modal_header").show();
    $(".modal").show();
    $(".modal_close").show();
    $(".modal_big_close").show();


});

</script>




</body>
</html>
