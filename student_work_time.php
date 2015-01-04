<?php session_start(); header("Content-Type:text/html; charset=utf-8");

if(!isset($_SESSION['username'])) { echo "您無權訪問該頁面!"; exit; }
else if($_GET['workid']==null) { echo "錯誤的操作!"; exit; }
?>

<!doctype html>
<html>
<head>
    <title>工讀單</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script>
    window.jQuery || document.write('<script src="http://code.jquery.com/jquery-1.11.0.min.js"><\/script>')
    </script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.timepicker.js"></script>

</head>
<style type="text/css">
.column{
	display: inline;
}
#work_time_list{
	margin-bottom: 20px;
}
#work_time_list td{
	min-width: 40px;
	text-align: center;
	overflow: hidden;
}
#work_time_list td input{
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
div.ui-datepicker,.ui-timepicker-wrapper{
 font-size:10px;
}
</style>
<body>
    <h5 id="loading">資料載入中請稍後...</h5>
    <div class="work_time_detail" style="display:none;">
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
            	<td>日期</td><td>星期</td><td>開始時間</td><td colspan="2">服務內容</td><td>時數</td>
            </tr>
            <tr class="key-in">


                <input type="hidden" name="work_id" value="<?php echo $_GET['workid']; ?>">
                <td><input type="text" val="" name="work_date" id="work_date" placeholder="選擇日期"/></td>
                <td><input type="text" val="" name="work_day" id="work_day" placeholder="" disabled="disabled"/></td>
                <td><input type="text" val="" name="work_time" id="work_time" placeholder="選擇時間"/></td>
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
$( document ).ready(function() {
    $( "#loading" ).remove();
    $( ".work_time_detail" ).fadeIn();

});

$(function(){	

    
    <?php  //load data
		include_once("js_detail.php"); echo_student_profile($_GET['studid']); 
        include_once("js_work_detail.php"); echo_work_detail_array($_GET['workid']);
                                            echo_work_time_array($_GET['workid'],$_GET['studid']);
	?>

    $( "#work_date" ).on('focus', function(){
        $(this).datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    $( "#work_date" ).change(function() {
        var date = $(this).datepicker('getDate');
        switch(date.getUTCDay()) {
        case 0:
            var day="一";
        break;
        case 1:
            var day="二";
        break;
        case 2:
            var day="三";
        break;
        case 3:
            var day="四";
        break;
        case 4:
            var day="五";
        break;
        case 5:
            var day="六";
        break;
        case 6:
            var day="日";
        break;
        } 
        $( "#work_day" ).val( day );
    });

    var list_time = parseInt(work_detail_array['start_date'].split("-")[0])-1911;
    $('#stu_class').text(student_profile_array['dm_name']+student_profile_array['sd_grade']+student_profile_array['cla_name']);
    $('#stu_name').text(student_profile_array['sd_name']);
	$('#stu_no').text(student_profile_array['sd_no']);
        
    $('#list_name').text(work_detail_array['name']);
    $('#list_time').text(list_time);

   
    //時間API
    $('#work_time').timepicker({ 
        'timeFormat': 'H:i',
        'step': 60,
        'minTime': '6:00',
        'maxTime': '23:00',
    });
    

    for(var i=0;i<work_time_array.length;i++){

    var work_date = $('<td>').text(work_time_array[i]['date']),
        work_day = $('<td>').text(work_time_array[i]['day']),
        work_time = $('<td>').text(work_time_array[i]['time']),
        work_matter = $('<td>').text(work_time_array[i]['matter']).attr("colspan","2"),
        work_hour = $('<td>').text(work_time_array[i]['hour']),
        delet_btn = $('<button>').attr({type:"button",name:"delet_btn",value:work_time_array[i]['no']}).text("刪除"),
        delet = $('<td>').addClass('delet-tb').append(delet_btn),
        tr = $('<tr>').addClass('detail').append(work_date,work_day,work_time,work_matter,work_hour,delet);

        $(tr).insertBefore( '.key-in' );
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