<? session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>您的公司</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/company_manage.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="js/jquery.hashchange.min.js"></script>
	<script>
	$(function(){

		$('#view-header').load('public_view/header.php #header');


		$(window).hashchange( function(){

		  	var loc = location.hash.replace( /^#/, '' );
		  	switch(loc) {
			case 'company-info':doajax(0);break;
			case 'company-addwork':doajax(1);break;
			case 'company-work':doajax(2);break;
			case 'company-notice':doajax(3);break;
			default:doajax(0);
			}

		});

		$(window).hashchange();



		function doajax(idx){

				$('.list').removeClass('list-active');
				$('.list:eq('+idx+')').addClass('list-active');
				$('#right-box-title').text($('.list:eq('+idx+')').text());

				switch(idx) {
				// company info
				case 0:
				tpe = 'get';
				para = { companyid: <? echo "\"".$_SESSION['username']."\"" ?> };
				url = "company_detail_edit.php";
				break;
				// add work
				case 1:
				tpe = 'get';
				para = {};
				url = "add_work.php";
				break;
				// manage work
				case 2:
				tpe = 'get';
				para = {};
				url = "company_work_list.php";
				break;
				// notice
				case 3:
				tpe = 'get';
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


	});
	</script>
</head>


<body>
<div id="view-header"></div>


<div class="div-align overfix">

	<div id="" class="left-box" >
		<h2><? echo $_SESSION['username'] ?></h2><br><hr>
		<a href="#company-info"><div class="list">公司資訊</div></a><hr>
		<a href="#company-addwork"><div class="list">新增工作</div></a><hr>
		<a href="#company-work"><div class="list">管理工作</div></a><hr>
		<a href="#company-notice"><div class="list">通知</div></a><hr>
	</div>


	<div id="" class="right-box">
		<h2 id="right-box-title"></h2>
		<br>
		<div id="contailer-box"></div>
	</div>


	
</div>



</body>

</html>