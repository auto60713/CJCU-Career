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
</head>
<style type="text/css">
a{
    cursor: pointer;
}
#work_time_list{
    padding-bottom: 20px;
}
.list-name{
    font-size: 24px;
    font-weight: bold;
}
.fa{
    margin-right: 10px;
}
.nodata-timelist{
    margin: 10%;
    color: #A9A9A9;
    font-style: oblique;
}
.delete-btn{
    position: absolute;
    margin: 5px;
    cursor: pointer;
    opacity: 0.6;
}
.delete-btn:hover{
    opacity: 1;
}
</style>
<body>
   
    <div id="work_time_list">
    </div>

    <div id="ctrl_bar">
    <p>新增一份工讀單</p>
    <input type="text" val="" class="input-year"  placeholder="輸入民國年"/><span>年</span>
    <input type="text" val="" class="input-month" placeholder="輸入月份"/><span>月</span>
    <button type="button" id="creat_time_page">新增</button> 
    </div>
</body>

<script>
$(function(){	
var more = "",links = "#timelist";
    <?php  //load data
        include_once("js_work_detail.php"); echo_work_time_list_array($_GET['workid'],$_GET['studid']);
        if($_SESSION['level'] != 3) echo "$('#ctrl_bar').remove(); more='&view=1';";
	?>

if(work_time_list_array.length!=0){
    for(var i=0;i<work_time_list_array.length;i++){

    <?php if($_SESSION['level'] != 3) echo "links='student_work_time.php?studid='+work_time_list_array[i]['stud_id']+'&listid=';"; ?>

            switch(work_time_list_array[i]['check']) {
                case 2:
                    var check_echo = "工讀單已批准"; break;
                default:
                        check_echo = "未審核";
            } 

        var icon = $('<i>').addClass('fa fa-newspaper-o'),
            delete_btn = $('<i>').attr({'id':'ctrl_bar','listno':work_time_list_array[i]['no']}).addClass('fa fa-times').addClass('delete-btn list-name'),
            check = $('<span>').text('審核狀態：'+check_echo),
            a_page = $('<a>').attr('href', links+work_time_list_array[i]['no']+more).addClass('list-name');
            a_page.append(icon,work_time_list_array[i]['year']+'年'+work_time_list_array[i]['month']+'月的工讀單');
        $('#work_time_list').append(a_page,check,delete_btn,$('<br>'));
    }
}
else $('#work_time_list').append( $('<span>').text('沒有任何工讀單').addClass('nodata-timelist') );


    $( "#work_time_list p" ).click(function() {
        var list_no = $( this ).attr('list');
    });

    $( "#creat_time_page" ).click(function() {
        var year = $( ".input-year" ).val(),
            month = $( ".input-month" ).val(),
            work_id = <?php echo '"'.$_GET['workid'].'",'; ?>
            stud_id = <?php echo '"'.$_GET['studid'].'";'; ?>

        $.ajax({
          type: 'POST',
          url: 'student_work_time_req.php',
          data: {mode:'time-list',work_id:work_id,stud_id:stud_id,year:year,month:month},
          success: function (data) { if(data=='Success') location.reload(); }
        });
    });

    //刪除
    $( ".delete-btn" ).click(function() {
        list_no = $( this ).attr('listno');

        $.ajax({
          type: 'POST',
          url: 'delete.php',
          data: {mode:3,no:list_no},
          success: function (data) { if(data=='Success') location.reload(); }
        });
    });



});
</script>

</html>