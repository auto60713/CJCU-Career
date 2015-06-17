<?php session_start(); 
if(!isset($_SESSION['username']) || $_SESSION['level'] != 4) { header("Location: index.php"); exit; }
$filename = 'img_company/'.$_SESSION['username'].'.jpg';
if(!file_exists($filename)) $filename = 'img_company/default.png';
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="img/ico.ico" rel="SHORTCUT ICON">
	<title>長大職涯網-帳號管理</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/manage.css">
	<link rel="stylesheet" type="text/css" href="css/work_detail_edit.css">
	<link rel="stylesheet" type="text/css" href="css/company_worK_apply_list.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
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
	    
        //如果瀏覽器不支援JSON則載入json2.js
		if (typeof (JSON) == 'undefined') $.getScript('js/json2.js');

        //依照公司審核通過與否 後端傳來的資料不同
        <?php include_once("company_manage_apply.php"); censored_check(); ?>


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
                var tpe,para,url,claaas;

				switch(idx) {

				case '0-0':
				tpe = 'get';
				para = { companyid: <?php echo "\"".$_SESSION['username']."\"" ?> ,page:0 };
				url = "company_detail_edit.php";
				claaas = 'company-info-0';
				break;

				case '0-1':
				tpe = 'get';
				para = { companyid: <?php echo "\"".$_SESSION['username']."\"" ?> ,page:1 };
				url = "company_detail_edit.php";
				claaas = 'company-info-0';
				break;

				case 1:
				tpe = 'get';
				para = {mode:'add'};
				url = "work_add.php";
				claaas = 'company-addwork';
				break;

				case 2:
				tpe = 'get';
				para = {};
				url = "work_list.php";
				claaas = 'company-work';
				break;

				case 3:
				tpe = 'post';
				para = {};
				url = "company_staff.php";	
				claaas = 'company-staff';
				break;

				case 4:
				tpe = 'post';
				para = {level: <?php echo "'".$_SESSION['level']."'"; ?>,username: <?php echo "'".$_SESSION['username']."'"; ?>};
				url = "notice.php";	
				claaas = 'company-notice';
				break;

				case 5:
				tpe = 'post';
				var wid = location.hash.replace( /^#work/, '' ).split("-");
				para = {workid:wid[0],page:wid[1]};
				url = "work_detail_edit2.php";	
				claaas = 'company-work';
				var goback = $('<a>').attr({href:'#company-work',id:'gobackbtn'}).append($('<i>').addClass('fa fa-reply').append(' '));
				break;

				// 操作說明
				case 12:
				tpe = 'post';
				para = {mode:'com'};
				url = "explanation.php";
				claaas = 'explanation';	
				break;
			}

			$.ajax({
			  type: tpe,
			  url: url,
			  data: para,
			  success: function (data) { $('#contailer-box').html(data) ;  }
			});


            $('.list').removeClass('list-active');
            $('.'+claaas).addClass('list-active');
			$('#right-box-title').text($('.'+claaas).text());

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

	<div id="" class="left-box" >

		<div class="profile-box">
			<img src="<?php echo $filename; ?>" class="profile-img" id="profile-img"><br>
		</div>

    	<a href="#company-info-0"><div class="company-info-0 list">公司資訊</div></a><hr>
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