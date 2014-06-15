<? session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>帳戶管理</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/company_manage.css">
	<link rel="stylesheet" type="text/css" href="css/work_detail_edit.css">
	<link rel="stylesheet" type="text/css" href="css/company_worK_apply_list.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="js/jquery.hashchange.min.js"></script>
	<script>
	$(function(){

		$('#view-header').load('public_view/header.php');


		$(window).hashchange( function(){
			ctu=false;
		  	var loc = location.hash.replace( /^#/, '' );
		  	switch(loc) {
			case 'teacher-info':doajax(0);break;
			case 'teacher-addwork':doajax(1);break;
			case 'teacher-work':doajax(2);break;
			case 'teacher-sup':doajax(3);break;
			case 'teacher-notice':doajax(4);break;
			default:doajax(0);
			}

		});


		function doajax(idx){

			switch(idx) {

				case 0:
				tpe = 'get';
				para = { userid: <? echo "\"".$_SESSION['username']."\"" ?> };
				url = "teacher_detail.php";
				break;

                // add work
				case 1:
				tpe = 'get';
				para = {mode:'add'};
				url = "add_work.php";
				break;

				case 2:
				tpe = 'get';
				para = {};
				url = "company_work_list.php";
				break;
		
	        	case 3:
				tpe = 'get';
				para = {};
				url = "teacher_sup.php";
				break;

				case 4:
				tpe = 'post';
				para = {level: <? echo "'".$_SESSION['level']."'"; ?>,username: <? echo "'".$_SESSION['username']."'"; ?>};
				url = "notice.php";	
				break;
			}

			$.ajax({
			  type: tpe,
			  url: url,
			  data: para,
			  success: function (data) { $('#contailer-box').html(data) ;  }
			});

		
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


<div class="div-align overfix">

	<div id="" class="left-box" >
		<h2><? echo $_SESSION['username'] ?></h2><br><hr>

		<a href="#teacher-info"><div class="list">個人資訊</div></a><hr>
		<a href="#teacher-addwork"><div class="list">新增工作</div></a><hr>
		<a href="#teacher-work"><div class="list">管理工作</div></a><hr>
	    <a href="#teacher-sup"><div class="list">實習監督</div></a><hr>
		<a href="#teacher-notice"><div class="list">通知</div></a><hr>
	</div>


	<div id="" class="right-box">
		<h2 id="right-box-title"></h2>
		<br>
		<div id="contailer-box"></div>
	</div>
	
	
	
</div>



</body>

</html>