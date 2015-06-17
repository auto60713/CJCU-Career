
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="img/ico.ico" rel="SHORTCUT ICON">
	<title>長大職涯網</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/area_div.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
	<script src="js/jquery-min.js"></script>
    <script src="js/jquery-migrate-min.js"></script>
	<script>
	$(function(){ 	

		$('#view-header').load('public_view/header.php');
		$("#menu").load('public_view/menu.html');
		$("#footer").load('public_view/footer.html');

        //如果瀏覽器不支援JSON則載入json2.js
		if (typeof (JSON) == 'undefined') $.getScript('js/json2.js');
		
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
	<a href="http://www.cjcu.edu.tw/cjcunews/news.php?mainunitid=7&newsunitid=140&subunitid=146"><p class="link"><i class="fa fa-play"></i> 新聞中心</p></a>
    
    <div class="news-area">
        <p><a href="http://www.cjcu.edu.tw/cjcunews/news-detail.php?id=8001">
	    	<span class="news-date">2015-03-10</span>2015年南區就業博覽會
	    </a></p>
	    <hr>
        <p><a href="http://www.cjcu.edu.tw/cjcunews/news-detail.php?id=7988">
	    	<span class="news-date">2015-03-06</span>【104年暑期實習】國立中正紀念堂管理處
	    </a></p>
	    <hr>
	    <p><a href="http://www.cjcu.edu.tw/cjcunews/news-detail.php?id=7982">
	    	<span class="news-date">2015-03-05</span>104年度「雙軌訓練旗艦計畫」暨「補助大專校院辦理就業學程計畫」 計畫推動說明會
	    </a></p>
	    <hr>
        <p><a href="http://www.cjcu.edu.tw/cjcunews/news-detail.php?id=7980">
	    	<span class="news-date">2015-03-05</span>104年度大專校院辦理 區域性校園徵才活動
	    </a></p>
	    <hr>
	    <p><a href="http://www.cjcu.edu.tw/cjcunews/news-detail.php?id=7977">
	    	<span class="news-date">2015-03-04</span>104年增能計畫 達人履歷競賽、面試諮詢活動
	    </a></p>
	    <hr>
	    <p><a href="http://www.cjcu.edu.tw/cjcunews/news-detail.php?id=7920">
	    	<span class="news-date">2015-02-24</span>文化部「展演設施產業職能基準」查詢平台
	    </a></p>
	    <hr>
	    <p><a href="http://www.cjcu.edu.tw/cjcunews/news-detail.php?id=7917">
	    	<span class="news-date">2015-02-24</span>臺灣港務股份有限公司職務甄選公告
	    </a></p>
	    <hr>
	    <p><a href="http://www.cjcu.edu.tw/cjcunews/news-detail.php?id=7908">
	    	<span class="news-date">2015-02-11</span>亞洲開發銀行-104年暑期實習機會 
	    </a></p>
	    <hr>

    </div>
</div>






<!-- 社會新鮮人專區 -->
<div id="area3_1" class="area_box"><h1 id="area_title">新聞專區</h1>
	<a class="more-link" href="news.php?type=1">更多..</a>

    <a class="area_box_link" href="">
	    <img class="area3-img a3-1" src="">
	    <p class="master-title"></p>
	    <p class="master-nevin"></p>
    </a>
</div>

<!-- 活動花絮 -->
<div id="area3_2" class="area_box"><h1 id="area_title">活動花絮</h1>
	<a class="more-link" href="http://sites.cjcu.edu.tw/career/AlbumList.html" target="_blank">更多..</a>

    <a href="http://sites.cjcu.edu.tw/career/Album_2417.html"><div class="img-boxx">
	<img class="a32-img1" src="http://sites.cjcu.edu.tw/wSiteFile/Album/B0406/141024142805img_1498.jpg">
	<p class="img-alt">市府103年度『協助青少年就業活動』_牟士登 劉惠瑜董事長分享</p>
	</div></a>
	
	<a href="http://sites.cjcu.edu.tw/career/Album_2602.html"><div class="img-boxx">
	<img class="a32-img2" src="http://sites.cjcu.edu.tw/wSiteFile/Album/B0406/141212165614img_1955.jpg">
	<p class="img-alt">第二場留遊學免費諮詢服務</p>
	</div></a>

	<a href="http://sites.cjcu.edu.tw/career/Album_2416.html"><div class="img-boxx">
	<img class="a32-img3" src="http://sites.cjcu.edu.tw/wSiteFile/Album/B0406/141024141256img_1561.jpg">
	<p class="img-alt">【教學增能計畫】公職證照考試專題講座</p>
	</div></a>
</div>

<!-- 好站連連看 -->
<div id="area3_3" class="area_box"><h1 id="area_title">好讚連連</h1>
	<a class="more-link" href="web_links.php">更多..</a>

	<img class="area3-img a3-3" src="img/links.jpg" style="opacity:0.7">
	<div class="workplace wp3-3">
		<!--a href="http://www.104.com.tw/"><i class="fa fa-play"></i>104人力銀行</a><br>
		<a href="http://www.yes123.com.tw/admin/index.asp"><i class="fa fa-play"></i>yes123求職網</a><br>
		<a href="http://rich.yda.gov.tw/richCandidate/index.jsp"><i class="fa fa-play"></i>RICH職場體驗網</a><br>
		<a href="http://www.taiwanjobs.gov.tw/Internet/index/index.aspx"><i class="fa fa-play"></i>台灣就業通</a><br-->
    </div>
</div>
<script type="text/javascript">
        $.ajax({
          type: 'POST',
          async: false,
          url: 'cjcu_career/cc/index.php/links',
          data:{},
          success: function (data) { 

              var links_json = JSON.parse(data);
              var i=0;

              for(key in links_json) {
              	if(i==4) break;
	              var link = $('<a>').attr({"href":links_json[key]['href'],"target":"_blank"}).text("► "+links_json[key]['name']),
                      adata = $('<p>').append(link);

                  $('.links-show').append(adata);
                i++;
              }
          }
        });
</script>


</div>


<!-- 頁尾訊息 -->
<div id="footer"></div>


</body>


<script>
    <?php include_once('js_work_list.php'); echo_work_list_array(3); ?>

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
			work_date = $('<p>').text('職缺更新日期' + work_list_array[i].up_data.split(" ")[0]).addClass('dateee'),
            work_propn = $('<p>').text(((work_list_array[i].isout=='0')?'校外 ':'校內 ') + work_list_array[i].propname),
			work_recr = $('<p>').addClass('num').text('需求 '+ work_list_array[i].rno +' 人');

			box2.append(work_name,work_date);
			box3.append(work_zone);
			box4.append(work_propn);

		//發布公司
        $.ajax({
          type: 'POST',
          async: false,
          url: 'ajax_echo_name.php',
          data:{mode:"cnd",work_pub:work_list_array[i].pub,comid:work_list_array[i].cid},
          success: function (data) { 
              work_com = $('<p>').addClass('com-name').text(data);
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
	
		$('.wp3-3 a,#area2_2 a,#area3_2 a').attr("target",'_blank');
</script>
</html>