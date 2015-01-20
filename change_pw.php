<?php session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>密碼修改</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="lib/jquery.validate.js"></script>
	<style type="text/css">
	    .fix-position{
	    	margin-top: 4%;
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
	    	margin-top: 10px;
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
        #commentForm{
        	margin-top: 15px;
        }

        .title{
        	font-size: 30px;
        	font-weight: bold;
        	margin-right: 10px;
        }
        .sign{
        	font-size: 13px;
        	color: #626262;
        }
	</style>
	<script>
	$(function(){ 	

		$('#view-header').load('public_view/header.php');


		$( ".submit-btn" ).click(function() {

            var old_pw = $('#old_pw').val(),
                new_pw = $('#new_pw').val();
                new_pw2 = $('#new_pw2').val();

            if(new_pw!=new_pw2){
				$(".success").css( "display", "none" ); 
	            $(".fail").fadeIn().text('兩次新密碼不同');
			}
			else{

			$.ajax({
					url:  'change_pw_apply.php',
					type: 'POST',
					data: {old_pw:old_pw,new_pw:new_pw},
					success: function(data) {
                        if(data=="success") { 
                        	document.location.href="logout.php?mode=1";
                        }
	                    else{
	                    	$(".success").css( "display", "none" ); 
	                    	$(".fail").fadeIn().text(data);
	                    }
                    }
		    });
            }
        });


	})
	</script>
    
</head>
<body>


<!-- 版頭 -->
<div id="view-header" class="" _height="none"></div>

<!-- content  -->
<div class="container margin-top20"><div class="fix-position">

    <div class="apply-echo success"></div><div class="apply-echo fail"></div>
    <span class="title">修改密碼</span><span class="sign">密碼長度限制20個字元以內</span>

    <table id="commentForm">                            
        <tr><td>舊密碼：</td>            <td><input type="password" name="old_pw" id="old_pw"/></td></tr>
        <tr><td>新密碼：</td>            <td><input type="password" name="new_pw" id="new_pw"/></td></tr>
        <tr><td>再輸入一次新密碼：</td>  <td><input type="password" name="new_pw2" id="new_pw2"/></td></tr>
    </table>
	<div class="submit-btn">確定修改</div>

</div></div>

</body>

</html>