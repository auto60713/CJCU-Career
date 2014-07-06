
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>長榮大學 - 媒合系統</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="js/full_height.js"></script>
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

		$('#search-detail').hide();
		$('#btn_detail_search').on('click', function(event) {
			event.preventDefault();
			$('#search-detail').slideToggle('fast');
		});


	})
	</script>
    
</head>
<body>

<div none="true">
<!-- 版頭 -->
<div id="view-header" class="box-shadow1" _height="none"></div>

<!-- 搜尋 -->
<div class="div-search margin-top20" _height="none">

	<div class="search-bar container">
		<div class="set-center">
			<input type="text" id="normal-search">
			<input type="button" id="search" value="搜尋">
			<a href="#" id="btn_detail_search" class="search-detail"><i class="fa fa-cog"></i>進階搜尋</a>
		</div>
	</div>

	<!--進階搜尋-->

	<div class="container" id="search-detail">
	<div class="tag-bar">
	
	<div class="search-detail-sub">
		 <input type="checkbox" id="search_prop" value="prop" class="search-detail-input">
	     <label for="search_prop">工作性質 : </label><select name="work_prop" id="work_prop"></select>
	</div>
	

	<div class="search-detail-sub">
	    <input type="checkbox" id="search_io" value="io">
	     <label for="search_io">校內外工作：</label>
	     <select name="work_io" id="work_io" class="search-detail-input">
	          <option value="0">校內</option>
	          <option value="1">校外</option>
	     </select> 
	</div>


	<div class="search-detail-sub">
	    <input type="checkbox" id="search_zone" value="zone" >
	    <label for="search_zone">工作地點 : </label>
	    <select name="zone" id="zone" class="search-detail-input"></select> 
		<select name="zone_name" id="zone_name" class="search-detail-input"></select>
	</div>


    </div>
    </div>
</div>


<!-- 工作列表 -->
<div class="center margin-bottom50" _height="auto">
	<!-- 取消進階搜尋 -->
	<div class="container rush-search">
		<a href="home.php" class="<? if(count($_GET)==0) echo "rush-searching"; ?>">最新工作</a>
		<a href="home.php?mode=search&prop=2" class="<? if($_GET['prop']=='2') echo "rush-searching"; ?>">正職</a>
		<a href="home.php?mode=search&io=0" class="<? if($_GET['io']=='0') echo "rush-searching"; ?>">校內工作</a>
		<a href="home.php?mode=search&prop=3" class="<? if($_GET['prop']=='3') echo "rush-searching"; ?>">實習</a>
		<a href="home.php?mode=search&prop=1&io=1" class="<? if($_GET['prop']=='1' && $_GET['io']=='1') echo "rush-searching"; ?>">打工</a>			
	</div>
	<!-- 工作顯示 -->
	<div class="work-list-bar container" id="home-work-list-box"></div>
</div>


<!-- 頁尾訊息 -->
<div class="footer box-shadow2" _height="none">
	<div class="container footer-bar">
			
    All Jobs | PostaJob | AboutUs | ContactUs
	<br>
	© 2014 長大職涯網 Inc. 長榮大學 職涯發展組

	</div>
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

    /*
		<a href="work/4">
			<div class="work">
				<h1>電腦工程大師</h1>
				<p>臺北市</p>
				<p>校內 工讀</p>
				<p>需求 10 人</p>
				<p class="date">2014-03-09</p>
			</div>
		</a>

    */


	var box = $('#home-work-list-box');	    

	for(var i=0;i<work_list_array.length;i++){

		var box1 = $('<div>').addClass('work-box').addClass('box-img'),
			box2 = $('<div>').addClass('work-box').addClass('box-name'),
			box3 = $('<div>').addClass('work-box').addClass('box-loc'),
			box4 = $('<div>').addClass('work-box').addClass('box-pop'),

			img = $('<img>').addClass('work-img').attr('src', 'img_company/'+work_list_array[i].cid+'.jpg'),
			a_link = $('<a>').attr({href:'work/'+work_list_array[i].wid}),
			div_work = $('<div>').addClass('work'),

			work_name = $('<h1>').text(work_list_array[i].wname),
			work_zone = $('<p>').text(work_list_array[i].zname).prepend($('<i>').addClass('fa fa-map-marker')),
			work_propn = $('<p>').text(((work_list_array[i].isout=='0')?'校內 ':'校外 ') + work_list_array[i].propname),
			work_recr = $('<p>').text('需求 '+ work_list_array[i].rno +' 人'),
			work_date = $('<p>').addClass('date').text('開始招募'+work_list_array[i].date.split(' ')[0]);
			

			box1.append(img);
			box2.append(work_name).append(work_recr).append(work_date);
			box3.append(work_zone);
			box4.append(work_propn);


			div_work.append(box1).append(box2).append(box3).append(box4);
			a_link.append(div_work);
			box.append(a_link);

	}
	
	//設定搜尋後的回應
	if(typeof search_log_cont =="undefined") search_log_cont = '';

	var search_log = $('<a>').addClass('search-log').text(search_log_cont);
    //搜尋結果的訊息 search_log_cont從php回傳
    box.prepend(search_log);


	// 生成工作類型
		for(var i=0;i<work_type.length;i++)
		$("#work_type").append($("<option></option>").attr("value", work_type_id[i]).text(work_type[i]));


</script>




<!--搜尋功能的API-->
<script src="js/home_search_lib.js"></script>
</html>