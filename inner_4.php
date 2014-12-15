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

	<h1 class="news_title"><a class="news_time"></a></h1> 
    <hr class="begin_hr">

	<div class="news_cont">
   </div>
<!--
	<hr class="bottom_hr">
	<a class="before_news bottom_pointer">[上一則]</a><a class="next_news bottom_pointer">[下一則]</a>
-->
</div>

<!-- 右區塊 -->
<div id="inner4_area_2" class="area_box2"><h1 id="area_title">校內新聞</h1>

    <!-- 載入五筆 -->


<div class="page_ctrl">
<!--<a class="this_page">1</a>-->
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
var article_id = "";
    <?php if(isset($_GET["article_id"])) echo 'var article_id = "'.$_GET["article_id"].'";'?>

      
        //文章選單
        $.ajax({
          type: 'POST',
          url: 'cjcu_career/cc/index.php/news/lists/1',
          data:{},
          success: function (data) { 

            if(data=='false') $('#inner4_area_2').append($('<a>').addClass('no_paper').text('目前沒有文章'));
            else article_array = JSON.parse(data);
          },
          async: false
        });


            var this_page=1,min=0,max=5;
            <?php if(isset($_GET['page'])) echo "this_page=".$_GET['page'].";min=(".$_GET['page']."-1)*5;max=((".$_GET['page']."-1)*5)+5;"; ?>

            
             //文章資訊
        $.ajax({
          type: 'POST',
          url: 'cjcu_career/cc/index.php/news/detail/'+article_id,
          data:{},
          success: function (data) { 
            if(data!='false') {

            var paper_array = JSON.parse(data);
            $('.news_title').prepend(paper_array.title);  
            $('.news_time').html(paper_array.created_date.split(" ")[0]);  
            $('.news_cont').html(paper_array.content);  
            }
            else{
              //右邊邊第一篇
            $('.news_title').prepend(article_array[min].title);  
            $('.news_time').html(article_array[min].created_date.split(" ")[0]);  
            $('.news_cont').html(article_array[min].content);  
            }
          }
        });

           
            var page_num=1+Math.floor(article_array.length/5);
            for (var i = 1; i <= page_num; i++) {
                page = $('<a>').addClass('point'+i).attr("href",'inner_4.php?page='+i).text(i);
                $('.page_ctrl').append(page);
            }
            $('.point'+this_page ).addClass('this_page');

            for (var i = min; i < article_array.length; i++) { if (i==max) break;
            
                var time  = $('<p>').addClass('list_time').text(article_array[i].created_date.split(" ")[0]),
                    title = $('<p>').addClass('list_title').text(article_array[i].title),
                    nevin = $('<div>').addClass('list_cont').html(article_array[i].content),
                    link  = $('<a>').attr("href",'inner_4.php?article_id='+article_array[i].id).append(time,title,nevin), 
                    work  = $('<div>').addClass('list_one').append(link);

                $('#inner4_area_2').append(work);
            }


</script>
</html>