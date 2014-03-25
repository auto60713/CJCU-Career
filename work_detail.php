<? session_start(); 
include_once("cjcuweb_lib.php");

if(isset($_GET['workid'])) $work_id=$_GET['workid']; else{header("Location: home.php"); exit;}
if(isset($_SESSION['username'])) $user_id = $_SESSION['username'];
 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>工作資料</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/work_detail.css">

	<!-- 取得公司資訊 -->
	<script><? include_once("js_work_detail.php"); echo_work_detail_array($work_id); ?></script>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>


<body>
<div id="view-header"></div>


<div class="div-align overfix">

	<div id="work_detail" class="work-box">
	<h1>工作內容<span id="work_edit">編輯</span></h1>

	</div>


	<div id="company_detail" class="work-company-box" >
		<h1>關於公司</h1>
		<p>ewewfewf</p>
		<p>ewewfewf</p>
		<p>ewewfewf</p>
		<p>ewewfewf</p>
		<p>ewewfewf</p>
	</div>
</div>

<?
	function isapplywork($user_id,$work_id){
		include("sqlsrv_connect.php");
		$sql="select count(user_id) from line_up where user_id=? and work_id=?";
        $params = array($user_id,$work_id);
        $result = sqlsrv_query($conn, $sql, $params);
        if($result){
        	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);   
        	if($row[0]==0) return true;
        	return false;
        }
        else return false;
	}
	// 如果身分為學生，印出給予應徵的按鈕
	if(isset($_SESSION['username']) && $_SESSION['level']==$level_student && isapplywork($user_id,$work_id)){
		echo '<br><br>';
		echo '<form name="getjobform" method="post" action="../../student_apply_job.php">';
		echo '<input type="hidden" name="work_id" value="'.$work_id.'" />';
		echo '<input type="submit" name="button" value="我要應徵" />';
		echo '</form>';
	}
?>





<script>
	$(function(){
		$('#view-header').load('../public_view/header.php #header');
		//w.name,w.date,w.company_id,one.name typeone,two.name typetwo,three.name typethree,w.start_date,w.end_date,
	    //prop.name popname,w.is_outside,z.name zonename,w.address,w.phone,w.pay,[recruitment _no],w.detail,[check]
		var html_detail = "",idx=0;
		var column_name = ["工作名稱","發布時間","所屬公司","工作分類1","工作分類2","工作分類3","應徵開始","應徵結束"
						,"工作性質","校內外工作","工作地點","詳細地址","連絡電話","薪資待遇","招募人數","詳細說明","通過審核"];
		

		var work_d = $('#work_detail');

		for(var key in work_detail_array){

			

			var h2_ele =  $('<h2>').text(column_name[idx]);
			var p_ele = $('<p>').attr({id: key}).text(work_detail_array[key]);
			var work_cell_ele = $('<div>').addClass('work-cell');
			work_cell_ele.append(h2_ele).append(p_ele);
			work_d.append(work_cell_ele);
			work_d.append($('<hr>'));
			idx++;
		}	
		
	});
</script>
</body>
</html>
