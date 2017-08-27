var loading = false;
var dist = 1000;
var page = 0;
var scroll_position;
var last_scroll_position;
var temp_id = "";

var obj_post_id = {};
var obj_images = {};
var obj_texts = {};
var obj_share = {};
var obj_gid_name = {};
var obj_gid_avatar = {};
var shar_content;
var check_arr= [];

  if (screen.width <= 800) {
    var text_short=140;
  }else{
    var text_short=400;
  }





var del_id;
var getUrlParameter = function getUrlParameter(sParam) {
var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};








$(window).scroll(function () {
    scroll_position = $(window).scrollTop();
    //console.log(scroll_position);
});


setInterval(function () {
    if ($(window).scrollTop() >= $(document).height() - $(window).height() - dist && !loading) {


        var msg = $.ajax({
            type: "GET",
            url: "date/" + foloder + "/" + page + ".json",
            async: false
        }).responseText;
        var date = JSON.parse(msg);

        loading = true;

        var str = "";
        var item = "";
        for (var i = 1; i < 11; i++) {
            var it_id = "it" + page + i;


            item = "<li>{{share}}<div class='item' id='" + it_id + "'><div class='images_area' {{img_aria_hieght}}>{{src}}</div>{{show_more}}{{text}} <div class='rating_aria'>{{time}}<div style='float:right;'> <span class='glyphicon glyphicon-heart'></span>&nbsp; {{likes}} &nbsp;&nbsp;  <span class='glyphicon glyphicon-bullhorn span1'></span>&nbsp; {{reposts}} &nbsp; Рейтинг: {{rating}}</div></div></li>";

            //дата
            var time = date[i].date;
            if (time === today) {
                time = 'Сегодня';
            }
            if (time === yesterday) {
                time = 'Вчера';
            }


            //сокращаеи текст
            var full_text_count = 0;
            if (date[i].hash != "") {
                full_text_count = text_short;
            } else {
                full_text_count = text_short;
            }
            var text_temp = date[i].text.slice(0, full_text_count);
            if (text_temp.length < date[i].text.length) {
                text_temp += '...<a href="#"><b>читать далее</b></a>';
            }


            //Управление картинками
            if (date[i].counters != 0 && date[i].counters != '' && date[i].counters != null) {
                var images = "";
                var images_share = "";

                for (var j = 0; j < date[i].counters; j++) {
                    if (date[i].hash != "") {
                        images += "<img class='item_img' src='images/" + date[i].pdate + "/" + date[i].hash + "_" + j + ".jpg'>"
                    } else {
                        var images = "";
                    }
                    
                    if(date[i].hash!=""){    
                        images_share += "http://memario.ru/images/" + date[i].pdate + "/" + date[i].hash + "_" + j + ".jpg\n";
                    }    

                }
            }


            if (date[i].text != "") {
                var text = "<div class='text_aria'>" + text_temp + "</div>"
            } else {
                var text = "";
            }

            if (j > 1) {
                var show_more = "<div class='images_show_more'>Развернуть <span class='glyphicon glyphicon-triangle-bottom'></span></div>";
                var img_aria_hieght="style='max-height:450px;'";
            } else {
                var show_more = "";        
                var img_aria_hieght="style='max-height:2000px;'";
            }

            if (date[i].likes != "") {
                var likes = date[i].likes
            } else {
                var likes = "";
            }
            if (date[i].reposts != "") {
                var reposts = date[i].reposts
            } else {
                var reposts = "";
            }
			if (date[i].rating != "") {
                var rating = Math.ceil(date[i].rating*100000);
            } else {
                var rating = "";
            }
			
		

            share = "<div class='item_share' id='" + it_id + "' data-placement='auto-bottom'><span class='glyphicon glyphicon-send' style='display:inline-block;'></span> <div style='display:inline-block;'>ПОДЕЛИТЬСЯ</div></div>";

            if($.inArray(date[i].hash, check_arr)!=0){
                str += item
                    .replace("{{src}}", images)
                    .replace("{{show_more}}", show_more)
                    .replace("{{text}}", text)
                    .replace("{{likes}}", likes)
                    .replace("{{reposts}}", reposts)
					.replace("{{rating}}", rating)
                    .replace("{{share}}", share)
                    .replace("{{img_aria_hieght}}", img_aria_hieght)
                    .replace("{{time}}", time);

                obj_post_id[it_id] = date[i].id;
                obj_images[it_id] = images;
                obj_share[it_id] = images_share;
                obj_texts[it_id] = date[i].text;
                obj_gid_name[it_id] = " - " + "<a href='https://vk.com/club" + date[i].gid + "' target='_blank'>" + date[i].name + "</a>";
                obj_gid_avatar[it_id] ="<img src='/images/avatars/" + date[i].gid + ".jpg' width=30px>";
            
                check_arr.push(date[i].hash);
                console.log(check_arr);
              }  


        }


        loading = false; 
        $("#waterfall").append(str);         
        page++;


        $(".item").click(function () {           
            
			$(".item").scrollTop(0);

            last_scroll_position = scroll_position;
            var modal = document.getElementsByClassName("modal");

            $(".modal").scrollTop(0);
            $(".modal_header").show();
            $(".modal").show();
            $(".modal_close").show();
            $(".modal_big_close").show();
            $("body").addClass("fixed");


            var id = this.getAttribute("id");
            var post_id  = obj_post_id[id];
            var images = obj_images[id];
            var text = obj_texts[id];
            var share = obj_share[id];
            var gid_name= obj_gid_name[id];
            var gid_image= obj_gid_avatar[id];


            if (text === "") {
                var br = ""
            } else {
                var br = "\n"
            }

            shar_content = text + br + share;

            if (text === "") {
                $(".modal_text_outer").hide();
            } else {
                $(".modal_text_outer").show();
            }

            $(".modal_content").html(images);
            $(".modal_text").html(text);
            $(".modal_gids_avatar").html(gid_image);
            $(".modal_gids_name").html(gid_name);

             window.history.pushState('forward', null, '/');
             window.history.replaceState("","","post.php?id=" + post_id);
             del_id= getUrlParameter('id');
             
        });


        $("#modal_close").click(function () {
            $(".modal").hide();
            $(".modal_header").hide();
            $(".modal_close").hide();
            $(".modal_big_close").hide();
            $("body").removeClass("fixed");
            $(window).scrollTop(last_scroll_position);
            window.history.replaceState("","","/");

        });

        $("#modal_big_close").click(function () {
            $(".modal").hide();
            $(".modal_header").hide();
            $(".modal_close").hide();
            $(".modal_big_close").hide();
            $("body").removeClass("fixed");
            $(window).scrollTop(last_scroll_position);
            window.history.replaceState("","","/");
        });


        $(".item_share").click(function () {
            $(".copy_rez").hide();
            $(".copy_rez").text("");
            temp_id = this.getAttribute("id");
            var images = obj_share[temp_id];
            var text = obj_texts[temp_id];

            if (text === "") {
                var br = ""
            } else {
                var br = "\n"
            }


            shar_content = text + br + images;
            $("#share_text").val(shar_content);
            $("#" + temp_id).css("opacity", "1");
            $("#" + temp_id).css("background-image", "none");
            $("#" + temp_id).css("background-color", "grey");

        });

        $(".item_share_modal").click(function () {
            $(".copy_rez").text("");
            $("#share_text").val(shar_content);

        });


        $(".item_share").webuiPopover({url: '#popover_content', trigger: 'click', backdrop:true, cache: false});
        $(".item_share_modal").webuiPopover({url: '#popover_content', trigger: 'click', backdrop:true, cache: false});

    }
}, 0);


$(document).ready(function () {  
    $('#waterfall').NewWaterfall();

    $(".menu").click(function () {
        last_scroll_position = scroll_position;
        $(".menu_modal").show();
        $("body").addClass("fixed");

    });



    $("#end_menu").click(function () {
        last_scroll_position = scroll_position;
        $(".menu_modal").show();
        $("body").addClass("fixed");

    });



   $(".black_but").click(function () {
        last_scroll_position = scroll_position;
        $(".menu_modal").show();
        $("body").addClass("fixed");
    });

   $(".white_but").click(function () {
        last_scroll_position = scroll_position;
        $(".menu_modal").show();
        $("body").addClass("fixed");
    });
    


    $(".info").click(function () {
        last_scroll_position = scroll_position;
        $(".info_modal").show();
        $("body").addClass("fixed");

    });


    $(".close_menu_modal").click(function () {
        $(".modal").hide();
        $(".modal_close").hide();
        $(".modal_big_close").hide();
        $(".menu_modal").hide();
        $(".modal_header").hide();
        $(".info_modal").hide();
        $("body").removeClass("fixed");
        $(window).scrollTop(last_scroll_position);
        window.history.replaceState("","","/");

    });


    $('html').keydown(function (eventObject) {
        if (event.keyCode == 27) {
            $(".modal").hide();
            $(".modal_close").hide();
            $(".modal_big_close").hide();
            $(".menu_modal").hide();
            $(".modal_header").hide();
            $(".info_modal").hide();
            $("body").removeClass("fixed");
            $(window).scrollTop(last_scroll_position);
            window.history.replaceState("","","/");

        }
    });


    if (window.history && window.history.pushState) {
    $(window).on('popstate', function() {
      var hashLocation = location.hash;
      var hashSplit = hashLocation.split("#!/");
      var hashName = hashSplit[1];

      if (hashName !== '') {
        var hash = window.location.hash;
        if (hash === '') {        
            $(".modal").hide();
            $(".modal_close").hide();
            $(".modal_big_close").hide();
            $(".menu_modal").hide();
            $(".modal_header").hide();
            $(".info_modal").hide();
            $("body").removeClass("fixed");
            $(window).scrollTop(last_scroll_position);
            window.history.replaceState("","","/");
        }
      }
    });
    }


});



