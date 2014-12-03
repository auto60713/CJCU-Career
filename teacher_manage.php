<? session_start();
if(!isset($_SESSION['username']) || $_SESSION['level'] != 2) { header("Location: home.php"); exit; }
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>帳戶管理</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/manage.css">
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
		  	case 'teacher-info':case'':doajax(0);break;
			case 'teacher-match':doajax(1);break;
			default:doajax(0);
			}

		});

        $(window).hashchange();

		function doajax(idx){

			$('#right-box-title').html('載入中...請稍後');

			switch(idx) {

                case 0:
				tpe = 'get';
				para = {};
				url = "teacher_detail_edit.php";
				break;

	        	case 1:
				tpe = 'get';
				para = {};
				url = "teacher_match.php";
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

			
		}

	});

	</script>
</head>


<body>
<div id="view-header"></div>


<div class="b-space div-align overfix">

	<div id="" class="left-box" >
		<h2><? echo $_SESSION['username'] ?></h2><br><br><hr>

		<a href="#teacher-info"><div class="list">個人資訊</div></a><hr>
	    <a href="#teacher-match"><div class="list">實習列表</div></a><hr>
	</div>


	<div id="" class="right-box">
		<h2 id="right-box-title"></h2>
		<br>
		<div id="contailer-box"></div>
	</div>
	
	
	
</div>



</body>

</html>