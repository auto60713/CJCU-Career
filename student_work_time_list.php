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
var more = "";
    <?php  //load data
        include_once("js_work_detail.php"); echo_work_time_list_array($_GET['workid'],$_GET['studid']);
        if($_SESSION['level'] != 3) echo "$('#ctrl_bar').remove(); more='&view=1';";
	?>

if(work_time_list_array.length!=0){
    for(var i=0;i<work_time_list_array.length;i++){

        var icon = $('<i>').addClass('fa fa-newspaper-o'),
            a_page = $('<a>').attr('href', 'student_work_time.php?studid='+work_time_list_array[i]['stud_id']+'&listid='+work_time_list_array[i]['no']+more).addClass('list-name');
            a_page.append(icon,work_time_list_array[i]['year']+'年'+work_time_list_array[i]['month']+'月的工讀單');
        $('#work_time_list').append(a_page,$('<br>'));
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





});
</script>

</html>