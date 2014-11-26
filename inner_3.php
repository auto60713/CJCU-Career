<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>長大職涯網</title>

	<!-- 工作列表 -->

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

        //此頁面名稱
        var html_name = location.pathname.split('/').slice(-1)[0];

        //改變菜單的型態
        $( "a[href='"+html_name+"']" ).parent("li").addClass( "this_html" );
        $( "li a[href='"+html_name+"']" ).attr("href","#");

	})
	</script>
    
</head>

<body>


<!-- 版頭 -->
<div id="view-header" class=""></div>


<!-- 菜單 -->
<div id="menu">
    <ul class="div-align">
        <li><a href="index.php">首頁</a></li>
        <li><a href="inner_2.php">焦點新聞</a></li>
        <li><a href="inner_3.php">工作列表</a></li>
        <li><a href="inner_4.php">校內新聞</a></li>
        <li><a href="inner_5.php">職場高手</a></li>
        <li><a href="inner_6.php">職場動態</a></li>
        <li><a href="inner_7.php">職場萬花筒</a></li>
    </ul>

</div>


<!-- 主體 -->
<div id="main" class="div-align">
<!-- 任何區塊因為空間大小都要限制字數 -->



<!-- 左區塊 -->
<div id="inner3_area_1" class="area_box2">



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


</div>



<!-- 右區塊 -->
<div id="inner3_area_2" class="area_box2"><h1 id="area_title">進階搜尋</h1>

    <!-- 進階搜尋 -->
    <div class="high_search-bar">


    <!-- 名稱搜尋 -->
    <input type="text" id="normal-search">

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

    <input type="button" id="search" value="搜尋">
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
    include_once('js_work_list.php'); echo_work_list_array(200); 

    //後端傳來"進階搜尋項目"的資料
    include_once("js_search_work_data.php"); echo_work_sub_data();
    ?>



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

    // 生成工作類型
        for(var i=0;i<work_type.length;i++)
        $("#work_type").append($("<option></option>").attr("value", work_type_id[i]).text(work_type[i]));


</script>




<!--搜尋功能的API-->
<script src="js/home_search_lib.js"></script>
</html>