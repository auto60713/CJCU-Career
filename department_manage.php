<? session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>帳號管理</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/company_manage.css">
	<link rel="stylesheet" type="text/css" href="css/work_detail_edit.css">
	<link rel="stylesheet" type="text/css" href="css/company_worK_apply_list.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="js/jquery.hashchange.min.js"></script>
	<script src="js/upload_img.js"></script>
	<script>
	$(function(){

		$('#view-header').load('public_view/header.php');

		$(window).hashchange( function(){

		  	var loc = location.hash.replace( /^#/, '' );
		  	switch(loc) {
			case 'department-info':case'':doajax(0);break;
			case 'department-addwork':doajax(1);break;
			case 'department-work':doajax(2);break;
			case 'department-match':doajax(3);break;
			case 'department-notice':doajax(4);break;

			default:doajax(10);

			}  //要按照順序

		});

		$(window).hashchange();



		function doajax(idx){


				switch(idx) {

				case 0:
				tpe = 'get';
				para = {};
				url = "department_detail_edit.php";
				break;

				case 1:
				tpe = 'get';
				para = {mode:'add'};
				url = "work_add.php";
				break;

				case 2:
				tpe = 'get';
				para = {};
				url = "work_list.php";
				break;

                case 3:
				tpe = 'get';
				para = {};
				url = "department_match.php";
				break;

				case 4:
				tpe = 'post';
				para = {level: <? echo "'".$_SESSION['level']."'"; ?>,username: <? echo "'".$_SESSION['username']."'"; ?>};
				url = "notice.php";	
				break;

				// work-detail
				case 10:
				tpe = 'post';
				var wid = location.hash.replace( /^#work/, '' ).split("-");
				para = {workid:wid[0],page:wid[1]};
				url = "work_detail_edit2.php";	
				var goback = $('<a>').attr({href:'#dapartment-work',id:'gobackbtn'}).append($('<i>').addClass('fa fa-reply').append(' '));
				break;
			}

			$.ajax({
			  type: tpe,
			  url: url,
			  data: para,
			  success: function (data) { $('#contailer-box').html(data) ;  }
			});

			if(idx=='0-0'||idx=='0-1') idx=0;

			
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


<div class="div-align overhidden">

	<div id="" class="left-box" >

		<div class="profile-box">
			<img src="<? echo 'img_company/'.$_SESSION['username'].'.jpg' ?>" class="profile-img" id="profile-img">
			<h2><? echo $_SESSION['username'] ?></h2>
		</div>

		<a href="#department-info"><div class="list">系所資訊</div></a><hr>
		<a href="#department-addwork"><div class="list">新增工作</div></a><hr>
		<a href="#department-work"><div class="list">管理工作</div></a><hr>
		<a href="#department-match"><div class="list">實習管理</div></a><hr>
		<a href="#department-notice"><div class="list">通知</div></a><hr>

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

		<img src="<? echo 'img_company/'.$_SESSION['username'].'.jpg' ?>" class="upload-img-max">
		<img src="<? echo 'img_company/'.$_SESSION['username'].'.jpg' ?>" class="upload-img-min">
		<form id="upload_form" enctype="multipart/form-data" method="post">
		 <input type="file" name="file1" id="file1"  class="btn-submit" accept="image/*"> <p id="status"></p>
		
		</form>
		 <button class=" btn-submit2" id="upload-btn-close">關閉</button>



	</div> 
</div>




</body>

</html>