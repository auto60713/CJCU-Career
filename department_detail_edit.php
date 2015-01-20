<?php session_start(); 
if(!isset($_SESSION['username'])) { header("Location: index.php"); exit; }
?>

<!doctype html>
<html>
<head>

	<script><?php include_once("js_detail.php"); echo_department_detail($_SESSION['username']); ?></script>
</head>
<style type="text/css">
form{
	padding-left: 20px;
}
.td1{
	font-size: 17px;
	font-weight: bolder;
    width: 80px;
    overflow: hidden;
}
.td2{
    padding-top: 5px;
    padding-bottom: 5px;
}
textarea {
   resize: none;
}
</style>
<body>
<script>


		var detail_column = "",idx = 0;
		//column_name array必須優化成json格式 不然目前依賴index順序
		var column_name = ["帳號","中文名稱","英文名稱","電話","傳真","系主任","電子信箱","辦公室","簡介","網站連結"];

		for(var key in department_detail_array){

			detail_column+="<tr><td class='td1'>"+column_name[idx]+"</td>";

            //不可修改的資料 背後PHP不要POST
			if(key == "no"){
                detail_column+="<td class='td2'><input type='text' name ='"+key+"' value='"+department_detail_array[key]+"' disabled='disabled'></td></tr>";
			}
			else if(key == "introduction"){
                detail_column+="<td class='td2'><textarea rows='3' cols='30' name='"+key+"'>"+department_detail_array[key]+"</textarea></td></tr>";
			}
		    else{
                detail_column+="<td class='td2'><input type='text' name ='"+key+"' value='"+department_detail_array[key]+"'></td></tr>";
		    }
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
