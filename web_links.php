<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>長大職涯網</title>

	<!-- 好站連連看 -->

	<link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
  <script src="js/jquery-min.js"></script>
  <script src="js/jquery-migrate-min.js"></script>
	<script>
	$(function(){ 	

		$('#view-header').load('public_view/header.php');
    $("#menu").load('public_view/menu.html');
    $("#footer").load('public_view/footer.html');

	})
	</script>
    
</head>
<style type="text/css">

#back_div{
    width: 1100px;
    height: 920px;
    background-color: #FFF;

}
#master_div{
    background-image: url("img/inner4_area01.jpg");
    background-repeat: no-repeat;
    background-size: 100% 100%;

    position: relative;
    overflow: hidden;
    float: left;

    width: 70%;
    height: 800px;

    margin-top: 20px;
    margin-left: 15%;

    padding-top: 30px;
    padding-right: 15px;
    padding-bottom: 40px;
}
#master_div h1{
  margin-left: 30px;
}
hr{
  width: 93%;
  color: #808080;
  background-color: #808080;
  height: 1px;
}
</style>
<body>


<!-- 版頭 -->
<div id="view-header" class=""></div>

<!-- 菜單 -->
<div id="menu"></div>

<!-- 主體 -->
<div id="back_div" class="div-align">


<!-- 主區塊 -->
<div id="master_div">
    <h1>好站連連看</h1>
    <hr class="div-align">




</div>

</div>


<!-- 頁尾訊息 -->
<div id="footer"></div>


</body>





<script>

        
        $.ajax({
          type: 'POST',
          async: false,
          url: 'cjcu_career/cc/index.php/links',
          data:{},
          success: function (data) { 

              var links_json = JSON.parse(data);
        
              $('#master_div').append(links_json);

          }
        });


</script>
</html>