
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
		$("#footer").load('public_view/footer.html');

    })
	</script>

    <!-- 
    <script src="slider/sliderengine/initslider-1.js"></script>
    <script src="slider/sliderengine/amazingslider.js"></script>
    -->
    
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
    <div id="amazingslider-1" style="display:block;position:relative;margin:10px;">
        <ul class="amazingslider-slides" style="display:none;">
        </ul>
        <ul class="amazingslider-thumbnails" style="display:none;">
        </ul>
        <div class="amazingslider-engine" style="display:none;"><a href="http://amazingslider.com">jQuery Image Slider</a></div>
    </div>
    <!-- End of body section HTML codes -->
</div>

<!-- FB -->
<div id="area1_2" class="area_box"><h1 id="area_title">職涯發展組</h1>

	<div id="fb-root"></div>
    <div class="fb-like-box" data-href="https://www.facebook.com/pages/%E9%95%B7%E6%A6%AE%E5%A4%A7%E5%AD%B8-%E5%AD%B8%E7%94%9F%E8%81%B7%E6%B6%AF%E7%99%BC%E5%B1%95%E6%9A%A8%E6%A0%A1%E5%8F%8B%E6%9C%8D%E5%8B%99/220146198083687" data-width="355" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&appId=988385617844066&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
</div>


<!-- 工作列表 -->
<div id="area2_1" class="area_box"><h1 id="area_title">工作列表</h1>

    <!-- 快速搜尋 -->
	<div class="rush-search">
		<a href="inner_3.php" class="<?php if(count($_GET)==0) echo "rush-searching"; ?>">最新工作</a>
		<a href="inner_3.php?mode=search&io=1" class="<?php if(isset($_GET['io']))if($_GET['io']=='1') echo "rush-searching"; ?>">校內工作</a>
		<a href="inner_3.php?mode=search&prop=2" class="<?php if(isset($_GET['prop']))if($_GET['prop']=='2') echo "rush-searching"; ?>">正職</a>
		<a href="inner_3.php?mode=search&prop=1" class="<?php if(isset($_GET['prop']))if($_GET['prop']=='1') echo "rush-searching"; ?>">工讀</a>	
		<a href="inner_3.php?mode=search&prop=3" class="<?php if(isset($_GET['prop']))if($_GET['prop']=='3') echo "rush-searching"; ?>">實習</a>		
	</div>

	<!-- 列表 -->
	<div id="home-work-list-box"></div>
	<a class="more-link" href="inner_3.php">更多..</a>
</div>


<!-- 校內新聞 -->
<div id="area2_2" class="area_box"><h1 id="area_title">校內新聞</h1>
	<a href="http://www.pop.com.tw/prnc/epaper/main.php"><p class="link">長榮電子報</p></a>
    
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
<div id="footer"></div>


</body>


<script>
    <?php
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
			


			box2.append(work_name,work_recr,work_date);
			box3.append(work_zone);
			box4.append(work_propn);

            //div_work.append(img)
			div_work.append(img,box2,box3,box4);
			a_link.append(div_work);
			box.append(a_link);

	}
	
	//搜尋結果的訊息 search_log_cont從php回傳
	if(typeof search_log_cont != "undefined") {

	var search_log = $('<a>').addClass('search-log').text(search_log_cont);
    box.prepend(search_log);
    }



        /*
        //校內新聞
        $.ajax({
		  type: 'POST',
		  url: 'cjcu_career/cc/index.php/news/lists/1',
		  data:{},
		  success: function (data) { 
            var article_array = JSON.parse(data);

            for (var i = 0; i < article_array.length; i++) { if (i==3) break;
          
            //<a href=""><div class="news"><img class="news-img" src=""><p class="news-time">2014-10-10</p><p class="news-nevin">架構</p></div>
            //<a class="more-link" href="inner_4.php">更多..</a>
                var nevin = $('<p>').addClass('news-nevin').html(article_array[i].content),
                    time  = $('<p>').addClass('news-time').text(article_array[i].created_date.split(" ")[0]),
                    img   = $('<img>').addClass('news-img').attr("src","cjcu_career/cc/product_img/"+article_array[i].pic),
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
		  url: 'cjcu_career/cc/index.php/news/lists/2',
		  data:{},
		  success: function (data) { 
            var article_array = JSON.parse(data);

            $('.a3-1').attr("src","cjcu_career/cc/product_img/"+article_array[0].pic);
		  	$('.master-title').text(article_array[0].title);  
		    $('.master-nevin').html(article_array[0].content);  
            $('.area_box_link').attr("href",'inner_5.php?article_id='+article_array[0].id);  
		  }
		});
		//職場動態
        $.ajax({
		  type: 'POST',
		  url: 'cjcu_career/cc/index.php/news/lists/3',
		  data:{},
		  success: function (data) { 
            var article_array = JSON.parse(data);

            $('.a3-2').attr("src","cjcu_career/cc/product_img/"+article_array[0].pic);

            for (var i = 0; i < article_array.length; i++) { if (i==4) break;
            
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
		  url: 'cjcu_career/cc/index.php/news/lists/4',
		  data:{},
		  success: function (data) { 
            var article_array = JSON.parse(data);

            $('.a3-3').attr("src","cjcu_career/cc/product_img/"+article_array[0].pic);

            for (var i = 0; i < article_array.length; i++) { if (i==4) break;
            
                //<a href=""><p class="workplace-title">架構</p></a>
                var work = $('<p>').addClass('workplace-title').text('》'+article_array[i].title),
                    work_link = $('<a>').attr("href",'inner_7.php?article_id='+article_array[i].id).append(work);  
                $('.wp3-3').append(work_link);
            }
		  }
		});
        */
</script>
</html>