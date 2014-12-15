<?php session_start(); header("Content-Type:text/html; charset=utf-8");

if(!isset($_SESSION['username'])) { echo "您無權訪問該頁面!"; exit; }
else if($_GET['workid']==null) { echo "錯誤的操作!"; exit; }
?>

<!doctype html>
<html>
<head>
    <title>工讀單</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="js/jquery.js"></script>
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
	color: #008ACC;
	font-weight: bold;
}
.detail{
    color: #008ACC;
    font-weight: bold;
}
.delet-tb{
    border: 0px solid black;
}

</style>
<body>
    <div class="work_time_detail">
        <form method="post" action="student_work_time_req.php">
    	<table id="work_time_list" border="2">
            <tr>
            	<td>系所班級</td><td class="input" id="stu_class"></td>
            	<td>姓名</td>        <td class="input" id="stu_name"></td>
            	<td>學號</td>        <td class="input" id="stu_no"></td>
            </tr>
            <tr>
            	<td>工作名稱</td>    <td colspan="2" class="input" id="list_name"></td>
            	<td>服務年</td>   <td colspan="2" class="input" id="list_time"></td>
            </tr>

            <tr class="header">
            	<td>日期(月/日)</td><td>星期</td><td>起迄時間</td><td colspan="2">服務內容</td><td>時數</td>
            </tr>
            <tr class="key-in">

                <input type="hidden" name="work_id" value="<?php echo $_GET['workid']; ?>">
            	<td><input type="text" val="" name="work_date" placeholder="n/m"/></td>
            	<td><input type="text" val="" name="work_day" placeholder="一"/></td>
            	<td><input type="text" val="" name="work_time" placeholder="00:00~00:00"/></td>
    <td colspan="2"><input type="text" val="" name="work_matter" placeholder="請輸入"/></td>
            	<td><input type="text" val="" name="work_hour" placeholder="0"/></td>
                
            </tr>
        </table> 

    	<input type="submit" name="button" value="新增一筆紀錄" />　　
        <input type="button" name="button" id="view" value="預覽">
        <input type="button" name="button" id="back" value="上一頁">
        </form>
    </div>
</body>

<script>
$(function(){	

    
    <?php  //load data
		include_once("js_detail.php"); echo_student_profile($_GET['studid']); 
        include_once("js_work_detail.php"); echo_work_detail_array($_GET['workid']);
                                            echo_work_time_array($_GET['workid'],$_GET['studid']);
	?>

    var list_time = parseInt(work_detail_array['start_date'].split("-")[0])-1911;
    $('#stu_class').text(student_profile_array['dm_name']+student_profile_array['sd_grade']+student_profile_array['cla_name']);
    $('#stu_name').text(student_profile_array['sd_name']);
	$('#stu_no').text(student_profile_array['sd_no']);
        
    $('#list_name').text(work_detail_array['name']);
    $('#list_time').text(list_time);

    for(var i=0;i<work_time_array.length;i++){

    var work_date = $('<td>').text(work_time_array[i]['date']),
        work_day = $('<td>').text(work_time_array[i]['day']),
        work_time = $('<td>').text(work_time_array[i]['time']),
        work_matter = $('<td>').text(work_time_array[i]['matter']).attr("colspan","2"),
        work_hour = $('<td>').text(work_time_array[i]['hour']),
        delet_btn = $('<button>').attr({type:"button",name:"delet_btn",value:work_time_array[i]['no']}).text("刪除"),
        delet = $('<td>').addClass('delet-tb').append(delet_btn),
        tr = $('<tr>').addClass('detail').append(work_date,work_day,work_time,work_matter,work_hour,delet);

        $('#work_time_list').append(tr);
    }


    $( "#view" ).click(function() {
        window.open("student_work_time.php?studid="+<?php echo "\"".$_GET['studid']."\"" ?>+"&workid="+<?php echo $_GET['workid'];?>+"&view=1");
    });
    $( "#back" ).click(function() {
        location.replace('student_manage.php#student-applywork');
    });
    $( "button[name=delet_btn]" ).click(function() {
        //刪除此工讀項目
        $.ajax({
          type: 'POST',
          url: 'delete.php',
          data: {mode:2,no:$(this).val()},
          success: function (data) { if(data==1) location.reload(); }
        });
    });
    
    var view = "";
    <?php if(isset($_GET['view'])) echo "view = ".$_GET['view'].";"; ?>
    if(view == 1){
        $('.key-in, .delet-tb, input[name=button]').remove();

        $("td").css({ 
            "padding-left":"10px",
            "padding-right":"10px"
        });
        $(".detail td:eq(3)").css( "width","200px" );

    }
});
</script>
</html>