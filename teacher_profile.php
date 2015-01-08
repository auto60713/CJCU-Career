<?php session_start(); 
$filename = 'img_company/'.$_GET['companyid'].'.jpg';
if (!file_exists($filename)) $filename = 'img_company/default.png';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/manage.css">
	<link rel="stylesheet" type="text/css" href="../css/profile.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script><?php include_once("js_detail.php"); echo_staff_profile($_GET['userid']); ?></script>
	<script> 
	$(function(){

		$('.profile-pic-change, #profile-btn-edit').hide();

		$('#view-header').load('../public_view/header.php #header');

		// init load data
		$('#username').text(staff_profile_array['name']);
		$('#level').text('管理員');
		$('#from').text('長榮大學-職涯發展組');
		$('#Introduction').text('維護系統');


	});
	</script>

</head>

<body>


<div id="view-header"></div>

<div class="b-space div-align">


<div class="profile-content overfix">
<div class="profile-boxleft">
	<h2>關於</h2>
	<div class="profile-pic">
	<img class="profile-pic-img" src="<?php echo $filename; ?>">
    </div>

	<!-- 以下欄位皆為參考學生系統之欄位所建 -->

	<p><span class="profile-span-title">姓名</span><span id="username"></span></p>
	<p><span class="profile-span-title">身分</span><span id="level"></span></p>
	<p><span class="profile-span-title">服務單位</span><span id="from"></span></p>
	<p><span class="profile-span-title">介紹</span><span id="Introduction"></span></p>

</div>


<div class="profile-boxright">


</div>


</div>





</div>

</body>
</html>