
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>長大職涯網</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
	<script src="js/jquery-min.js"></script>
    <script src="js/jquery-migrate-min.js"></script>
	<script>
	$(function(){ 	

		$('#view-header').load('public_view/header.php');
		$("#menu").load('public_view/menu.html');
		$("#footer").load('public_view/footer.html');

    })
	</script>


    <script src="slider/sliderengine/initslider-1.js"></script>
    <script src="slider/sliderengine/amazingslider.js"></script>

    
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
<div id="area1_2" class="area_box"><h1 id="area_title">粉絲FB專區</h1>

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
		<a href="work_page.php" class="<?php if(count($_GET)==0) echo "rush-searching"; ?>">最新工作</a>
		<a href="work_page.php?mode=search&io=1" class="<?php if(isset($_GET['io']))if($_GET['io']=='1') echo "rush-searching"; ?>">校內工作</a>
		<a href="work_page.php?mode=search&prop=2" class="<?php if(isset($_GET['prop']))if($_GET['prop']=='2') echo "rush-searching"; ?>">正職</a>
		<a href="work_page.php?mode=search&prop=1" class="<?php if(isset($_GET['prop']))if($_GET['prop']=='1') echo "rush-searching"; ?>">工讀</a>	
		<a href="work_page.php?mode=search&prop=3" class="<?php if(isset($_GET['prop']))if($_GET['prop']=='3') echo "rush-searching"; ?>">實習</a>		
	</div>

	<!-- 列表 -->
	<div id="home-work-list-box"></div>
	<a class="more-link" href="work_page.php">更多..</a>
</div>


<!-- 學生職涯發展最新消息 -->
<div id="area2_2" class="area_box"><h1 id="area_title">學生職涯發展最新消息</h1>
	<a href="http://www.pop.com.tw/prnc/epaper/main.php"><p class="link">長榮電子報</p></a>
    
		<!-- 載入資料 4篇-->
</div>






<!-- 社會新鮮人專區 -->
<div id="area3_1" class="area_box"><h1 id="area_title">社會新鮮人專區</h1>
	<a class="more-link" href="news.php?type=1">更多..</a>

    <a class="area_box_link" href="">
	    <img class="area3-img a3-1" src="">
	    <p class="master-title"></p>
	    <p class="master-nevin"></p>
    </a>
</div>

<!-- 活動花絮 -->
<div id="area3_2" class="area_box"><h1 id="area_title">活動花絮</h1>
	<a class="more-link" href="http://sites.cjcu.edu.tw/career/AlbumList.html">更多..</a>

	<img class="area3-img a3-2" src="">
	<div class="workplace wp3-2">
	    <!-- 載入資料 3篇-->
	</div>
</div>

<!-- 好站連連看 -->
<div id="area3_3" class="area_box"><h1 id="area_title">好站連連看</h1>
	<a class="more-link" href="http://sites.cjcu.edu.tw/career/">更多..</a>

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

			a_link = $('<a>').attr({href:'work-'+work_list_array[i].wid}),
			div_work = $('<div>').addClass('work'),

			work_name = $('<h1>').text(work_list_array[i].wname),
			work_zone = $('<p>').text(work_list_array[i].zname).prepend($('<i>').addClass('fa fa-map-marker')),
			work_propn = $('<p>').text(((work_list_array[i].isout=='0')?'校外 ':'校內 ') + work_list_array[i].propname),
			work_recr = $('<p>').addClass('num').text('需求 '+ work_list_array[i].rno +' 人');

			box2.append(work_name,work_recr);
			box3.append(work_zone);
			box4.append(work_propn);

		//發布公司
        $.ajax({
          type: 'POST',
          async: false,
          url: 'ajax_echo_name.php',
          data:{mode:"cnd",work_pub:work_list_array[i].pub,comid:work_list_array[i].cid},
          success: function (data) { 
              work_com = $('<p>').addClass('date').text(data);
              box2.append(work_com);
          }
        });

        //公司頭像
        $.ajax({
          type: 'POST',
          async: false,
          url: 'ajax_echo_name.php',
          data:{mode:"img",pub:work_list_array[i].pub,id:work_list_array[i].cid},
          success: function (data) { 
              img = $('<img>').addClass('box-img').attr('src', data);
              div_work.append(img);
          }
        });

			div_work.append(box2,box3,box4);
			a_link.append(div_work);
			box.append(a_link);

	}
	
	//搜尋結果的訊息 search_log_cont從php回傳
	if(typeof search_log_cont != "undefined") {

	var search_log = $('<a>').addClass('search-log').text(search_log_cont);
    box.prepend(search_log);
    }



        
        //學生職涯發展最新消息
        $.ajax({
		  type: 'POST',
		  url: 'cjcu_career/cc/index.php/news/lists/1',
		  data:{},
		  success: function (data) { 
            if(data!=null||data!="false") var article_array = JSON.parse(data);
            else var article_array = 0;

            for (var i = 0; i < article_array.length; i++) { if (i==3) break;
          
            //<a href=""><div class="news"><img class="news-img" src=""><p class="news-time">2014-10-10</p><p class="news-nevin">架構</p></div>
            //<a class="more-link" href="news.php">更多..</a>
                var nevin = $('<p>').addClass('news-nevin').html(article_array[i].content),
                    time  = $('<p>').addClass('news-time').text(article_array[i].created_date.split(" ")[0]),
                    img   = $('<img>').addClass('news-img').attr("src","cjcu_career/cc/product_img/"+article_array[i].pic),
                    link  = $('<a>').attr("href",'news.php?type=1&article_id='+article_array[0].id).append(img,time,nevin),
                    news  = $('<div>').addClass('news').append(link);
                    
                $('#area2_2').append(news);
            }
            var more  = $('<a>').addClass('more-link').attr("href",'http://www.cjcu.edu.tw/cjcunews/news.php?mainunitid=7&newsunitid=140&subunitid=146').text('更多..');  
            $('#area2_2').append(more);
		  }
		});
		//社會新鮮人專區
        $.ajax({
		  type: 'POST',
		  url: 'cjcu_career/cc/index.php/news/lists/2',
		  data:{},
		  success: function (data) { 
            if(data!=null||data!="false") var article_array = JSON.parse(data);
            else var article_array = 0;

            $('.a3-1').attr("src","cjcu_career/cc/product_img/"+article_array[0].pic);
		  	$('.master-title').text(article_array[0].title);  
		    $('.master-nevin').html(article_array[0].content);  
            $('.area_box_link').attr("href",'news.php?type=2&article_id='+article_array[i].id);  
		  }
		});
		//活動花絮
        $.ajax({
		  type: 'POST',
		  url: 'cjcu_career/cc/index.php/news/lists/3',
		  data:{},
		  success: function (data) { 
            if(data!=null||data!="false") var article_array = JSON.parse(data);
            else var article_array = 0;

            $('.a3-2').attr("src","cjcu_career/cc/product_img/"+article_array[0].pic);

            for (var i = 0; i < article_array.length; i++) { if (i==4) break;
            
                //<a href=""><p class="workplace-title">架構</p></a>
                var work = $('<p>').addClass('workplace-title').text('》'+article_array[i].title),
                    work_link = $('<a>').attr("href",'news.php?type=3&article_id='+article_array[i].id).append(work);  
                $('.wp3-2').append(work_link);
            }
		  }
		});
		//好站連連看
        $.ajax({
		  type: 'POST',
		  url: 'cjcu_career/cc/index.php/news/lists/4',
		  data:{},
		  success: function (data) { 
            if(data!=null||data!="false") var article_array = JSON.parse(data);
            else var article_array = 0;

            $('.a3-3').attr("src","cjcu_career/cc/product_img/"+article_array[0].pic);

            for (var i = 0; i < article_array.length; i++) { if (i==4) break;
            
                //<a href=""><p class="workplace-title">架構</p></a>
                var work = $('<p>').addClass('workplace-title').text('》'+article_array[i].title),
                    work_link = $('<a>').attr("href",'news.php?type=4&article_id='+article_array[i].id).append(work);  
                $('.wp3-3').append(work_link);
            }
		  }
		});
        
</script>
</html>