
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>長大職涯網</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <!-- <script type="text/javascript" src="js/full_height.js"></script> -->

    <!-- Insert to your webpage before the </head> -->
    <script src="slider/sliderengine/jquery.js"></script>
    <script src="slider/sliderengine/amazingslider.js"></script>
    <script src="slider/sliderengine/initslider-1.js"></script>
    <!-- End of head section HTML codes -->

	<script>
	$(function(){ 	

		$.ajax({
					url:  'public_view/header.php',
					type: 'POST',
					data: {},
					success: function(data) {
                        $('#view-header').html(data);
                    }
		});

		$("#menu").load('public_view/menu.html');


	})
	</script>
    
</head>
<body>


<!-- 版頭 -->
<div id="view-header" class=""></div>

<!-- 菜單 -->
<div id="menu"></div>


<!-- 主體 -->
<div id="main" class="div-align">
<!-- 任何區塊因為空間大小都要限制字數 -->

<!-- 焦點新聞 -->
<div id="area1_1" class="area_box"><h1 id="area_title">焦點新聞</h1>

	<!-- Insert to your webpage where you want to display the slider -->
    <div id="amazingslider-1" style="display:block;position:relative;margin:16px auto 32px;">
        <ul class="amazingslider-slides" style="display:none;">
            <li><img src="slider/images/chicago_illinois-wallpaper-1920x1080.jpg" alt="chicago_illinois-wallpaper-1920x1080" /></li>
            <li><img src="slider/images/city_buildings_at_night-wallpaper-1920x1080.jpg" alt="city_buildings_at_night-wallpaper-1920x1080" /></li>
            <li><a href="直接對應detail"><img src="slider/images/cold-evening1.jpg" alt="cold-evening1" /></a></li>
        </ul>
        <ul class="amazingslider-thumbnails" style="display:none;">
            <li><img src="slider/images/chicago_illinois-wallpaper-1920x1080-tn.jpg" /></li>
            <li><img src="slider/images/city_buildings_at_night-wallpaper-1920x1080-tn.jpg" /></li>
            <li><img src="slider/images/cold-evening1-tn.jpg" /></li>
        </ul>
        <div class="amazingslider-engine" style="display:none;"><a href="http://amazingslider.com">jQuery Image Slider</a></div>
    </div>
    <!-- End of body section HTML codes -->
</div>

<!-- FB -->
<div id="area1_2" class="area_box">
	<div class="fb-like"></div>
	<div class="fb-nevin"></div>
	<div class="fb-footer"><p>Facebook社群外掛元件</p></div>
</div>


<!-- 工作列表 -->
<div id="area2_1" class="area_box"><h1 id="area_title">工作列表</h1>

    <!-- 快速搜尋 -->
	<div class="rush-search">
		<a href="inner_3.php" class="<? if(count($_GET)==0) echo "rush-searching"; ?>">最新工作</a>
		<a href="inner_3.php?mode=search&io=1" class="<? if($_GET['io']=='1') echo "rush-searching"; ?>">校內工作</a>
		<a href="inner_3.php?mode=search&prop=2" class="<? if($_GET['prop']=='2') echo "rush-searching"; ?>">正職</a>
		<a href="inner_3.php?mode=search&prop=1" class="<? if($_GET['prop']=='1') echo "rush-searching"; ?>">工讀</a>	
		<a href="inner_3.php?mode=search&prop=3" class="<? if($_GET['prop']=='3') echo "rush-searching"; ?>">實習</a>		
	</div>

	<!-- 列表 -->
	<div id="home-work-list-box"></div>
	<a class="more-link" href="inner_3.php">更多..</a>
</div>


<!-- 校內新聞 -->
<div id="area2_2" class="area_box"><h1 id="area_title">校內新聞</h1>
	<p class="link">長榮電子報</p>
    
		<!-- 載入資料 4篇-->
</div>






<!-- 職場高手 -->
<div id="area3_1" class="area_box"><h1 id="area_title">職場高手</h1>
	<a class="more-link" href="inner_5.php">更多..</a>

    <a class="area_box_link" href="">
	    <img class="area3-img a3-1" src="">
	    <p class="master-title"></p>
	    <p class="master-nevin"></p>
    </a>
</div>

<!-- 職場動態 -->
<div id="area3_2" class="area_box"><h1 id="area_title">職場動態</h1>
	<a class="more-link" href="inner_6.php">更多..</a>

	<img class="area3-img a3-2" src="">
	<div class="workplace wp3-2">
	    <!-- 載入資料 3篇-->
	</div>
</div>

<!-- 職場萬花筒 -->
<div id="area3_3" class="area_box"><h1 id="area_title">職場萬花筒</h1>
	<a class="more-link" href="inner_7.php">更多..</a>

	<img class="area3-img a3-3" src="">
	<div class="workplace wp3-3">
		<!-- 載入資料 3篇-->
    </div>
</div>



</div>


<!-- 頁尾訊息 -->
<div id="footer">
	<div class="footer_text">
		© 2014 長大職涯網 Inc. 長榮大學 職涯發展組
	</div>
</div>


</body>


<script>
    <? 
    //後端傳來的工作資料
    include_once('js_work_list.php'); echo_work_list_array(3); 
    ?>

    //工作列表
	var box = $('#home-work-list-box');	    

	for(var i=0;i<work_list_array.length;i++){

		var box2 = $('<div>').addClass('work-box').addClass('box-detail'),
			box3 = $('<div>').addClass('work-box').addClass('box-loc'),
			box4 = $('<div>').addClass('work-box').addClass('box-pop'),

			img = $('<img>').addClass('box-img').attr('src', 'img_company/'+work_list_array[i].cid+'.jpg'),
			a_link = $('<a>').attr({href:'work-'+work_list_array[i].wid}),
			div_work = $('<div>').addClass('work'),

			work_name = $('<h1>').text(work_list_array[i].wname),
			work_zone = $('<p>').text(work_list_array[i].zname).prepend($('<i>').addClass('fa fa-map-marker')),
			work_propn = $('<p>').text(((work_list_array[i].isout=='0')?'校外 ':'校內 ') + work_list_array[i].propname),
			work_recr = $('<p>').addClass('num').text('需求 '+ work_list_array[i].rno +' 人'),
			work_date = $('<p>').addClass('date').text('開始招募'+work_list_array[i].date.split(' ')[0]);
			


			box2.append(work_name).append(work_recr).append(work_date);
			box3.append(work_zone);
			box4.append(work_propn);


			div_work.append(img).append(box2).append(box3).append(box4);
			a_link.append(div_work);
			box.append(a_link);

	}
	
	//搜尋結果的訊息 search_log_cont從php回傳
	if(typeof search_log_cont != "undefined") {

	var search_log = $('<a>').addClass('search-log').text(search_log_cont);
    box.prepend(search_log);
    }




        //校內新聞
        $.ajax({
		  type: 'POST',
		  url: 'cjcu_career/cc/index.php/news/lists/1',
		  data:{},
		  success: function (data) { 
            var article_array = JSON.parse(data);

            for (var i = 0; i < article_array.length; i++) { if (i==2) break;
          
            //<a href=""><div class="news"><img class="news-img" src=""><p class="news-time">2014-10-10</p><p class="news-nevin">架構</p></div>
            //<a class="more-link" href="inner_4.php">更多..</a>
                var nevin = $('<p>').addClass('news-nevin').html(article_array[i].content),
                    time  = $('<p>').addClass('news-time').text(article_array[i].created_date.split(" ")[0]),
                    img   = $('<img>').addClass('news-img').attr("src",article_array[i].pic),
                    link  = $('<a>').attr("href",'inner_4.php?article_id='+article_array[0].id).append(img,time,nevin),
                    news  = $('<div>').addClass('news').append(link);
                    
                $('#area2_2').append(news);
            }
            var more  = $('<a>').addClass('more-link').attr("href",'inner_4.php').text('更多..');  
            $('#area2_2').append(more);
		  }
		});
		//職場高手
        $.ajax({
		  type: 'POST',
		  url: 'cjcu_career/cc/index.php/news/lists/1',
		  data:{},
		  success: function (data) { 
            var article_array = JSON.parse(data);

            $('.a3-1').attr("src",article_array[0].pic);
		  	$('.master-title').text(article_array[0].title);  
		    $('.master-nevin').html(article_array[0].content);  
            $('.area_box_link').attr("href",'inner_5.php?article_id='+article_array[0].id);  
		  }
		});
		//職場動態
        $.ajax({
		  type: 'POST',
		  url: 'cjcu_career/cc/index.php/news/lists/1',
		  data:{},
		  success: function (data) { 
            var article_array = JSON.parse(data);

            $('.a3-2').attr("src",article_array[0].pic);

            for (var i = 0; i < article_array.length; i++) { if (i==3) break;
            
                //<a href=""><p class="workplace-title">架構</p></a>
                var work = $('<p>').addClass('workplace-title').text('》'+article_array[i].title),
                    work_link = $('<a>').attr("href",'inner_6.php?article_id='+article_array[i].id).append(work);  
                $('.wp3-2').append(work_link);
            }
		  }
		});
		//職場萬花筒
        $.ajax({
		  type: 'POST',
		  url: 'cjcu_career/cc/index.php/news/lists/1',
		  data:{},
		  success: function (data) { 
            var article_array = JSON.parse(data);

            $('.a3-3').attr("src",article_array[0].pic);

            for (var i = 0; i < article_array.length; i++) { if (i==3) break;
            
                //<a href=""><p class="workplace-title">架構</p></a>
                var work = $('<p>').addClass('workplace-title').text('》'+article_array[i].title),
                    work_link = $('<a>').attr("href",'inner_7.php?article_id='+article_array[i].id).append(work);  
                $('.wp3-3').append(work_link);
            }
		  }
		});
</script>
</html>