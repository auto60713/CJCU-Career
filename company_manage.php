<? session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>您的公司</title>
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
			ctu=false;
		  	var loc = location.hash.replace( /^#/, '' );
		  	switch(loc) {
			case 'company-info-0':case '':doajax('0-0');break;
			case 'company-info-1': doajax('0-1');break;
			case 'company-addwork':doajax(1);break;
			case 'company-work':doajax(2);break;
			case 'company-notice':doajax(3);break;
			default:doajax(4);
			}

		});

		$(window).hashchange();



		function doajax(idx){


				switch(idx) {
				// company info page 0
				case '0-0':
				tpe = 'get';
				para = { companyid: <? echo "\"".$_SESSION['username']."\"" ?> ,page:0 };
				url = "company_detail_edit.php";
				break;

				// company info page 1
				case '0-1':
				tpe = 'get';
				para = { companyid: <? echo "\"".$_SESSION['username']."\"" ?> ,page:1 };
				url = "company_detail_edit.php";
				break;

				// add work
				case 1:
				tpe = 'get';
				para = {mode:'add'};
				url = "work_add.php";
				break;
				// manage work
				case 2:
				tpe = 'get';
				para = {};
				url = "work_list.php";
				break;
				// notice
				case 3:
				tpe = 'post';
				para = {level: <? echo "'".$_SESSION['level']."'"; ?>,username: <? echo "'".$_SESSION['username']."'"; ?>};
				url = "notice.php";	
				break;

				// work-detail
				case 4:
				tpe = 'post';
				var wid = location.hash.replace( /^#work/, '' ).split("-");
				para = {workid:wid[0],page:wid[1]};
				url = "work_detail_edit2.php";	
				var goback = $('<a>').attr({href:'#company-work',id:'gobackbtn'}).append($('<i>').addClass('fa fa-reply').append(' '));
				break;
			}

			$.ajax({
			  type: tpe,
			  url: url,
			  data: para,
			  success: function (data) { $('#contailer-box').html(data) ;  }
			});

			if(idx=='0-0'||idx=='0-1') idx=0;
			if(idx==4) idx=2;
			
			$('.list').removeClass('list-active');
			$('.list:eq('+idx+')').addClass('list-active');

			$('#right-box-title').html('').append($('.list:eq('+idx+')').text());
			if(goback) $('#right-box-title').prepend(goback);
	}


            //依照公司審核通過與否 後端傳來的資料不同
            <? include_once("company_manage_apply.php"); censored_check(); ?>


	});

	</script>
</head>


<body>
<div id="view-header"></div>


<div class="div-align overfix">

	<div id="" class="left-box" >

		<div class="profile-box">
			<img src="<? echo 'img_company/'.$_SESSION['username'].'.jpg' ?>" class="profile-img" id="profile-img">
			<h2><? echo $_SESSION['username'] ?></h2>
		</div>

		<a href="#company-info-0"><div class="list">公司資訊</div></a><hr>
    <!--由後端傳來
		<a href="#company-addwork"><div class="list">新增工作</div></a><hr>
		<a href="#company-work"><div class="list">管理工作</div></a><hr>
		<a href="#company-notice"><div class="list">通知</div></a><hr>
    -->
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
		
		<h1>上傳公司圖片<i class="fa fa-times login-exit" id="upload-close"></i></h1>
		<p class="login-hint">您可以更新一張代表公司行號的照片</p>

		<img src="" class="upload-img-max">
		<img src="" class="upload-img-min">
		<form id="upload_form" enctype="multipart/form-data" method="post">
		 <input type="file" name="file1" id="file1"  class="btn-submit" accept="image/*">
		
		</form>
		 <p id="status"></p>
		 <button class=" btn-submit2" id="upload-btn-close">關閉</button>

		<!-- <progress id="progressBar" value="0" max="100" class="upload-pross"></progress> 進度條 -->

	</div> 
</div>


</body>

</html>