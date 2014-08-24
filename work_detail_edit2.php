<? session_start(); 
include_once('cjcuweb_lib.php');
include_once('sqlsrv_connect.php');
// 檢查該工作是否屬於該公司
if(!isCompanyWork($conn,$_SESSION['username'],$_POST['workid'])){
echo 'No permission!';
exit();
}

function isCompanyWork($conn,$companyid,$workid){

	$sql = "select company_id from work where id=?";
	$params = array($workid);
	$result = sqlsrv_query($conn,$sql,$params);
	$row = sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC);
	if($row[0]==$companyid) return true;
	else return false;
}
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/work_detail_edit.css?v=3">
	<script><? include_once("js_audit_detail.php"); echo_audit_detail_array($_POST['workid'],1); ?></script>
	<script>

	$(function(){

		// 該工作的詳細資料修改
		$.ajax({
		  type: 'get',
		  url: 'work_add.php',
		  async:false,
		  data: {mode:'edit',workid:  <?  echo (int)$_POST['workid']; ?> },
		  success: function (data) { $('#workedit-content-edit').html(data) ;  }
		});

		// 該工作的應徵者列表
		$.ajax({
		  type: 'get',
		  url: 'work_detail_apply.php',
		  data: {workid:  <?  echo (int)$_POST['workid']; ?> },
		  success: function (data) { $('#workedit-content-apply').html(data) ;  }
		});

		switch(work_detail_array.check) {
			case 0:
				icontxt ='fa fa-minus-square-o';
				statustxt = ' 未審核';
				color = '#555';
				break;
			case 1:
				icontxt ='fa fa-check';
				statustxt = ' 通過';
				color = '#339933';
				break;
			case 2 : case 3:
				icontxt ='fa fa-times';
				statustxt = ' 不通過';
				color = '#CC3333';
				break;
		}

		var audit_history_container = $('#company-audit-history');
		if(audit_array.length>0) audit_history_container.html('');
		for(var i=0;i<audit_array.length;i++){

			var icontxt2 = (audit_array[i].censored==1)? 'fa fa-check': 'fa fa-times',
				statustxt2 = (audit_array[i].censored==1)? ' 通過': ' 不通過',
				time = $('<span>').addClass('company-audit-time').text(audit_array[i].time.split(' ')[0]),
				icon = $('<i>').addClass(icontxt2),
				censored = $('<span>').addClass('company-audit-censored').append(icon).append(statustxt2),
				msg = $('<span>').addClass('company-audit-msg').text(audit_array[i].msg),
				vialink = $('<a>').attr('target','_blank').attr('href', 'staff/'+audit_array[i].staff_no).text(audit_array[i].staff_no),
				via = $('<span>').addClass('company-audit-via').append('審核者：').append(vialink),
				all = $('<div>').addClass('company-audit-list').append(time).append(censored)
				.append(msg).append(via);
				audit_history_container.append(all);
		}

		// this work's check
		
			var icon = icon = $('<i>').addClass(icontxt),
			again_txt = $('<span>').addClass('company-audit-again-txt').text('已要求再次審核！'),
			again_btn = $('<input>').addClass('company-audit-again').attr({
				value: '請求再次審核',
				type: 'button'
			}).on('click', function(event) {
				
				$.ajax({
					url: 'ajax_audit_again.php',
					type: 'post',
					data: {objid:<?  echo (int)$_POST['workid']; ?>},
				})
				.done(function(data) {
					if(data!='0') {
					$('.company-audit-status').append(again_txt);
					again_btn.remove();
					}
				});

			});

		$('.company-audit-status').append(icon).append(statustxt).css('color', color);
		if(work_detail_array.check==2) $('.company-audit-status').append(again_btn);
		if(work_detail_array.check==3) $('.company-audit-status').append(again_txt);



		// TAB Control
		var tabgroup = $('div[tabtoggle="workedit1"]');
		tabgroup.click(function(event) {
			tabgroup.removeClass('tab-active');
			$(this).addClass('tab-active');
			var index = tabgroup.index( this );
			$('div[tabtoggle="workedit2"]').removeClass('workedit-content-hide');
			$('div[tabtoggle="workedit2"]:not(div[tabtoggle="workedit2"]:eq('+index+'))').addClass('workedit-content-hide');
		});
		tabgroup[<?  echo (int)$_POST['page']; ?>].click();


        //刪除工作
        var delete_work = $('a.delete-work');
		delete_work.click(function(event) {
			//以後要做一個AJAX拿工作名字的
		    if (confirm ("確定要刪除此工作  ?")){

		    	$.ajax({
			     	type:"POST",
			     	url: "delete.php",
			     	data:{mode:0,workid:<? echo (int)$_POST['workid']; ?>},
                    success: function (data) { 
                    	if(data != 0){
                    		alert('刪除成功');
                	        window.location.href = data+'_manage.php#'+data+'-work';
                    	}
			      	    else alert('資料驗證不正確 無法刪除');
			      }
			    });
		    }
		});


	});


	</script>

</head>
<body>
	
<div class="workedit-tabbox">
	<div class="sub-tab tab-active" tabtoggle='workedit1'><i class="fa fa-pencil tab-img"></i> 編輯</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-user tab-img"></i> 應徵</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-check tab-img"></i> 審核</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-cog tab-img"></i> 設定</div>
</div>

<div class="workedit-content" id='workedit-content'>
	<!-- 該工作的資料編輯，AJAX別的畫面 -->
	<div id='workedit-content-edit' class="" tabtoggle='workedit2'></div>
	<!-- 該工作的應徵學生列表，AJAX別的畫面 -->
	<div id='workedit-content-apply' class="workedit-content-hide" tabtoggle='workedit2'></div>


	<!-- 該工作的審核狀態 -->
	<div id='workedit-content-audit' class="workedit-content-hide" tabtoggle='workedit2'>
		<h1 class="company-audit-status">審核狀況：</h1>
		<p>歷史紀錄：</p>
		<div class="company-audit-history" id="company-audit-history">無歷史紀錄</div>
	</div>

	<!-- 工作設定 -->
	<div id='workedit-content-set' class="workedit-content-hide" tabtoggle='workedit2'>	
	<a class="delete-work">刪除工作</a>
	</div>



</div>

</body>
</html>