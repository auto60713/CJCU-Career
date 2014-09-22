
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>求助</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="js/full_height.js"></script>
	<style type="text/css">
	    .fix-position{
	    	padding: 30px;
	    	margin-right: auto;
	    	margin-left: auto;
	    	width: 90%;
	    }
	    .fix-position h1{
	    	line-height: 50px;
	    }
	    .fix-position input{
	    
	        margin-bottom: 10px;
	        width: 200px;
	    }
	    .submit-btn{
	    	text-align: center;
	    	background-color: #008A8A;
	    	color: #FFFFFF;
	    	cursor: pointer;
	    	width: 100px;
	    	padding: 5px;
	    }
	    .submit-btn:hover{
	    	background-color: #00B5B5;
	    }

	    .apply-echo{
	    	display: none;
	    	background-color: #FF8080;
	    	padding: 5px;
	    }

	</style>
	<script>
	$(function(){ 	

		$.ajax({
					url:  'public_view/header.php',
					type: 'POST',
					data: {},
					success: function(data) {
                        $('#view-header').html(data);
                    }
		});


		$( ".submit-btn" ).click(function() {

			var mail_val = $('#input-mail').val();

			$.ajax({
					url:  'forgotpwd_apply.php',
					type: 'POST',
					data: {mail:mail_val},
					success: function(data) {

						$(".apply-echo").fadeIn().text(data);
                    }
		    });

        });


	})
	</script>
    
</head>
<body>


<!-- 版頭 -->
<div id="view-header" class="" _height="none"></div>

<!-- content  -->
<div _height="auto">
<div class="container margin-top20"><div class="fix-position">

    <div class="apply-echo"></div>
    <h1>登入有問題嗎?</h1>
    <p>請輸入您註冊的電子郵件地址，我們會寄送說明給您，協助您解決問題。</p><br>
    <h4>註冊的電子郵件</h4>
	<input id="input-mail" type="text" name="mail" placeholder="someone@example.com"/><br>

	<div class="submit-btn">傳送電子郵件</div>


</div></div>
</div>



</body>



<script>
   
</script>

</html>