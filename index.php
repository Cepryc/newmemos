<?php
if ($_COOKIE['time'] <> "" AND $_COOKIE['rating'] <> "") {
    $folder = $_COOKIE['time'] . $_COOKIE['rating'];
} else {
    $folder = "24hm";
    $time_set= "за 24ч.";
    $rating_set="рейтинг";
}

$today = date('d.m.Y');
$yesterday = date('d.m.Y', strtotime('-1 day'));

if($_COOKIE['rating']=="l"){$rating_set= "лайки";}
if($_COOKIE['rating']=="r"){$rating_set= "репосты";}
if($_COOKIE['rating']=="m"){$rating_set= "рейтинг";}

if($_COOKIE['time']=="3h"){$time_set= "за 3ч.";}
if($_COOKIE['time']=="6h"){$time_set= "за 6ч.";}
if($_COOKIE['time']=="12h"){$time_set= "за 12ч.";}
if($_COOKIE['time']=="24h"){$time_set= "за 24ч.";}
if($_COOKIE['time']=="3d"){$time_set= "за 3д.";}
if($_COOKIE['time']=="7d"){$time_set= "за 7д.";}
if($_COOKIE['time']=="14d"){$time_set= "за 14д.";}
if($_COOKIE['time']=="30d"){$time_set= "за 30д.";}

/*setcookie('vizit','1',time() + 60 * 60 * 24 * 30 * 12);
echo $_COOKIE['vizit'];
*/

?>
<!DOCTYPE html>
<html>
<head>
    <title>Лучшее из соц. сетей</title>
    <meta charset="utf-8" name="viewport"
          content="initial-scale=0.5,maximum-scale=0.5, width=device-width,  user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="css/reset2.0.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/jquery.webui-popover.css"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Righteous" rel="stylesheet">
</head>

<body>


<div class="settings_mobile">
    <div style="display: inline-block;"><b>Критерий:</b> <?php echo $rating_set; ?></div>   |  
    <div style="display: inline-block;"><b>Период:</b> <?php echo $time_set; ?></div> 
    <br><br>
    <div class="white_but">ИЗМЕНИТЬ НАСТРОЙКИ</div>
</div>

<div class="settings_desctop">
    <h1>Настройки:</h1>

    <b>Критерий:</b> <?php echo $rating_set; ?>
    <br>
    <b>Период:</b> <?php echo $time_set; ?>
    <br><br>
    <div class="black_but">ИЗМЕНИТЬ</div>
</div>




<header class="main-header">
    <a href='/'>
        <div class="logo"><font color='#4a4a4a'><b>Memario</b></font></div>
    </a>
    <div class="menu"><span class='glyphicon glyphicon-menu-hamburger'></span></div>
    <div class="info"><span class='glyphicon glyphicon-info-sign'></span>&nbsp;&nbsp;</div>
</header>



<header class="main-header-mobile" >
    <div class="menu" style='float:left; display:inline-block;color:white;'><span class='glyphicon glyphicon-menu-hamburger'></span></div>

    <a href='/' >
        <div class="logo" style="float:none; display:inline-block;color:white;"><b>Memario</b></div>
    </a>
    
    <div class="info"  style='float:right; display:inline-block;color:white;'><span class='glyphicon glyphicon-info-sign'></span></div>
</header>



<div class="info_modal">
    <div class='close_menu_modal'>
        <span class='glyphicon glyphicon-remove menu_modal_close'></span>
    </div>

	<br>
    <div class='menu_modal_inner_info' style='text-align: justify;'>
    	

<b>Memario</b> - умная лента, в которую попадают самые популярные посты из социальной сети ВКонтакте
<br>
<br>
<b>Как это работает?</b>
<br>
Лента формируется из самых топовых сообществ ВК с тематикой: юмор, мемы, смешные картинки. Первые 30 постов из каждого сообщества попадают в нашу базу, затем проверяются на уникальность, после чего выводятся. Наша база обновляется автоматически, примерно 1 раз за каждый час, независимо от времени суток. Посты живут ровно 30 дней, затем удаляются. 
<br>
<br>
Ранжирование постов зависит от настроек пользователя, изменить которые можно перейдя по гамбургеру в верхнем правом углу.
<br>
<br>
<b>Чем оно лучше самого ВК?</b>
<br>
ВК не чистит свою ленту от дублей и рекламы, и не выводит посты в удобном для просмотра виде. Memario - позволяет просматривать сразу несколько записей на одной странице, что не только помогает быстрее найти интересный контент, но ещё и отследить основные тренды за определённый период времени. Memario выкачивает все картинки а свой сервер, и работает быстрее самого ВК.
<br>
<br>
<b>Для кого создавался Memario?</b>
<br>
Абсолютно для всех, но если вы SMM специалист, или у вас есть свой паблик в ВК, Memario может стать полезным инструментом для поиска свежих идей и наполнения вашего сообщества интересным контентом.   
<br>
<br>
<br>
<br>
    </div>
</div>



<div class="menu_modal">
    <div class='close_menu_modal'>
        <span class='glyphicon glyphicon-remove menu_modal_close'></span>
    </div>
    <div class='menu_modal_inner'>
        <?php include("settings.html"); ?>
    </div>
</div>





<div class='modal_header'>
    <div class='modal_close' id='modal_close'><span class='glyphicon glyphicon-chevron-left'></span><b>НАЗАД</b></div>

    <div class='modal_share'>
        <div class='item_share_modal' data-placement='auto-bottom' style="opacity: 1;"><span
                    class='glyphicon glyphicon-send'></span> ПОДЕЛИТЬСЯ
        </div>
    </div>
</div>

<div class='modal'>
<div id="modal_big_close" class="modal_big_close"></div>
    <div class="modal_content"></div>
    <div class="modal_text_outer">
        <div class="modal_text"></div>
    </div>


    <div class='modal_gids_body'>
        <div class='modal_gids'>
            <div class='modal_gids_avatar'></div>
            <div class='modal_gids_name'></div>
        </div>
    </div>


<?php
    if($_COOKIE["admin"]<>""){
        echo "<div class='del_but' id='del_but'>УДАЛИТЬ</div>";
    }
?>
</div>



<a href="#top"> <div class="go_top"><span class="glyphicon glyphicon-chevron-up"></span></div></a>

<div class='content'>
    <div id="center">
        <ul id="waterfall"></ul>
    </div>


<br>
<div class="end_of">
<p>К сожалению, по данному фильтру записей нет, попробуйте <b id="end_menu">изменить настройки</b> !</p>
</div>



</div>



<div style='position: absolute; left:99999999999999px;'>
    <div id="popover_content" style="display:none; text-align: center;">

        <p class='copy_rez'></p>

        <textarea id="share_text" style='border-radius: 3px; padding:5px;'></textarea>
        <div class="btn_copy" data-clipboard-action="copy" data-clipboard-target="#share_text" style="color:#23527C; text-align: center;">

        <span class="glyphicon glyphicon-floppy-saved"></span> копировать в буфер обмена
        </div>

        <br>   
        <div style='padding: 13px; border:1px dashed #dddddd; font-size: 12px; width: 300px; text-align: left;'>
        
       <span class='glyphicon glyphicon-alert' style='color:red;'></span> Скопируйте содержимое текстового поля, затем  вставьте в редактор соц. сети, месседжера, или блога!

         </div>
    </div>
</div>





<script>

    var foloder = "<?php echo $folder; ?>";
    var imgFolder = "<?php echo date("d.m.Y"); ?>";
    var today = "<?php echo $today; ?>";
    var yesterday = "<?php echo $yesterday; ?>";

</script>

<script src="js/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/jquery.color-animation/1/mainfile"></script>
<script type="text/javascript" src="js/newWaterfall.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script src="js/jquery.webui-popover.js"></script>
<script src="js/clipboard.min.js"></script>


<script type="text/javascript">

    new Clipboard('.btn_copy');

    $(".btn_copy").click(function () {
        $(".copy_rez").show();
        $(".copy_rez").html("<span class='glyphicon glyphicon-alert'></span> Контент добавлен в буфер обмена!<br>");
    }); 
    
</script>




<?php
    if($_COOKIE["admin"]<>""){
?>  

<script>
    $(".del_but" ).click(function() {  
        $.ajax({url: "delpost.php?del=ecibaldo&id=" + del_id, 
            success: function(result){
            alert("Пост под id " + del_id + " удалён!");
        }});
    });
</script>


<?php

    }
?>





<div style='display: none;'>
    <!--LiveInternet counter--><script type="text/javascript">
    document.write("<a href='//www.liveinternet.ru/click' "+
    "target=_blank><img src='//counter.yadro.ru/hit?t45.6;r"+
    escape(document.referrer)+((typeof(screen)=="undefined")?"":
    ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
    screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
    ";"+Math.random()+
    "' alt='' title='LiveInternet' "+
    "border='0' width='31px' height='31px'><\/a>")
    </script><!--/LiveInternet-->
</div>


</body>
</html>