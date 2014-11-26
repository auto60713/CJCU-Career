<? session_start();
if(!isset($_SESSION['username']) || $_SESSION['level'] != 3) { header("Location: home.php"); exit; }
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>個人頁面</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/manage.css">
	<link rel="stylesheet" type="text/css" href="css/work_detail_edit.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<script src="js/jquery.js"></script>
	<script src="js/jquery.hashchange.min.js"></script>
	<script src="js/upload_img.js"></script>
	<script>
	$(function(){

		$('#view-header').load('public_view/header.php');

		$(window).hashchange( function(){

		  	var loc = location.hash.replace( /^#/, '' );
		  	switch(loc) {
			case 'student-info':doajax(0);break;
			case 'student-applywork':doajax(1);break;
			case 'student-notice':doajax(2);break;
			default:doajax(0);
			}

		});

		$(window).hashchange();


		function doajax(idx){

			    $('#right-box-title').html('載入中...請稍後');

				$('.list').removeClass('list-active');
				$('.list:eq('+idx+')').addClass('list-active');
				$('#right-box-title').text($('.list:eq('+idx+')').text());

				switch(idx) {
				// student info
				case 0:
				tpe = 'get';
				para = { userid: <? echo "\"".$_SESSION['username']."\"" ?> };
				url = "student_detail_edit.php";
				break;
				// 學生應徵的工作
				case 1:
				tpe = 'get';
				para = {};
				url = "student_work.php";
				break;
				// notice
				case 2:
				tpe = 'post';
				para = {};
				url = "notice.php";	
				break;
			}
			$.ajax({
			  type: tpe,
			  url: url,
			  data: para,
			  success: function (data) { $('#contailer-box').html(data) ;  }
			});
		}


		
		<?	//load data
		    include_once("js_detail.php"); echo_student_profile($_SESSION['username']); 
		?>

        $("#profile-img").attr("src",'http://esrdoc.cjcu.edu.tw/esr_photo/'+student_profile_array['sd_syear'].trim()+'/'+student_profile_array['sd_no'].trim()+'.jpg');
        $(".profile-box h2").text(student_profile_array['sd_no']);

	});
	</script>
</head>


<body>
<div id="view-header"></div>


<div class="b-space div-align overfix">

	<div id="" class="left-box" >

		<div class="profile-box">
			<img src="" id="profile-img" class="profile-img-stu"><br>
			<h2></h2>
		</div>

		<a href="#student-info"><div class="list">個人資訊</div></a><hr>
		<a href="#student-applywork"><div class="list">我的應徵</div></a><hr>
		<a href="#student-notice"><div class="list">通知</div></a><hr>
	</div>


	<div id="" class="right-box">
		<h2 id="right-box-title"></h2>
		<br>
		<div id="contailer-box"></div>
	</div>

	
</div>



<!-- upload image

<div class="staff-apply-form" id="upload-profile-lightbox"> 
	
	<div class="staff-apply-box"> 
		
		<h1>上傳照片<i class="fa fa-times login-exit" id="upload-close"></i></h1>
		<p class="login-hint">您可以更新一張代表您的照片</p>

		<img src="" class="upload-img-max">
		<img src="" class="upload-img-min">
		<form id="upload_form" enctype="multipart/form-data" method="post">
		 <input type="file" name="file1" id="file1"  class="btn-submit" accept="image/*">
		
		</form>
		 <p id="status"></p>
		 <button class=" btn-submit2" id="upload-btn-close">關閉</button>

	</div> 
</div>

 -->

</body>
</html>