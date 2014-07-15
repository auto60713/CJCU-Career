<? session_start(); 
if(isset($_SESSION['username'])) 0; else{header("Location: home.php"); exit;}
?>

<!doctype html>
<html>
<head>

	<script><? include_once("js_detail.php"); echo_department_detail($_SESSION['username']); ?></script>
</head>

<body>
<script>


		var detail_column = "",idx = 0;
		//column_name array必須優化成json格式 不然目前依賴index順序
		var column_name = ["帳號","中文名稱","英文名稱","電話","傳真","負責人","信箱","辦公室","簡介","網站連結"];

		for(var key in department_detail_array){
			
			detail_column+="<tr><td style='padding-right:60px;'>"+column_name[idx]+"</td>";
			detail_column+="<td><input type='text' name ='"+key+"' value='"+department_detail_array[key]+"'></td></tr>";
			idx++;
		}	

		$('#detail_column').html(detail_column);
</script>


<form method="post" action="updata.php" id="detail">
    <table id="detail_column"></table><br>
    <input type="submit" value="資料修改">
</form>

</body>
</html>
