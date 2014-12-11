<?php session_start(); 
include('cjcuweb_lib.php');
if(!isset($_SESSION['username']) || $_SESSION['level'] != $level_teacher) {
 	echo "No permission";
 	exit; 
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<style type="text/css">
#detail_column{
	padding-left: 40px;
}
.td1{
	font-size: 17px;
	font-weight: bolder;
    width: 100px;
    overflow: hidden;
}
.td2{
    padding-top: 5px;
    padding-bottom: 5px;
}

</style>

<body>
尚未與交換機整合<br>
目前使用測試機的舊資料表
</body>
</html>
