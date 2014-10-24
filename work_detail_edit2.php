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
	
</head>
<body>
	
<div class="workedit-tabbox">
	<div id="page-edit" class="sub-tab tab-active" tabtoggle='workedit1'><i class="fa fa-pencil tab-img"></i> 編輯</div>
	<div id="page-apply" class="sub-tab" tabtoggle='workedit1'><i class="fa fa-user tab-img"></i> 應徵</div>
	<div id="page-start" class="sub-tab" tabtoggle='workedit1'><i class="fa fa-bullhorn tab-img"></i> 執行</div>
	<div id="page-audit" class="sub-tab" tabtoggle='workedit1'><i class="fa fa-check tab-img"></i> 狀態</div>
	<div id="page-set" class="sub-tab" tabtoggle='workedit1'><i class="fa fa-cog tab-img"></i> 刪除</div>
</div>

<div class="workedit-content" id='workedit-content'>

	<!-- 該工作的資料編輯，AJAX別的畫面 -->
	<div id='workedit-content-edit' class="" tabtoggle='workedit2'></div>
	<!-- 該工作的應徵學生列表，AJAX別的畫面 -->
	<div id='workedit-content-apply' class="workedit-content-hide" tabtoggle='workedit2'></div>
	<!-- 該工作應徵結束 -->
	<div id='workedit-content-start' class="workedit-content-hide" tabtoggle='workedit2'>

	</div>
	<!-- 該工作的審核狀態 -->
	<div id='workedit-content-audit' class="workedit-content-hide" tabtoggle='workedit2'>
		<h1 class="company-audit-status">工作狀況：</h1>
		<p>歷史紀錄：</p>
		<div class="company-audit-history" id="company-audit-history">無歷史紀錄</div>
	</div>
	<!-- 工作刪除 -->
	<div id='workedit-content-set' class="workedit-content-hide" tabtoggle='workedit2'>	
	    <a id="divbtn-delete" class="work-divbtn">刪除工作</a>
	</div>


</div>

</body>

<script><? include_once("js_audit_detail.php"); echo_audit_detail_array($_POST['workid'],1); ?></script>
<script>

	$(function(){

		// 移除不該檢視的頁面
		$.ajax({
		  type: 'POST',
		  url: 'ajax_work_edit.php',
		  data:{mode:0,workid:<?  echo (int)$_POST['workid']; ?>},
		  success: function (data) { 
            var remove_array = JSON.parse(data);

            for(var i=0;i<remove_array.length;i++){
            $( remove_array[i][1] ).remove();

		    }
		  }
		});

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

        // 該工作的能執行的動作
		$.ajax({
		  type: 'POST',
		  url: 'ajax_work_edit.php',
		  data:{mode:3,workid:<?  echo (int)$_POST['workid']; ?>},
		  success: function (data) { 
            var work_divbtn_array = JSON.parse(data);
            //幾個array:幾個按鈕 , divbtn_id:按鈕的ID , divbtn_text:按鈕的內容
            for(var i=0;i<work_divbtn_array.length;i++){
            var work_divbtn = $('<a>').attr('id',work_divbtn_array[i].divbtn_id).addClass('work-divbtn').text(work_divbtn_array[i].divbtn_text);
		  	$('#workedit-content-start').append(work_divbtn).append($('<br>'));  
		    }
		  }
		});

		switch(work_detail_array.check) {
			case 0:
				icontxt ='fa fa-minus-square-o';
				statustxt = ' 等待校方審核';
				color = '#555';
				break;
			case 1:
				icontxt ='fa fa-check';
				statustxt = ' 應徵中';
				color = '#339933';
				break;
			case 2 : case 3:
				icontxt ='fa fa-times';
				statustxt = ' 校方審核不通過';
				color = '#CC3333';
				break;
			case 4:
				icontxt ='fa fa-check';
				statustxt = ' 實習中';
				color = '#339933';
				break;
			case 5:
				icontxt ='fa fa-check';
				statustxt = ' 工作結束';
				color = '#339933';
				break;
		}

		var audit_history_container = $('#company-audit-history');
		if(audit_array.length>0) audit_history_container.html('');
		for(var i=0;i<audit_array.length;i++){

			var icontxt2 = (audit_array[i].censored==1)? 'fa fa-check': 'fa fa-times',
				statustxt2 = (audit_array[i].censored==1)? ' 審核通過': ' 審核不通過',
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
			var currentId = $(this).attr('id');
			$('div[tabtoggle="workedit2"]').addClass('workedit-content-hide');
			switch(currentId){
				case 'page-edit':
				    $('#workedit-content-edit').removeClass('workedit-content-hide');
				break;
				case 'page-apply':
				    $('#workedit-content-apply').removeClass('workedit-content-hide');
				break;
				case 'page-start':
                    $('#workedit-content-start').removeClass('workedit-content-hide');
				break;
				case 'page-audit':
                    $('#workedit-content-audit').removeClass('workedit-content-hide');
				break;
				case 'page-set':
				    $('#workedit-content-set').removeClass('workedit-content-hide');
				break;
			}
		});
		tabgroup[<?  echo (int)$_POST['page']; ?>].click();



        //開始實習
        var work_start = $('a#divbtn-start');
		work_start.on( "click", function() {
		    if (confirm ("要結束應徵開始實習嗎?")){

		    	$.ajax({
			     	type:"POST",
			     	url: "ajax_work_edit.php",
			     	data:{mode:1,workid:<? echo (int)$_POST['workid']; ?>},
                    success: function (data) { 
          
                    	$('#workedit-content-start').text(data);
			        }
			    });
		    }
		});
		//完成實習(結束應徵)
        var work_end = $('a#divbtn-end');
		work_end.on( "click", function() {
		var btn_text = $('a#divbtn-end').text();

		    if (confirm ("確定要"+btn_text+"?")){

		    	$.ajax({
			     	type:"POST",
			     	url: "ajax_work_edit.php",
			     	data:{mode:2,workid:<? echo (int)$_POST['workid']; ?>},
                    success: function (data) { 
          
                    	$('#workedit-content-start').text(data);
			        }
			    });
		    }
		});
        //刪除工作
        var work_delete = $('a#divbtn-delete');
		work_delete.click(function(event) {

            //查詢該工作名字
			$.ajax({
			    type:"POST",
			    url: "ajax_echo_name.php",
			    data:{mode:'work',workid:<? echo (int)$_POST['workid']; ?>},
                success: function (data) { //上括號
                if(data != 0){
                var work_name=data;
                  
		            if (confirm ("確定要刪除此工作 「"+work_name+"」 ?")){

		    	    $.ajax({
			         	type:"POST",
			         	url: "delete.php",
			         	data:{mode:0,workid:<? echo (int)$_POST['workid']; ?>,workname:work_name},
                        success: function (data2) { 
                        	if(data2 != 0){
                        		alert('刪除成功');
                    	        window.location.href = data2+'_manage.php#'+data2+'-work';
                        	}
			      	    else alert('資料驗證不正確 無法刪除');
			            }
			        });
		            }

		    	}
			    }//下括號
			});
		});


	});


</script>


</html>