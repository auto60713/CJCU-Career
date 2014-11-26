<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>長大職涯網</title>

	<!-- 職場高手 -->

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
        $( "a[href='"+html_name+"']" ).attr("href","#");

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
<div id="inner4_area_1" class="area_box2">
	
</div>

<!-- 右區塊 -->
<div id="inner4_area_2" class="area_box2"><h1 id="area_title">職場高手</h1>

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