<?php session_start();
if(!isset($_SESSION['username']) || $_SESSION['level'] != 1) { header("Location: index.php"); exit; }
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="img/ico.ico" rel="SHORTCUT ICON">
	<title>帳戶管理</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/manage.css">
	<link rel="stylesheet" type="text/css" href="css/work_detail_edit.css">
	<link rel="stylesheet" type="text/css" href="css/company_worK_apply_list.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<script src="js/jquery-min.js"></script>
    <script src="js/jquery-migrate-min.js"></script>
    <script src="js/jquery-ui.js"></script>
	<script src="js/jquery.hashchange.min.js"></script>
	<script src="js/upload_img.js"></script>
	<script>
	$(function(){

		$('#view-header').load('public_view/header.php');
		$("#menu").load('public_view/menu.html');
	    $("#footer").load('public_view/footer.html');

		$(window).hashchange( function(){

		  	var loc = location.hash.replace( /^#/, '' );
		  	switch(loc) {
			case 'staff-info':case'':doajax(0);break;
			case 'staff-audit0':doajax(1.0);break;
			case 'staff-audit1':doajax(1.1);break;
			case 'staff-addwork':doajax(2);break;
			case 'staff-work':doajax(3);break;
			case 'staff-maintain':doajax(4);break;
			case 'explanation':doajax(12);break;

			default:doajax(10);
			}

		});

		$(window).hashchange();


		function doajax(idx){

			    $('#right-box-title').html('載入中...請稍後');

				var pg = 0;

				if(idx==1.0){
					pg=0;
					idx=1;
				}
				else if(idx==1.1){
					pg=1;
					idx=1;
				}

			switch(idx) {
			// student info
				case 0:
				tpe = 'get';
				para = { userid: <?php echo "\"".$_SESSION['username']."\"" ?> };
				url = "department_detail_edit.php";
				break;
			// audit
				case 1:
				tpe = 'get';
				para = {page:pg};
				url = "staff_audit.php";
				break;
			// add work
				case 2:
				tpe = 'get';
				para = {mode:'add'};
				url = "work_add.php";
				break;
			// manage work
				case 3:
				tpe = 'get';
				para = {};
				url = "work_list.php";
				break;
			// maintain
				case 4:
				tpe = 'get';
				para = {};
				url = "staff_maintain.php";
				break;
			// work-detail
				case 10:
				tpe = 'post';
				var wid = location.hash.replace( /^#work/, '' ).split("-");
				para = {workid:wid[0],page:wid[1]};
				url = "work_detail_edit2.php";	
				var goback = $('<a>').attr({href:'#staff-work',id:'gobackbtn'}).append($('<i>').addClass('fa fa-reply').append(' '));
				break;

			// 操作說明
				case 12:
				tpe = 'post';
				para = {mode:'staff'};
				url = "explanation.php";	
				break;
			}

			$.ajax({
			  type: tpe,
			  url: url,
			  data: para,
			  success: function (data) { $('#contailer-box').html(data) ;  }
			});



			if(idx==10) idx=3;
			else if(idx==12) idx=5;
			
			$('.list').removeClass('list-active');
			$('.list:eq('+idx+')').addClass('list-active');

			$('#right-box-title').html('').append($('.list:eq('+idx+')').text());
			if(goback) $('#right-box-title').prepend(goback);
		}
	


	});
	</script>
</head>


<body>
<div id="view-header"></div>
<!-- 菜單 -->
<div id="menu"></div>

<div class="b-space div-align overfix">

	<div class="left-box" >
		
		<div class="profile-box">
			<img src="<?php echo 'img_department/'.$_SESSION['username'].'.jpg' ?>" class="profile-img" id="profile-img"><br>
		</div>

		<a href="#staff-info"><div class="list">基本資訊</div></a><hr>
		<a href="#staff-audit0"><div class="list">審核工作與公司</div></a><hr>
		<a href="#staff-addwork"><div class="list">新增工作</div></a><hr>
		<a href="#staff-work"><div class="list">我發佈的工作</div></a><hr>
		<a href="#staff-maintain"><div class="list">維護與查詢</div></a><hr>
		<a href="#explanation"><div class="list">操作說明</div></a><hr>
	</div>

	<div id="" class="right-box">
		<h2 id="right-box-title"></h2>
		<br>
		<div id="contailer-box"></div>
	</div>

</div>


<!-- upload image -->

<div class="staff-apply-form" id="upload-profile-lightbox"> 
	
	<div class="staff-apply-box"> 
		
		<h1>上傳圖片<i class="fa fa-times login-exit" id="upload-close"></i></h1>
		<p class="login-hint">您可以更新一張代表系上的照片</p>

		<img src="<?php echo 'img_department/'.$_SESSION['username'].'.jpg' ?>" class="upload-img-max">
		<form id="upload_form" enctype="multipart/form-data" method="post">
		 <input type="file" name="file1" id="file1"  class="btn-submit" accept="image/*"> <p id="status"></p>
		
		</form>
		 <button class=" btn-submit2" id="upload-btn-close">關閉</button>



	</div> 
</div>

<!-- 頁尾訊息 -->
<div id="footer"></div>

</body>
</html>