<?php session_start(); 

?>
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
	<script src="lib/jquery.validate.js"></script>
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
                        	$(".fail").css( "display", "none" ); 
                        	$(".success").fadeIn().text('修改成功');
                        	$("input").val('');
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
    <h1>修改密碼</h1>

    <table id="commentForm">                                                        
        <tr><td>舊密碼：</td>            <td><input type="password" name="old_pw" id="old_pw"/></td></tr>
        <tr><td>新密碼：</td>            <td><input type="password" name="new_pw" id="new_pw"/></td></tr>
        <tr><td>再輸入一次新密碼：</td>  <td><input type="password" name="new_pw2" id="new_pw2"/></td></tr>
    </table>
	<div class="submit-btn">確定修改</div>

</div></div>

</body>

</html>