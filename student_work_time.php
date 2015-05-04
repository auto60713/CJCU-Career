<?php session_start(); header("Content-Type:text/html; charset=utf-8");

if(!isset($_SESSION['username'])) { echo "您無權訪問該頁面!"; exit; }
else if($_GET['listid']==null) { echo "錯誤的操作!"; exit; }
?>

<!doctype html>
<html>
<head>
    <title>工讀單</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link type="text/css" rel="stylesheet" href="css/jquery.timepicker.css" />
    <script>
    window.jQuery || document.write('<script src="http://code.jquery.com/jquery-1.11.0.min.js"><\/script>')
    </script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.timepicker.js"></script>

</head>
<style type="text/css">
.work_time_detail{
    width: auto;
}
.column{
	display: inline;
}
#work_time_list td{
	min-width: 40px;
    height: 30px;
	text-align: center;
	overflow: hidden;
}
#work_time_list td .full-input{
	width: 100%;
}
#work_time_list td .short-input{
    width: 55px;
}
.work-time-td{
    width: 140px;
}
.input{
	color: #008ACC;
	font-weight: bold;
}
.detail{
    color: #008ACC;
    font-weight: bold;
}
.no-border{
    border: 0px solid black;
}
div.ui-datepicker,.ui-timepicker-wrapper{
 font-size:10px;
}

.align{
    margin-right: auto;
    margin-left: auto;
}
.work_time_detail span.title{
    display: inline-block;
    width: 100%;
    font-size: 22px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 3px;
}
.pay-type{
    width: 590px;
    margin-bottom: 3px;
}
.pay-type span{
    margin-right: 30px;
    margin-left: 30px;

}
.experience{
    width: 95%;
}
.experience hr{
    opacity: 0.6;
    margin-top: 2px; 
    margin-bottom: 2px; 
}
#work_time_list{
    margin-bottom: 5px;
}
.nodata-timelist{
    margin: 10%;
    color: #A9A9A9;
    font-style: oblique;
}
#review{
    margin-top: 10px; 
    margin-bottom: 10px; 
}
.pass-WTL{
    float: right;
}
#back{
    margin-bottom: 20px; 
}
.review-echo{
    margin: 5px;
    font-size: 12px;
    font-style: italic;
    color: #565656;

}

</style>
<body>
    <h5 id="loading">資料載入中請稍後...</h5>

    <div class="work_time_detail" style="display:none;">
        <input type="button" name="button" id="back" value="上一頁">
        <span class="title is_setting">長榮大學學生服務助學時數暨表現稽核表</span>
        <div class="pay-type align is_setting">
            <span><input type="checkbox">服務助學(工讀)金</span>
            <span><input type="checkbox">生活助學金</span>
            <span><input type="checkbox">助學生服務學習</span>
        </div>
        <form method="post" action="student_work_time_req.php" id="form_check">
        <!--隱藏資訊 表id跟模式-->
        <input type="hidden" name="list_no" value="<?php echo $_GET['listid']; ?>">
        <input type="hidden" name="mode"    value="time"/>

    	<table id="work_time_list" border="2">
            <tr class="is_setting">
            	<td>系所班級</td>  <td class="input" id="stu_class"></td>
            	<td>姓名</td>      <td class="input" id="stu_name"></td>
            	<td>學號</td>      <td class="input" id="stu_no"></td>
                <td>服務年/月</td> <td class="input" id="list_time"></td>
            </tr>
            <tr class="is_setting">
                <td>身分欄勾選</td>
                <td colspan="3"><input type="checkbox">曾接受服務助學(工讀)訓練研習</td>
                <td colspan="4"><input type="checkbox">曾接受志工基礎(或特殊)訓練</td>
            </tr>
            <tr>
                <td>工作名稱</td><td colspan="3" class="input" id="list_name"></td><td colspan="4" class="is_setting">第一次銀行帳號：______________________</td>
            </tr>
            <tr class="header">
            	<td>日期</td><td>星期</td><td>起止時間</td><td colspan="4">服務內容</td><td>時數</td>
            </tr>
            <tr class="key-in">

                <td><input type="text" value="" name="work_date"    id="work_date" class="full-input"placeholder="選擇日期"/></td>
                <td><input type="text" value="" name="work_day"     id="work_day"  class="full-input"placeholder="自動產生"/></td>
                <td class="work-time-td">
                    <input type="text" value="" name="work_bg_time" class="short-input"placeholder="開始時間"/>
                    <a>~</a>
                    <input type="text" value="" name="work_ed_time" class="short-input"placeholder="結束時間"/>
                </td>
                <td colspan="4">
                    <input type="text" value="" name="work_matter" class="full-input"placeholder="請輸入"/></td>
                <td><input type="text" value="" name="work_hour"   class="full-input"placeholder="自動產生"/></td>
                <td class="delet-tb no-border"><input type="submit" name="button" value="新增"/></td>
            </tr>
            <tr style="font-weight: bold;">
                <td colspan="6" class="check-bar"></td><td>助學總時數</td><td><span class="total-hour"></span></td>
            </tr>
        </table>
    <div class="is_setting">
        <div class="experience align">
            <span style="font-weight: bold;">服務心得反思：</span>
            <span style="font-size: 14px;">(約50~100個字，注意禮貌、文字工整，勿用鉛筆)</span>
            <div id="review"></div>
        </div>
        <table id="work_time_list" border="2" style="width:99%">
            <tr>
                <td style="width:20%">單位對助學生<br>服務表現評分</td><td style="width:35%"></td>
                <td style="width:15%">服務績效</td><td style="width:30%"></td>
            </tr>
            <tr style="font-weight: bold;">
                <td colspan="2">單位承辦人</td><td colspan="2">單位主官簽章</td>
            </tr>
            <tr style="height:40px;">
                <td colspan="2"></td><td colspan="2"></td>
            </tr>
       </table> 
    </div>

        <div class="delet-tb">
        <textarea rows="2" cols="60" class="review-input" placeholder="請填寫工作心得"></textarea><span class="review-echo"></span><br>
        <input type="text" value="" id="now_hour_pay" placeholder="填入時薪自動換算"/> <span class="total-pay"></span>
        </div><br>

        <input type="button" name="button" id="view" value="預覽">
        </form>
    </div>
</body>

<script>
$( document ).ready(function() {


    $(window).keydown(function(event){
    if(event.keyCode == 13) {

        $('#form_check').submit(function(ev) {
            ev.preventDefault(); 
        });
    }
    });


    $( "#loading" ).remove();
    $( ".work_time_detail" ).fadeIn();

});

$(function(){	

    
    <?php  //load data
		include_once("js_detail.php"); echo_student_profile($_GET['studid']); 
        include_once("js_work_detail.php"); //echo_work_detail_array($_GET['workid']);
                                            echo_work_time_array($_GET['listid']);
	?>

    $( "#work_date" ).datepicker({
            dateFormat: 'yy-mm-dd'
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

    $('#stu_class').text(student_profile_array['dm_name']+student_profile_array['sd_grade']+student_profile_array['cla_name']);
    $('#stu_name').text(student_profile_array['sd_name']);$('title').text(student_profile_array['sd_name']+'的工讀單');
	$('#stu_no').text(student_profile_array['sd_no']);
        
    $('#list_name').text( echo_work_name );
    $('#list_time').text( echo_work_date );


    //時間API
    $('input[name="work_bg_time"]').timepicker({ 
        'timeFormat': 'H:i',
        'step': 60,
        'minTime': '8:00',
        'maxTime': '17:00'
    });
    //開始時間牽制結束時間
    $('input[name="work_bg_time"]').change(function() {
        var mintime = parseInt($(this).val().split(':')[0]);
        $('input[name="work_ed_time"]').timepicker('option', 'minTime', mintime+':00');
        $('input[name="work_ed_time"]').timepicker('option', 'maxTime', (mintime+4)+':00');
    });

   
    $('input[name="work_ed_time"]').timepicker({ 
        'timeFormat': 'H:i',
        'step': 60,
    });
    //結束時間決定總時數
    $('input.short-input').change(function() {
        var work_bg_time = parseInt($('input[name="work_bg_time"]').val().split(':')[0]),
            work_ed_time = parseInt($('input[name="work_ed_time"]').val().split(':')[0]),
            work_hour = work_ed_time - work_bg_time;
        if(work_bg_time<=12 && work_ed_time>12) work_hour -= 1;
        if(work_hour>=0) $('input[name="work_hour"]').val(work_hour);
        else $('input[name="work_hour"]').val(0);
    });

if(work_time_array.length!=0){
    for(var i=0;i<work_time_array.length;i++){

    var work_date = $('<td>').text(work_time_array[i]['date']),
        work_day = $('<td>').text(work_time_array[i]['day']),
        work_time = $('<td>').text(work_time_array[i]['bg_time']+'~'+work_time_array[i]['ed_time']),
        work_matter = $('<td>').text(work_time_array[i]['matter']).attr("colspan","4"),
        work_hour = $('<td>').text(work_time_array[i]['hour']).addClass('work-hour'),
        delet_btn = $('<button>').attr({type:"button",name:"delet_btn",value:work_time_array[i]['no']}).text("刪除"),
        delet = $('<td>').addClass('delet-tb no-border').append(delet_btn),
        tr = $('<tr>').addClass('detail').append(work_date,work_day,work_time,work_matter,work_hour,delet);

        $(tr).insertBefore( '.key-in' );
    }
}
else {
    var nodata_timelist = $('<span>').addClass('nodata-timelist').text('此張工讀單為空白');
    $('<tr>').append( $('<td>').attr("colspan","8").append(nodata_timelist) ).insertBefore( '.key-in' );
}

    
    var total_hour = 0;
    for(i=0;i<$( ".work-hour" ).length;i++){

        total_hour += parseInt($( ".work-hour:eq("+i+")" ).text());
    }
    $( ".total-hour" ).append(total_hour); $( ".total-pay" ).text('總時薪：??');

    $( "#now_hour_pay" ).change(function() {
        var now_hour_pay = $( "#now_hour_pay" ).val();
        $( ".total-pay" ).text('總時薪：'+total_hour*now_hour_pay+'元');
    });

   
    //更新心得
    $( ".review-input" ).focus(function() {
        $(".review-echo").text("按下Tab自動更新");
    }).focusout(function() {
        $(".review-echo").text("");
    })
    $( ".review-input" ).change(function() {
        var review = $(".review-input").val();

        $.ajax({
          type: 'POST',
          url: 'ajax_something.php',
          data: {mode:1,listno:<?php echo $_GET['listid']; ?>,review:review},
          success: function (data) { if(data=='Success') $(".review-echo").text("心得已經更新"); }
        });
       
    });


    $( "#view" ).click(function() {
        window.open("student_work_time.php?studid="+<?php echo "\"".$_GET['studid']."\"" ?>+"&listid="+<?php echo $_GET['listid']; ?>+"&view=1");
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

        $.ajax({
          type: 'POST',
          url:  'ajax_something.php',
          data: {mode:22,listno:<?php echo $_GET['listid']; ?>},
          success: function (data) { 

            switch(data.split("*.*")[0]) {
                case "1":
                var check_echo = "審核狀態：未審核";
                <?php if($_SESSION['level']!=3) echo "$('.check-bar').append( $('<button>').attr('type','button').attr('onclick','pass_WTL()').addClass('pass-WTL').text('確認審核此工讀單') );"; ?> 
                break;
                case "2":
                    check_echo = "審核狀態：通過";
                break;

            } 

            $('.check-bar').append(check_echo); 
            $('#review').html(data.split("*.*")[1]).append($('<hr>'));
          }
        });
    }
    else{
        $('.is_setting').remove();
        $('#list_name').attr('colspan','7');

        $.ajax({
          type: 'POST',
          url:  'ajax_something.php',
          data: {mode:2,listno:<?php echo $_GET['listid']; ?>},
          success: function (data) { $('.review-input').val(data); }
        });
    }

    $( ".work_time_detail" ).css('width',$( "#work_time_list" ).width()+10);
});



function pass_WTL() {
    $.ajax({
          type: 'POST',
          url: 'ajax_something.php',
          data: {mode:3,listno:<?php echo $_GET['listid']; ?>},
          success: function (data) { if(data=='Success') location.reload(); }
    });
}

</script>

</html>