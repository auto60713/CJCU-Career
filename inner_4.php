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

	<h1 class="news_title">鞏俐轟金馬不專業 拒絕再度參加<a class="news_time">2014年11月25日</a></h1> 
	<div class="news_cont">
    知名藝人鞏俐22號才剛參加完金馬獎，卻抱憾而歸，原本鞏俐在離台前都向媒體表示，此次來台灣非常開心，希望未來還有機會來台，
    但今天(25號)鞏俐的經紀人曾敬超替她發表聲明指出，感謝金馬獎給鞏俐機會，讓她了解一個不專業的電影節是怎麼樣的，而且一個不公正的電影節，
    會讓所有藝術人員瞧不起他們。
    鞏俐甚至表示，這是她第一次來金馬獎，也是最後一次，因為參加這個業餘的電影節，一點意義都沒有，但鞏俐強調，她喜歡台灣，也會再度來台。
	</div>

	<hr class="bottom_hr">
	<p class="before_news bottom_pointer">[上一則]</p><p class="next_news bottom_pointer">[下一則]</p>
</div>

<!-- 右區塊 -->
<div id="inner4_area_2" class="area_box2"><h1 id="area_title">校內新聞</h1>


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
   
</script>
</html>