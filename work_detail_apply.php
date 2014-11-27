<? session_start(); 

include("cjcuweb_lib.php");
include("sqlsrv_connect.php");


if(isset($_SESSION['username'])) $company_id = $_SESSION['username']; 
else{
	echo "No permission!"; 
	exit;
} 

if( !isCompanyWork($conn,$_SESSION['username'],$_GET['workid'])){
	echo 'No permission!';
	exit;
}

// 是否為該公司的工作
function isCompanyWork($conn,$companyid,$workid){
	$sql = "select company_id from work where id=?";
	$params = array($workid);
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$result = sqlsrv_query($conn,$sql,$params,$options);
	$row = sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC);
	if($row[0]==$companyid) return true;
	else return false;
}


?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <script><? include_once('js_work_detail_apply.php'); echo_work_apply_list_array($_GET['workid']);  ?>

    $(function(){
    	var body = $('#company-work-list-container');

    	// 如果有人應徵，清空列表區域，準備顯示
    	if(work_apply_list_array.length>0) body.html('');

    	for(var i=0;i<work_apply_list_array.length;i++){

            var img_src='http://esrdoc.cjcu.edu.tw/esr_photo/'+work_apply_list_array[i]['sd_syear'].trim()+'/'+work_apply_list_array[i]['user_id'].trim()+'.jpg',
    		    wimg = $('<img>').attr('src', img_src).addClass('work-img-apply'),
    			tita = $('<a>').attr({'target':'_blank','href':'student-'+work_apply_list_array[i]['user_id']}).text(work_apply_list_array[i]['name']),
    			doca = $('<a>').attr({'target':'_blank','href':'department-'+work_apply_list_array[i]['depno']}).append(work_apply_list_array[i]['depname']),

    			gear = $('<i>').addClass('fa fa-cog'),
    			auditbtn = $('<button>').addClass('staff-audit-btn2').append(gear).append(' 審核'),

    			subbox1 = $('<div>').addClass('sub-box').append(wimg),
    			subbox2 = $('<div>').addClass('sub-box').append($('<h1>').addClass('work-tit').append(tita))
    			.append($('<p>').addClass('work-hint').append(doca)),
    			subbox3 = $('<div>').addClass('sub-box2');

    			subbox3.on('click', {arr:work_apply_list_array[i]} ,function(event) {
					//event.data.arr['user_id']

						$('.staff-apply-form').remove();

						var hidden1 = $('<input>').attr({value: event.data.arr['user_id'], type:'hidden', id:'hidden_id'}),
							icon = $('<i>').addClass('fa fa-user'),
							tbox = $('<h1>').append(icon).append(' '+event.data.arr['user_id']).css('font-size', '28px'),
							close = $('<i>').addClass('fa fa-times').addClass('staff-apply-box-close'),
							span = $('<span>').text('審核說明：').css('color', '#444'),
							t = $('<textarea>').attr({id: 'staff-audit-apply-msg',placeholder:'選填'}),
							ok = $('<input>').attr({id: 'staff-audit-apply-ok', type: 'button',value :'通過'}).on('click', function(event) {
								submit_audit(true);
							}),
							no = $('<input>').attr({id: 'staff-audit-apply-no', type: 'button',value :'不通過'}).on('click', function(event) {
								submit_audit(false);
							}),
							errtext= $('<span>').attr('id', 'staff-audit-error'),
							gbtn = $('<div>').addClass('staff-apply-gbtn').append(errtext).append(ok).append(no),
							box = $('<div>').addClass('staff-apply-box').append(close).append(tbox).append("<hr><br>")
							.append(span).append("<br>").append(t).append("<br>").append(gbtn).append(hidden1),

							bg = $('<div>').addClass('staff-apply-form').append(box);

							close.click(function(event) {$('.staff-apply-form').remove();});

						$('body').append(bg);

				});


				switch(work_apply_list_array[i]['check']) {
					case 0:case 3:
						subbox3.append(auditbtn);break;
					case 1:
						subbox3.append($('<div>').addClass('isapply').text('已錄取'));break;
					case 2:
						subbox3.append($('<div>').addClass('isnotapply').text('不錄取'));break;	
				}	
			var mainbox = $('<div>').addClass('work-list-box').append(subbox1).append(subbox2).append(subbox3);
				body.append(mainbox);
    	}


    	function submit_audit(boo){

    		if(boo) txt = $('<div>').addClass('isapply').text('已錄取');
    		else txt = $('<div>').addClass('isnotapply').text('不錄取');

    		var userid= $('#hidden_id').val(), chk = boo? 1:2;
    		var msg = $('#staff-audit-apply-msg').val();
    		$.ajax({
					  type: 'post',
					  url: 'company_work_apply_user.php',
					  data: {check:chk, user: userid ,workid:<? echo $_GET['workid']; ?>,msg:msg} ,
					  befoerSend:function(){
					  	$('#staff-audit-apply-ok, #staff-audit-apply-no ,#staff-audit-apply-msg').attr('disabled', '');
					  },
					  
			}).done(function(data){
				console.log(data);
				if(data.split('-')[0]=='0'){
					alert('fail');
					$('#staff-audit-apply-ok, #staff-audit-apply-no ,#staff-audit-apply-msg').removeAttr('disabled');
				}
				else{
					subbox3.empty().append(txt);
					$('.staff-apply-form').fadeOut('fast', function() {	$(this).remove();});
				}
			});

    	}


    	
    });
    </script>
</head>
<body>
<!--
<div id='search-box'>
<input type='text' placeholder='搜尋應徵者名稱' id='search-txt'>
<input type="button" value="搜尋" id='search-btn'>
</div>-->
<h3>應徵者列表</h3>
<div id='company-work-list-container'>
	目前尚無人應徵！
</div>
</body>
</html>