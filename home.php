
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

		//進階搜尋
		$('#high_search_btn').on('click', function(event) {
		
		});

	})
	</script>
    
</head>
<body>


<!-- 版頭 -->
<div id="view-header" class=""></div>

<!-- 菜單 -->
<div id="menu">
    <ul class="div-align">
        <li><a href="#">首頁</a></li>
        <li><a href="#">焦點新聞</a></li>
        <li><a href="#">工作列表</a></li>
        <li><a href="#">校內新聞</a></li>
        <li><a href="#">職場高手</a></li>
        <li><a href="#">職場動態</a></li>
        <li><a href="#">職場萬花筒</a></li>
    </ul>

</div>


<!-- 主體 -->
<div id="main" class="div-align">
<!-- 任何區塊因為空間大小都要限制字數 -->

<!-- 焦點新聞 -->
<div id="area1_1" class="area_box"><h1 id="area_title">焦點新聞</h1>
</div>

<!-- FB -->
<div id="area1_2" class="area_box">
	<div class="fb-like"></div>
	<div class="fb-nevin"></div>
	<div class="fb-footer"><p>Facebook社群外掛元件</p></div>
</div>


<!-- 工作列表 -->
<div id="area2_1" class="area_box"><h1 id="area_title">工作列表</h1>

	<!-- 搜尋
	<div class="search-bar">
			<input type="text" id="normal-search">
			<input type="button" id="search" value="搜尋">
			<a href="#" id="high_search_btn"><i class="fa fa-cog"></i>進階搜尋</a>
	</div>
    -->
    <!-- 進階搜尋 -->
	<div class="high_search-bar">
	
	<!-- 條件1 -->
	<div class="search-detail-sub">
		 <input type="checkbox" id="search_prop" value="prop">
	     <label for="search_prop">工作性質 : </label><select name="work_prop" id="work_prop"></select>
	</div>
	
    <!-- 條件2 -->
	<div class="search-detail-sub">
	    <input type="checkbox" id="search_io" value="io">
	     <label for="search_io">校內外工作：</label>
	     <select name="work_io" id="work_io" class="search-detail-input">
	          <option value="0">校內</option>
	          <option value="1">校外</option>
	     </select> 
	</div>

    <!-- 條件3 -->
	<div class="search-detail-sub">
	    <input type="checkbox" id="search_zone" value="zone" >
	    <label for="search_zone">工作地點 : </label>
	    <select name="zone" id="zone" class="search-detail-input"></select> 
		<select name="zone_name" id="zone_name" class="search-detail-input"></select>
	</div>

    </div>



    <!-- 快速搜尋 -->
	<div class="rush-search">
		<a href="home.php" class="<? if(count($_GET)==0) echo "rush-searching"; ?>">最新工作</a>
		<a href="home.php?mode=search&io=1" class="<? if($_GET['io']=='1') echo "rush-searching"; ?>">校內工作</a>
		<a href="home.php?mode=search&prop=2" class="<? if($_GET['prop']=='2') echo "rush-searching"; ?>">正職</a>
		<a href="home.php?mode=search&prop=1" class="<? if($_GET['prop']=='1') echo "rush-searching"; ?>">工讀</a>	
		<a href="home.php?mode=search&prop=3" class="<? if($_GET['prop']=='3') echo "rush-searching"; ?>">實習</a>		
	</div>

	<!-- 列表 -->
	<div id="home-work-list-box"></div>
	<a class="more-link" href="">更多..</a>
</div>



<!-- 校內新聞 -->
<div id="area2_2" class="area_box"><h1 id="area_title">校內新聞</h1>
	<p class="link">長榮電子報</p>

	<div class="news">
        <img class="news-img" src="">
        <p class="news-time">2014-10-10</p>
	    <p class="news-nevin">厚外套出動，鋒面今晚過境，東北季風隨之增強...</p>
	</div>
	<div class="news">
        <img class="news-img" src="">
        <p class="news-time">2014-10-11</p>
	    <p class="news-nevin">氣象局表示，北部、東部天氣都將受到東北季風影響...</p>
	</div>
	<div class="news">
        <img class="news-img" src="">
        <p class="news-time">2014-10-12</p>
	    <p class="news-nevin">氣象局同時發布大雨特報，台北地區有大雨發生...</p>
	</div>
	<a class="more-link" href="">更多..</a>
</div>


<!-- 職場高手 -->
<div id="area3_1" class="area_box"><h1 id="area_title">職場高手</h1>
	<a class="more-link" href="">更多..</a>

	<img class="area3-img" src="">
	<p class="master-title">享受奔馳 日試駛磁浮列車</p>
	<p class="master-nevin">JR東海的磁浮列車先前已在笛吹市之間試駛，這次是首度允許民眾試乘。</p>
</div>


<!-- 職場動態 -->
<div id="area3_2" class="area_box"><h1 id="area_title">職場動態</h1>
	<a class="more-link" href="">更多..</a>

	<img class="area3-img" src="">
	<div class="workplace">
	<p class="workplace-title">》奪冠！中華將獎盃留在台灣</p>
	<p class="workplace-title">》奪冠！中華將獎盃留在台灣</p>	
	<p class="workplace-title">》奪冠！中華將獎盃留在台灣</p>
	<p class="workplace-title">》奪冠！中華將獎盃留在台灣</p>
	</div>
</div>

<!-- 職場萬花筒 -->
<div id="area3_3" class="area_box"><h1 id="area_title">職場萬花筒</h1>
	<a class="more-link" href="">更多..</a>

	<img class="area3-img" src="">
	<div class="workplace">
	<p class="workplace-title">》奪冠！中華將獎盃留在台灣</p>
	<p class="workplace-title">》奪冠！中華將獎盃留在台灣</p>	
	<p class="workplace-title">》奪冠！中華將獎盃留在台灣</p>
	<p class="workplace-title">》奪冠！中華將獎盃留在台灣</p>
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



<!--秀出工作-->
<script>
    <? 
    //後端傳來的工作資料
    include_once('js_work_list.php'); echo_work_list_array(); 

	//後端傳來"進階搜尋項目"的資料
	include_once("js_search_work_data.php"); echo_work_sub_data();
    ?>

	var box = $('#home-work-list-box');	    

	for(var i=0;i<work_list_array.length;i++){

		var box2 = $('<div>').addClass('work-box').addClass('box-detail'),
			box3 = $('<div>').addClass('work-box').addClass('box-loc'),
			box4 = $('<div>').addClass('work-box').addClass('box-pop'),

			img = $('<img>').addClass('box-img').attr('src', 'img_company/'+work_list_array[i].cid+'.jpg'),
			a_link = $('<a>').attr({href:'work/'+work_list_array[i].wid}),
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

	// 生成工作類型
		for(var i=0;i<work_type.length;i++)
		$("#work_type").append($("<option></option>").attr("value", work_type_id[i]).text(work_type[i]));


</script>




<!--搜尋功能的API-->
<script src="js/home_search_lib.js"></script>
</html>