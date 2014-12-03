<? session_start(); header("Content-Type:text/html; charset=utf-8");

if(!isset($_SESSION['username'])) { echo "您無權訪問該頁面!"; exit; }
else if($_GET['workid']==null) { echo "錯誤的操作!"; exit; }
?>

<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<style type="text/css">
.column{
	display: inline;
}
table{
	margin-bottom: 20px;
}
td{
	min-width: 40px;
	text-align: center;
	overflow: hidden;
}
td input{
	width: 100%;
}
.input{
	color: #014DFE;
	font-weight: bold;
}
</style>
<body>
    <div class="work_time_detail">
    	<table border="2">
            <tr>
            	<td>系所年級班級</td><td class="input" id="stu_class"></td>
            	<td>姓名</td>        <td class="input" id="stu_name"></td>
            	<td>學號</td>        <td class="input" id="stu_no"></td>
            </tr>
            <tr>
            	<td>工作名稱</td>    <td colspan="2" class="input" id="list_name"></td>
            	<td>服務年/月</td>   <td colspan="2" class="input" id="list_time"></td>
            </tr>

            <tr class="header">
            	<td>日期(月/日)</td><td>星期</td><td>起迄時間(可複寫)</td><td colspan="2">服務內容</td><td>時數</td>
            </tr>
            <tr class="input">
            	<td><input type="text" val="" name="work_date" placeholder="請輸入"/></td>
            	<td><input type="text" val="" name="work_day" placeholder="請輸入"/></td>
            	<td><input type="text" val="" name="work_time" placeholder="請輸入"/></td>
    <td colspan="2"><input type="text" val="" name="work_thing" placeholder="請輸入"/></td>
            	<td><input type="text" val="" name="work_hour" placeholder="請輸入"/></td>

            </tr>
        </table> 

    	<input type="submit" name="button" value="新增一筆紀錄" />　　

    </div>
</body>

<script>
$(function(){	

    
    <?  //load data
		include_once("js_detail.php"); echo_student_profile($_SESSION['username']); 
        include_once("js_work_detail.php"); echo_work_detail_array($_GET['workid']);
	?>

    $('#stu_class').text(student_profile_array['dm_name']+student_profile_array['sd_grade']+student_profile_array['sd_class']);
    $('#stu_name').text(student_profile_array['sd_name']);
	$('#stu_no').text(student_profile_array['sd_no']);
        
    $('#list_name').text(work_detail_array['name']);
    $('#list_time').text(work_detail_array['start_date'].split(" ")[0]);









});
</script>
</html>