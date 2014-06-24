<? session_start(); 
if(isset($_SESSION['username'])) 0; else{header("Location: home.php"); exit;}
?>

<!doctype html>
<html>
<head>
	<script><? include_once("js_department_detail.php"); echo_department_detail_array($_SESSION['username']); ?></script>
</head>

<body>
<script>


		var detail_column = "",detail_input = "",idx = 0;
		//column_name array必須優化成json格式 不然目前依賴index順序
		var column_name = ["帳號","名稱","地址","電話"];

		for(var key in department_detail_array){
			
			//資料的敘述
			detail_column+=column_name[idx]+"<br>";
			
			//資料的內容
            detail_input+=department_detail_array[key]+"<br>";
            
			idx++;
		}	


		//把資料倒進相對的位置
		$('#detail_column').html(detail_column);
		$('#detail_input').html(detail_input);
	


</script>



<div class="workedit-content" id='workedit-content'>
	<div id='workedit-content-edit' class="" tabtoggle='workedit2'>
		<form method="post" action="updata.php" id="detail">
            <div id="detail_column" style="float:left; padding-right:50px;">321</div>
            <div id="detail_input"></div>
		</form>
	</div>
</div>


</body>
</html>
