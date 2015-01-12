<?php session_start(); 
if(!isset($_SESSION['username']) || $_SESSION['level'] != 4) { header("Location: index.php"); exit; }
$filename = 'img_company/'.$_SESSION['username'].'.jpg';
if (!file_exists($filename)) $filename = 'img_company/default.png';
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>您的公司</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/manage.css">
	<link rel="stylesheet" type="text/css" href="css/work_detail_edit.css">
	<link rel="stylesheet" type="text/css" href="css/company_worK_apply_list.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
	<script src="js/jquery.hashchange.min.js"></script>
	<script src="js/upload_img.js"></script>
	<script>
	$(function(){

		$('#view-header').load('public_view/header.php');
		$("#menu").load('public_view/menu.html');
	    $("#footer").load('public_view/footer.html');

	    
		$(window).hashchange( function(){

			ctu=false;
		  	var loc = location.hash.replace( /^#/, '' );
		  	switch(loc) {
			case 'company-info-0':case 'company-info':case '':doajax('0-0');break;
			case 'company-info-1': doajax('0-1');break;
			case 'company-addwork':doajax(1);break;
			case 'company-work':doajax(2);break;
			case 'company-staff':doajax(3);break;
			case 'company-notice':doajax(4);break;
			case 'explanation':doajax(12);break;
			default:doajax(5);
			}

		});

		$(window).hashchange();



		function doajax(idx){

                $('#right-box-title').html('載入中...請稍後');

				switch(idx) {
				// company info page 0
				case '0-0':
				tpe = 'get';
				para = { companyid: <?php echo "\"".$_SESSION['username']."\"" ?> ,page:0 };
				url = "company_detail_edit.php";
				break;

				// company info page 1
				case '0-1':
				tpe = 'get';
				para = { companyid: <?php echo "\"".$_SESSION['username']."\"" ?> ,page:1 };
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

				// staff manage
				case 3:
				tpe = 'post';
				para = {};
				url = "company_staff.php";	
				break;

				// notice
				case 4:
				tpe = 'post';
				para = {level: <?php echo "'".$_SESSION['level']."'"; ?>,username: <?php echo "'".$_SESSION['username']."'"; ?>};
				url = "notice.php";	
				break;

				

				// work-detail
				case 5:
				tpe = 'post';
				var wid = location.hash.replace( /^#work/, '' ).split("-");
				para = {workid:wid[0],page:wid[1]};
				url = "work_detail_edit2.php";	
				var goback = $('<a>').attr({href:'#company-work',id:'gobackbtn'}).append($('<i>').addClass('fa fa-reply').append(' '));
				break;

				// 操作說明
				case 12:
				tpe = 'post';
				para = {mode:'com'};
				url = "explanation.php";	
				break;
			}

			$.ajax({
			  type: tpe,
			  url: url,
			  data: para,
			  success: function (data) { $('#contailer-box').html(data) ;  }
			});

			if(idx=='0-0'||idx=='0-1') idx=0;
			else if(idx==5) idx=2;
			else if(idx==12) idx=5;
			
			$('.list').removeClass('list-active');
			$('.list:eq('+idx+')').addClass('list-active');

			$('#right-box-title').html('').append($('.list:eq('+idx+')').text());
			if(goback) $('#right-box-title').prepend(goback);
	}


            //依照公司審核通過與否 後端傳來的資料不同
            <?php include_once("company_manage_apply.php"); censored_check(); ?>


	});

	</script>
</head>


<body>
<div id="view-header"></div>
<!-- 菜單 -->
<div id="menu"></div>

<div class="b-space div-align overfix">

	<div id="" class="left-box" >

		<div class="profile-box">
			<img src="<?php echo $filename; ?>" class="profile-img" id="profile-img"><br>
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

		<img src="<?php echo 'img_company/'.$_SESSION['username'].'.jpg' ?>" class="upload-img-max">
		<form id="upload_form" enctype="multipart/form-data" method="post">
		 <input type="file" name="file1" id="file1"  class="btn-submit" accept="image/*">
		
		</form>
		 <p id="status"></p>
		 <button class=" btn-submit2" id="upload-btn-close">關閉</button>

		<!-- <progress id="progressBar" value="0" max="100" class="upload-pross"></progress> 進度條 -->

	</div> 
</div>

<!-- 頁尾訊息 -->
<div id="footer"></div>

</body>
</html>