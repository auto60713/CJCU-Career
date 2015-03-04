
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>求助</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/full_height.js"></script>
	<style type="text/css">
	    .fix-position{
	    	margin-top: 5%;
	    	padding: 30px;
	    	margin-right: auto;
	    	margin-left: auto;
	    	width: 50%;
	    	background-color: #FFFFFF;
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
	    	padding: 5px;
	    }
	    .success{
            background-color: #ABE19D;
	    }
        .fail{
            background-color: #FF8080;
        }
	</style>
	<script>
	$(function(){ 	

		$('#view-header').load('public_view/header.php');


		$( ".submit-btn" ).click(function() {

			var mail_address = $('#input-mail').val();
			$(".success").fadeIn().text('資料處理中..');

			$.ajax({
					url:  'send_email.php',
					type: 'POST',
					data: {mode:1,mail_address:mail_address},
					success: function(data) {
                        if(data=="success") { 
                        	$(".fail").css( "display", "none" ); 
                        	$(".success").fadeIn().text('寄信成功! 請到信箱確認');
                        }
	                    else{
	                    	$(".success").css( "display", "none" ); 
	                    	$(".fail").fadeIn().html(data);
	                    }
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

    <div class="apply-echo success"></div><div class="apply-echo fail"></div>
    <h1>登入有問題嗎?</h1>
    <p>請輸入您註冊的電子郵件地址，我們會寄送說明給您，協助您解決問題。</p><br>
    <h4>註冊的電子郵件</h4>
	<input id="input-mail" type="text" name="mail" placeholder="someone@example.com"/><br>

	<div class="submit-btn">傳送電子郵件</div>

	<br>
	<span>或是請洽詢職涯發展組電話06-2785123分機1821~1823</span>


</div></div>
</div>



</body>



<script>
   
</script>

</html>