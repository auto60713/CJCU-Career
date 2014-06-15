
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>長榮大學 - 媒合系統</title>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script><? include_once('js_work_list.php'); echo_work_list_array(); ?></script>
	<script>
	$(function(){ 	

		$.ajax({
					url:  'public_view/header.php',
					type: 'POST',
					data: {},
					success: function(data) {
                        $('#view-header').html(data);
                    }
		})
		
		$('#search-detail').hide();
		$('#btn_detail_search').on('click', function(event) {
			event.preventDefault();
			$('#search-detail').slideToggle('fast');
		});


	});
	</script>
    
</head>
<body>




<!-- login lightbox -->
<div id="login-lightbox">
<div id="cont" class="login">
<h1>登入 <i class="fa fa-times" id="login-exit"></i><br></h1>
<form class="form" name="login" method="post" action="login_connect.php" onsubmit="return check_data()">
選擇身分：<select name ="sel" class="login-select">
  <option value=""></option>
  <option value="student" selected="true">學生</option>
  <option value="company">廠商</option>
  <option value="staff">老師</option>
</select><br>

<span class="null-echo" id="sel-null"></span><br>
<i class="fa fa-user login-icon"></i><input type="text" name="id" placeholder="輸入帳號" class="login-input"><span class="null-echo" id="id-null" ></span><br>
<i class="fa fa-lock login-icon"></i><input type="password" name="pw" placeholder="輸入密碼" class="login-input"><span class="null-echo" id="pw-null" ></span>
<br>
<input type="submit" class="btn-submit" name="button" value="登入" />
<a href="company_forgotpwd.php">忘記密碼</a> 

<p class="login-hint">學生請使用校內帳號，廠商未註冊請先<a href="company_add.php" class="login-signup">註冊新帳號</a>。</p>

</form>
</div>
</div>




<!-- 版頭 -->
<div id="view-header"></div>


<div class="top">

	<div class="search-bar container">
		<div class="set-center">
			<input type="text" id="normal-search">
			<input type="button" id="search" value="搜尋">
			<a href="#" id="btn_detail_search">進階搜尋</a>
		</div>
	</div>

	<!--進階搜尋-->

	<div class=" container" id="search-detail">
<div class="tag-bar">
	<!-- 資料不完全
    <input type="checkbox" id="search_type" value="type">
    工作類型 : <select name="work_type" id="work_type"><option>請選擇</option></select> 
		       <select name="work_type_list1" id="work_type_list1"><option>請選擇</option></select>
			   <select name="work_type_list2" id="work_type_list2"><option>請選擇</option></select>
			   <span id="work_type_hint"></span>
			   <br>
    -->
    <input type="checkbox" id="search_prop" value="prop">
    工作性質 : <select name="work_prop" id="work_prop"></select> <br>

    <input type="checkbox" id="search_io" value="io">
    校內外工作：<select name="work_io" id="work_io">
                <option value="0">校內</option>
                <option value="1">校外</option>
                </select> 
			    <br>

    <input type="checkbox" id="search_zone" value="zone">
    工作地點 : <select name="zone" id="zone"></select> 
			   <select name="zone_name" id="zone_name"></select>
    <br></div>
</div>


<!-- 工作列表 -->




<div class="center">
	<!-- 取消進階搜尋 -->
	<div class="title-right"></div>
	<!-- 工作顯示 -->
	<div class="work-list-bar container" id="home-work-list-box"></div>
</div>


<!-- 頁尾廣告 -->
<div class="ad">
	<div class="container ad-bar">
		放個廣告 感覺很專業..................................
	</div>
</div>

<!-- 頁尾訊息 -->
<div class="footer">
	<div class="container footer-bar">
			
    All Jobs | PostaJob | AboutUs | ContactUs
	<br>
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
	
    //如果目前是搜尋狀態
    if(isset($_GET['mode']))
       //echo '$(".title-right").append($("<a></a>").attr("href", "home.php").text("取消搜尋"));';
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

			img = $('<div>').addClass('work-img'),
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



	// 生成工作類型
		for(var i=0;i<work_type.length;i++)
		$("#work_type").append($("<option></option>").attr("value", work_type_id[i]).text(work_type[i]));

    // 工作類型第一層 改變時，用ajax列出 第二層 工作類型細目
		$('#work_type').change(function() {
			var id=$(this).val();
			$("#work_type_list1 option").remove();
			// 執行AJAX取得細目資料
			$.ajax({
			type:"POST",
			async:false, 
			url:"ajax_work_type_list.php",
			data:"id="+id+"&list=1",
			success:function(msg){ $('#work_type_list1').html(msg);	},
			error: function(){alert("網路連線出現錯誤!");}
			});
		});

    // 工作類型第二層 改變時，用ajax列出 第三層 工作類型細目
		$('#work_type_list1').change(function() {
			var id=$(this).val();
			// 清空工作類別細目
			$("#work_type_list2 option").remove();
			// 執行AJAX取得細目資料
			$.ajax({
			type:"POST",
			async:false, 
			url:"ajax_work_type_list.php",
			data:"id="+id+"&list=2",
			success:function(msg){ $('#work_type_list2').html(msg);	},
			error: function(){alert("網路連線出現錯誤!");}
			});
		});

</script>
<!-- login lightbox-->
<script>
    //js 抓不到動態產生的物件 所以用 .on
    $(document).on('click', '#login-btn', function(){
        $( "#login-lightbox" ).css( "display", "block" ); 
    });
    $( "#login-exit" ).click(function() {
        $( "#login-lightbox" ).css( "display", "none" ); 
    });


    //判斷欄位是否為空
    function check_data(){

    $("#cont").find("span").text("");
	var boo = true;
	if(document.login.sel.value ==""){
		  $('#sel-null').text("請選擇身分"); boo = false;
	}else if(document.login.id.value ==""){
		  $('#id-null').text("請輸入帳號"); boo = false;
	}else if(document.login.pw.value ==""){
		  $('#pw-null').text("請輸入密碼"); boo = false;
	}

	return boo;
    }
</script>



<!--搜尋功能的API-->
<script src="js/home_search_lib.js"></script>
</html>