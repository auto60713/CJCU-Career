<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>長大職涯網</title>

	<!-- 校內新聞 -->

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



<!-- 左區塊 -->
<div id="inner4_area_1" class="area_box2">
	<p class="before_news">[上一則]</p><p class="next_news">[下一則]</p>
	<hr class="begin_hr">

	<h1 class="news_title"><a class="news_time"></a></h1> 
	<div class="news_cont">
   </div>

	<hr class="bottom_hr">
	<p class="before_news bottom_pointer">[上一則]</p><p class="next_news bottom_pointer">[下一則]</p>
</div>

<!-- 右區塊 -->
<div id="inner4_area_2" class="area_box2"><h1 id="area_title">職場萬花筒</h1>


    <div class="list_one"><p class="list_time">2014-9-10</p><p class="list_title">柯辦竊聽案 通聯簡訊曝光了</p>
        <div class="list_cont">
        柯文哲政策辦公室政策部幕僚彭盛韶今日下午在競選總部總幹事姚立明等人陪同下公布柯辦監聽疑雲簡訊內容。
        </div>
    </div>
     <div class="list_one"><p class="list_time">2014-9-10</p><p class="list_title">柯辦竊聽案 通聯簡訊曝光了</p>
        <div class="list_cont">
        柯文哲政策辦公室政策部幕僚彭盛韶今日下午在競選總部總幹事姚立明等人陪同下公布柯辦監聽疑雲簡訊內容。
        </div>
    </div>
    <div class="list_one"><p class="list_time">2014-9-10</p><p class="list_title">柯辦竊聽案 通聯簡訊曝光了</p>
        <div class="list_cont">
        柯文哲政策辦公室政策部幕僚彭盛韶今日下午在競選總部總幹事姚立明等人陪同下公布柯辦監聽疑雲簡訊內容。
        </div>
    </div>
    <div class="list_one"><p class="list_time">2014-9-10</p><p class="list_title">柯辦竊聽案 通聯簡訊曝光了</p>
        <div class="list_cont">
        柯文哲政策辦公室政策部幕僚彭盛韶今日下午在競選總部總幹事姚立明等人陪同下公布柯辦監聽疑雲簡訊內容。
        </div>
    </div>
    <div class="list_one"><p class="list_time">2014-9-10</p><p class="list_title">柯辦竊聽案 通聯簡訊曝光了</p>
        <div class="list_cont">
        柯文哲政策辦公室政策部幕僚彭盛韶今日下午在競選總部總幹事姚立明等人陪同下公布柯辦監聽疑雲簡訊內容。
        </div>
    </div>
<div class="page_ctrl">
<a class="this_page">[上一頁]</a><a class="this_page">1</a><a>2</a><a>3</a><a>4</a><a>5</a><a>...</a><a class="this_page">[下一頁]</a>
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
    <? echo 'var article_id = "'.$_GET["article_id"].'";'?>

        //文章資訊
        $.ajax({
          type: 'POST',
          url: 'cjcu_career/cc/index.php/news/detail/'+article_id,
          data:{},
          success: function (data) { 
            if(data=='false') $('.news_title').text('查無此文章');  
            else{

            var article_array = JSON.parse(data);
            $('.news_title').prepend(article_array.title);  
            $('.news_time').html(article_array.created_date.split(" ")[0]);  
            $('.news_cont').html(article_array.content);  
            }
          }
        });
    
</script>
</html>