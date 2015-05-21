<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if(isset($_SESSION['username'])) $userid = $_SESSION['username']; 
else{echo "您無權訪問該頁面!"; exit;} 
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<style type="text/css">
    #student-audit-again{
        display: inline-block;
        min-width: 140px;
    }
    .pass-req,.delete-lu{
	    font-size: 13px;
	    padding: 2px 6px;
	    text-align: center;
	    margin-left: 10px;
	    display: inline-block;

    }
    .pass-req:hover,.delete-lu:hover{

	    cursor:pointer;
    }
	</style>
    <script>

    <?php include_once('js_work_list.php'); echo_student_apply_list_array($userid);  ?>

    $(function(){
    	
    	$('#student-audit-lightbox').hide();
 		 var body = $('#company-work-list-container');

if(work_list_array.length == 0){body.prepend("目前沒有任何應徵");}
else{
 		 for(var i=0;i<work_list_array.length;i++){

                //公司帳號轉名稱
                var companyherf = "";
                    $.ajax({
						url:  'ajax_echo_name.php',
						type: 'post',
						async: false,
						data: {mode:'cnd',work_pub:work_list_array[i]['pub'],comid:work_list_array[i]['comid']},
                    success: function (data) {
						var href ="";
						work_list_array[i]['pub']==1?(href='company'):(href='department');
						companyherf = $('<a>').attr('href', href+'-'+work_list_array[i]['comid']).text(data);
					}
					});

     	  
 		 		var icon = $('<i>').addClass('fa fa-book fa-3x').addClass('work-img-stu'),
		    		tita = $('<a>').attr('href', 'work-'+work_list_array[i]['wid']).text(work_list_array[i]['wname']),
		    		tit = $('<h1>').addClass('work-tit').append(tita),
		    		hint = $('<div>').addClass('manage-company-herf').append(work_list_array[i]['zone'],'/',work_list_array[i]['prop']+'/',companyherf),
	                wtime = $('<a>').attr('href', 'student_manage.php#times'+work_list_array[i]['wid']).text('工讀單').addClass('stu-work-time'),

		    		hint2 = $('<p>').attr({workid:work_list_array[i]['wid'],audit:work_list_array[i]['ch']}).addClass('check-lightbox'),
                    teacher = $('<p>').text('負責老師 '+work_list_array[i]['tea_name']),
                    score = $('<p>').text('實習分數 '+work_list_array[i]['score']),

		    		statustxt = $('<span>').addClass('nocheck').text('已要求重新再審！'),
		    		subbox1 = $('<div>').addClass('sub-box').append(icon),
		    		subbox2 = $('<div>').addClass('sub-box').append(tit).append(hint,wtime),
		    		subbox3 = $('<div>').addClass('sub-box2').append(hint2);

		    		var check_status='';
		    		switch(work_list_array[i]['ch']) {
		    			//老師說要正名
			    		case 0: check_status='審核中(點我查看)'; hint2.addClass('sta0 onecheck').text(check_status); break;
			    		case 1: check_status='已錄取'; hint2.addClass('sta1 yescheck').text(check_status); break;
			    case 22:case 2: check_status='應徵失敗..(點我查看原因)'; hint2.addClass('sta2 nocheck').text(check_status); break;
			    		case 3: check_status='已要求重新再審'; hint2.addClass('sta2 nocheck').text(check_status); break;
			    		case 4: check_status='工作中'; hint2.addClass('sta4 yescheck').text(check_status); break;
			    		case 5: check_status='完成'; hint2.addClass('sta5 yescheck').text(check_status); break;
		    		}

		        	subbox3.append(teacher,score);
		    		var mainbox = $('<div>').addClass('work-list-box').append(/*subbox1,*/subbox2,subbox3);
		    		
		    		//Show 出該工作詳細的歷史應徵審查紀錄

		    		hint2.click(function(event) {

		    			var th = $(this);

		    			var historybox = $('#student-audit-history');
		    			// 該工作ID
		    			var workid = th.attr('workid');
		    			// 目前的審查狀態代碼
		    			var audit = parseInt(th.attr('audit'));
		    			var check_status_box = $('#student-audit-current-status').removeClass('yescheck').removeClass('nocheck');
		    			var c_status ='';
                        // 取消應徵   要求再審
		    	    	var delete_lu = $('<button>').attr('luid', workid).addClass('delete-lu').text("取消應徵"),
                            pass = $('<button>').attr('workid', workid).addClass('pass-req').text("要求再審");

                        // 工作對學生的狀態意義
		    			switch(audit) {
			    		
			    		case 0: c_status='尚未被公司審核'; check_status_box.addClass('sta0 onecheck').text(c_status); 
			    	            $('.student-audit-lightbox-status').append(delete_lu); 
			    	        break;
			    		case 1: c_status='應徵成功!'; check_status_box.addClass('sta1 yescheck').text(c_status); 
			    		    break;
			    		case 2: c_status='應徵失敗!'; check_status_box.addClass('sta2 nocheck').text(c_status); 
			    	            $('.student-audit-lightbox-status').append(delete_lu); 
				                $('.student-audit-lightbox-status').append(pass); 
				            break;
                        case 22:c_status='應徵失敗!'; check_status_box.addClass('sta2 nocheck').text(c_status); 
			    	        	$('.student-audit-lightbox-status').append(delete_lu); 
			    	        break;
			            case 3: c_status='要求再審中'; check_status_box.addClass('sta2 nocheck').text(c_status); 
			    	        	$('.student-audit-lightbox-status').append(delete_lu); 
			    	        break;
			    		case 4: c_status='工作中'; check_status_box.addClass('sta4 yescheck').text(c_status); 
			    		    break;
			    		case 5: c_status='完成工作'; check_status_box.addClass('sta5 yescheck').text(c_status); 
			    		    break;
			    		}
			    	
                        //取消應徵AJAX
                        delete_lu.click(function(event) {
				    		if (confirm ("確定要取消此應徵? 此操作無法反悔")){
	
			    			    var luid = $(this).attr('luid');
				                $.ajax({
								url: 'delete.php',
								type: 'post',
								data: {mode:1,workid:luid},
						    	})
						    	.done(function (data){
						    		
						    	   alert(data);
						           location.reload();
						    	});
						    }
				        });

                        //要求重新再審AJAX
				    	pass.click(function(event) {
			    			var work_id = $(this).attr('workid'),
			    			    the_element = $(this);
				            $.ajax({
								url: 'ajax_line_up.php',
								type: 'post',
								data: {work_id:work_id},
						    })
						    .done(function (data){
						    	console.log(data);
						    	if(data=='OK'){
							    	$('#student-audit-again').text('已要求重新再審！');
							    	the_element.remove();
							    	th.attr('audit', '3');
						    	}
						    	else{
						    		$('#student-audit-again').text('失敗，請再試一次！');
						    	}
						    });
				    	});

		    			//從後端拉紀錄回來(json格式)
                        $.ajax({
                          type: 'POST',
                          async: false,
                          url: 'js_audit_detail.php',
                          data: {workid: workid},
                          success: function (data) { 

                         	var data = JSON.parse(data);
							for(var i=0;i<data.length;i++){
								var time = $('<span>').addClass('student-audit-htime').text(data[i].time.split(' ')[0]),
									iconcalss = (data[i].censored==1)? 'fa fa-check':'fa fa-times',
									icon = $('<i>').addClass(iconcalss),
									hstatus = $('<span>').addClass('student-audit-hstatus').append(icon),
									msg = $('<span>').addClass('student-audit-hmsg').text(data[i].msg),
									list = $('<div>').addClass('student-audit-list').append(time).append(hstatus).append(msg);
								historybox.append(list);
							}
                          }
                        });

		    			// show the light box
		    			$('#student-audit-lightbox').fadeIn(100);


		    		});
                   
		    		body.prepend(mainbox);

 		 }//這個是工作項目FOR迴圈的下括號

 		 $('#search-box').fadeIn(300); body.fadeIn(300);
} //這格式假如有工作的下括號

		  $('#search-txt').on('input', function(event) {
		  	//console.log($('#search-txt').val());
		  	resort_work($('#search-txt').val());
		  });

		  function resort_work(txt){
		  		if(txt=='') $('.work-list-box').removeClass('hide-work');
		  		else{
		  			$('.work-list-box').each(function(index, el) {
		  			var tit_txt = $(this).find('.work-tit a').text().toLowerCase();
		  			var search_txt = txt.toLowerCase();
		  			if(tit_txt.match(search_txt)==null) $(this).addClass('hide-work');
		  			else $(this).removeClass('hide-work');
		  			});
		  		}
		  }

		  //工作快速搜尋 
		  var pass_search = {"全部":-1,"公司審核中":0,"已錄取":1,"應徵失敗":2,"工作中":4,"工作完成":5};    
          for (var key in pass_search)
          $("#search-sel").append($("<option>").attr("value", pass_search[key]).text(key));

          $("#search-sel").change(function(event) {
          	sel_val = $('#search-sel').val();

		    var is_null = 1; $("#search-echo").text('');
          	$('.work-list-box').each(function(index, el) {
	          	if(sel_val==-1){
	                $('.work-list-box').removeClass('hide-work'); is_null=0;
	          	}
	          	else{
	          		var match_check = $(this).find('.sub-box2 p').attr('class');
	          		if(match_check.indexOf('sta'+sel_val) >= 0){ $(this).removeClass('hide-work'); is_null=0; }
	          		else{ $(this).addClass('hide-work'); }
			    }
			    
	       	});
            if(is_null==1) $("#search-echo").text('沒有工作符合條件');
	      });

         

	    // 關閉詳細審核紀錄LightBox,清除裡面所有資料
		$( "#student-audit-lightbox-exit" ).click(function() {
        	 $('#student-audit-lightbox').fadeOut(100);
        	 $('#student-audit-history, .student-audit-current-status, #student-audit-again').html('');
        	 $('.pass-req').remove();
        	 $('.delete-lu').remove();
        });

    });

</script>
</head>
<body>


	<!-- 該工作的審核狀態 -->
	<div class="staff-apply-form" id="student-audit-lightbox"> 
		<div id='workedit-content-audit' class="staff-apply-box"> 

			<h1 class="student-audit-title"><i class="fa fa-file-text-o"></i> 審核訊息<i class="fa fa-times audit-exit" id="student-audit-lightbox-exit"></i></h1>
			<div class="student-audit-lightbox-status">目前狀況：
				<span id="student-audit-current-status"></span>
				<!--<div class="pass-req">要求再審核</div>-->
				<span id="student-audit-again"></span>
			</div>
			<p class="login-hint">審核訊息：</p>
			<div class="student-audit-history" id="student-audit-history"></div>
		</div>
	</div> 

	
<div id='search-box' style="display:none;">
<select id='search-sel'></select> 
<input type='text' placeholder='搜尋工作名稱' id='search-txt'>
</div>
<div id='company-work-list-container' style="display:none;"><div id='search-echo'></div></div>
</body>
</html>