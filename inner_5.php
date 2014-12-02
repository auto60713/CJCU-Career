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
<div id="inner4_area_2" class="area_box2"><h1 id="area_title">職場高手</h1>

    <!-- 載入五筆 -->

<!-- 
<div class="page_ctrl">
<a class="this_page">[上一頁]</a><a class="this_page">1</a><a>2</a><a>3</a><a>4</a><a>5</a><a>...</a><a class="this_page">[下一頁]</a>
</div>
-->
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

        //文章選單
        $.ajax({
          type: 'POST',
          url: 'cjcu_career/cc/index.php/news/lists/1',
          data:{},
          success: function (data) { 
            var article_array = JSON.parse(data);

            for (var i = 0; i < article_array.length; i++) { if (i==4) break;
            
                var time  = $('<p>').addClass('list_time').text(article_array[i].created_date.split(" ")[0]),
                    title = $('<p>').addClass('list_title').text(article_array[i].title),
                    nevin = $('<div>').addClass('list_cont').html(article_array[i].content),
                    link  = $('<a>').attr("href",location.href+'?article_id='+article_array[i].id).append(time,title,nevin), 
                    work  = $('<div>').addClass('list_one').append(link);

                $('#inner4_area_2').append(work);
            }
          }
        });
    
</script>
</html>