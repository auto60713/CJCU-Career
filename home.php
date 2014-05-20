
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>長榮大學 - 媒合系統</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script><? include_once('js_work_list.php'); echo_work_list_array(); ?></script>
	<script>
	$(function(){ 
		
		$('#view-header').load('public_view/header.php');

		/* modle of work 
			<div class="work">
				<h1>wefewfwefwefwefewfwefwefwefwefewf</h1>
				<p>台南市</p>
				<p>校外 工讀</p>
				<p>需求 8人</p>
				<p class="date">2013/01/10</p>
			</div>
		*/

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
<h1>帳號登入</h1><hr>
<form class="form" name="login" method="post" action="login_connect.php" onsubmit="return check_data()">
請選擇登入身分
<select name ="sel" >
  <option value=""></option>
  <option value="student">學生</option>
  <option value="company">廠商</option>
  <option value="staff">老師</option>
</select><span id="null-echo"></span> <br>
帳號：<input type="text" name="id" /><br>
密碼：<input type="password" name="pw" />
<input type="submit" class="submit" name="button" value="登入" /><br><br>
<a href="company_add.php">廠商註冊</a>　
<a href="company_forgotpwd.php">忘記密碼</a> 　
<a href="#" id="login-exit">取消</a><br>
</form>
</div>
</div>

<!-- 版頭 -->
<div id="view-header"></div>
<!-- 測試用 debug後將此條刪除 --><span><a href="#" id="login-btn">登入</a></span>

<!-- 搜尋 -->
<div class="top">

	<div class="search-bar container">
		<div class="set-center">
			<input type="text" id="normal-search">
			<input type="button" id="search" value="搜尋">
			<a href="#" id="btn_detail_search">進階搜尋</a>
		</div>
	</div>

	<!--進階搜尋-->
	<div class="tag-bar container" id="search-detail">
    <input type="checkbox" id="search_type" value="type">
    工作類型 : <select name="work_type" id="work_type"><option>請選擇</option></select> 
		       <select name="work_type_list1" id="work_type_list1"><option>請選擇</option></select><!-- 要等 work_type 選完才載入 -->
			   <select name="work_type_list2" id="work_type_list2"><option>請選擇</option></select><!-- 要等 work_type 選完才載入 -->
			   <span id="work_type_hint"></span>
			   <br>

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
		       <br>
	</div>
</div>

<!-- 工作列表 -->
<div class="center">

	<div class="title container">
		<div class="title-left">
		<h1>工作列表</h1>
		</div>

		<div class="title-right">
		</div>
	</div>

	<div class="work-list-bar container">
		<div class="list"></div>
		<div class="list"></div>
		<div class="list"></div>
		<div class="list"></div>
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
       echo '$(".title-right").append($("<a></a>").attr("href", "home.php").text("取消搜尋"));';
    ?>

	var list_container_index = 0;

	for(var i=0;i<work_list_array.length;i++){

		var a_link = $('<a>').attr({href:'work/'+work_list_array[i].wid}),
			div_work = $('<div>').addClass('work'),
			work_name = $('<h1>').text(work_list_array[i].wname),
			work_zone = $('<p>').text(work_list_array[i].zname),
			work_propn = $('<p>').text(((work_list_array[i].isout=='0')?'校內 ':'校外 ') + work_list_array[i].propname),
			work_recr = $('<p>').text('需求 '+ work_list_array[i].rno +' 人'),
			work_date = $('<p>').addClass('date').text(work_list_array[i].date.split(' ')[0]);
			

		div_work.append(work_name).append(work_zone).append(work_propn).append(work_recr).append(work_date);
		a_link.append(div_work);

		if(list_container_index==4)list_container_index=0;

		$('.list:eq('+list_container_index+')').append(a_link);
		list_container_index++;
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
    $( "#login-btn" ).click(function() {
        $( "#login-lightbox" ).css( "display", "block" ); return false;
    });
    $( "#login-exit" ).click(function() {
        $( "#login-lightbox" ).css( "display", "none" ); return false;
    });


    //判斷欄位是否為空
    function check_data(){

    $("#cont").find("span").text("");
	var boo = true;
	if(document.login.sel.value ==""){
		  $('#null-echo').text("請選擇身分"); boo = false;
	}else if(document.login.id.value ==""){
		  $('#null-echo').text("請輸入帳號"); boo = false;
	}else if(document.login.pw.value ==""){
		  $('#null-echo').text("請輸入密碼"); boo = false;
	}

	return boo;
    }
</script>
<!--搜尋功能的API-->
<script src="js/home_search_lib.js"></script>
</html>