
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


<!-- 焦點新聞 -->
<div id="xxx1" class="area_box"><h1 id="area_title">焦點新聞</h1>
</div>
<!-- FB -->
<div id="xxx2" class="area_box">
</div>


<!-- 工作列表 -->
<div id="work_list" class="area_box"><h1 id="area_title">工作列表</h1>

	<!-- 搜尋 -->
	<div class="search-bar">
			<input type="text" id="normal-search">
			<input type="button" id="search" value="搜尋">
			<a href="#" id="high_search_btn"><i class="fa fa-cog"></i>進階搜尋</a>
	</div>

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
</div>



<!-- 校內新聞 -->
<div id="xxx3" class="area_box"><h1 id="area_title">校內新聞</h1>
</div>
<!-- 職場高手 -->
<div id="xxx4" class="area_box"><h1 id="area_title">職場高手</h1>
</div>
<!-- 職場動態 -->
<div id="xxx5" class="area_box"><h1 id="area_title">職場動態</h1>
</div>
<!-- 職場萬花筒 -->
<div id="xxx6" class="area_box"><h1 id="area_title">職場萬花筒</h1>
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

		var box1 = $('<div>').addClass('work-box').addClass('box-img'),
			box2 = $('<div>').addClass('work-box').addClass('box-name'),
			box3 = $('<div>').addClass('work-box').addClass('box-loc'),
			box4 = $('<div>').addClass('work-box').addClass('box-pop'),

			img = $('<img>').addClass('com-img').attr('src', 'img_company/'+work_list_array[i].cid+'.jpg'),
			a_link = $('<a>').attr({href:'work/'+work_list_array[i].wid}),
			div_work = $('<div>').addClass('work'),

			work_name = $('<h1>').text(work_list_array[i].wname),
			work_zone = $('<p>').text(work_list_array[i].zname).prepend($('<i>').addClass('fa fa-map-marker')),
			work_propn = $('<p>').text(((work_list_array[i].isout=='0')?'校外 ':'校內 ') + work_list_array[i].propname),
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