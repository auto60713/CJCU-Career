<? session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
if(isset($_SESSION['username'])) $userid = $_SESSION['username']; 
else{echo "您無權訪問該頁面!"; exit;} 
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <script><? include_once('js_work_list.php'); echo_student_apply_list_array($userid);  ?>

    /* front-end 架構

	<div class="work-list-box">
		<div class="sub-box">
			<i class="fa fa-book icon work-img"></i>
		</div>
		<div class="sub-box">
			<h1 class="work-tit"><a href="work/6">資深Unix系統軟體工程師</a></h1>
			<p class="work-hint">電腦繪圖人員
			<br>
			校內 工讀
			<br>
			2014-03-09 15:41:41.447
			</p>
		</div>
		<div class="sub-box2">
			<p id="6" class="check-lightbox sta1 onecheck">尚未被公司審核</p>
		</div>
	</div>

    */
    $(function(){
    	
    	$('#student-audit-lightbox').hide();

 		 var body = $('#company-work-list-container');

 		 for(var i=0;i<work_list_array.length;i++){


 		 		var icon = $('<i>').addClass('fa fa-book icon').addClass('work-img'),
		    		tita = $('<a>').attr('href', 'work/'+work_list_array[i]['wid']).text(work_list_array[i]['wname']),
		    		tit = $('<h1>').addClass('work-tit').append(tita),
		    		hint = $('<p>').addClass('work-hint')
		    		.append(work_list_array[i]['name']+'<br>'+ (work_list_array[i]['isout']=='0'?'校內 ':'校外 ') + work_list_array[i]['propname'] +'<br>'+ work_list_array[i]['date']),
		    		hint2 = $('<p>').attr({
		    			workid : work_list_array[i]['wid'],
		    			audit : work_list_array[i]['ch']
		    		}).addClass('check-lightbox'),

		    		// 移動到LightBox內 pass = $('<div>').attr('workid', work_list_array[i]['wid']).addClass('pass-req').text("要求再審核"),
		    		statustxt = $('<span>').addClass('nocheck').text('已要求重新再審！'),
		    		subbox1 = $('<div>').addClass('sub-box').append(icon),
		    		subbox2 = $('<div>').addClass('sub-box').append(tit).append(hint),
		    		subbox3 = $('<div>').addClass('sub-box2').append(hint2);

		    		var check_status='';
		    		switch(work_list_array[i]['ch']) {
		    			//老師說要正名
			    		case 0: check_status='尚未被公司審核'; hint2.addClass('sta1 onecheck').text(check_status); break;
			    		case 1: check_status='應徵成功!請等候通知'; hint2.addClass('sta2 yescheck').text(check_status); break;
			    		case 2: check_status='應徵失敗!'; hint2.addClass('sta3 nocheck').text(check_status); break;
			    		case 3: check_status='應徵失敗!'; hint2.addClass('sta4 nocheck').text(check_status); subbox3.append(statustxt);break;
			    		case 4: check_status='工作中'; hint2.addClass('sta5 yescheck').text(check_status); break;
			    		case 5: check_status='不錄取'; hint2.addClass('sta6 nocheck').text(check_status); break;
			    		case 6: check_status='完成工作'; hint2.addClass('sta7 yescheck').text(check_status); break;
			    		break;
		    		}

		    	
		    		mainbox = $('<div>').addClass('work-list-box').append(subbox1).append(subbox2).append(subbox3);
		    		
		    		// Show 出該工作詳細的歷史應徵審查紀錄

		    		hint2.click(function(event) {

		    			var th = $(this);

		    			var historybox = $('#student-audit-history');
		    			// 該工作ID
		    			var workid = th.attr('workid');
		    			// 目前的審查狀態代碼
		    			var audit = parseInt(th.attr('audit'));
		    			var check_status_box = $('#student-audit-current-status').removeClass('yescheck').removeClass('nocheck');
		    			var c_status ='';

		    			switch(audit) {
			    		//老師說要正名
			    		case 0: c_status='尚未被公司審核'; check_status_box.addClass('sta1 onecheck').text(c_status); break;
			    		case 1: c_status='應徵成功!'; check_status_box.addClass('sta2 yescheck').text(c_status); break;
			    		
			    		case 2: c_status='應徵失敗!'; check_status_box.addClass('sta3 nocheck').text(c_status); 

				    		pass = $('<div>').attr('workid', workid).addClass('pass-req').text("要求再審核");

				    		pass.click(function(event) {
				    		    btn = $(this);
			    			    work_id = btn.attr('workid');
				                $.ajax({
								url: 'ajax_line_up.php',
								type: 'post',
								data: {work_id:work_id},
						    	})
						    	.done(function (data){
						    		console.log(data);
						    		if(data=='OK'){
							    		$('#student-audit-again').text('已要求重新再審！');
							    		btn.remove();
							    		th.attr('audit', '3');
						    		}
						    		else{
						    			$('#student-audit-again').text('失敗，請再試一次！');
						    		}
						    	

						    	});
				    		});
			    			$('.student-audit-lightbox-status').append(pass); 
 
			    			break;


			    		case 3: c_status='應徵失敗!'; 
			    		check_status_box.addClass('sta4 nocheck').text(c_status); 
			    		$('#student-audit-again').text('已要求重新再審！'); 
			    		break;

			    		case 4: c_status='已錄取'; check_status_box.addClass('sta5 yescheck').text(c_status); break;
			    		case 5: c_status='不錄取'; check_status_box.addClass('sta6 nocheck').text(c_status); break;
			    		case 6: c_status='完成工作'; check_status_box.addClass('sta7 yescheck').text(c_status); break;
			    		
			    		}

			    			// 從後端拉紀錄回來(json格式)
		    			$.ajax({
		    				url: 'js_audit_detail.php',
		    				type: 'post',
		    				dataType: 'json',
		    				data: {workid: workid},
		    			})
		    			.done(function (data) {
		    				//console.log(data);
		    				/* data 架構 [{"
		    				id":17,
		    				"company_id":"cjcu",
		    				"user_id":"stud",
		    				"work_id":"6",
		    				"censored":2,
		    				"msg":"\u4f60\u7684\u8cc7\u6599\u4e0d\u9f4a\u5168",
		    				"time":"2014-06-17 09:29:13.423"}]  				*/

		    				/* Front-End 架構
							<div class="student-audit-list">
								<sapn class="student-audit-htime">2014-05-10</sapn>
								<sapn class="student-audit-hstatus"><i class="fa fa-check"></i> 審核通過</sapn>
								<sapn class="student-audit-hmsg">詳細訊息</sapn>
							</div> 	 */   				

							for(var i=0;i<data.length;i++){
								var time = $('<span>').addClass('student-audit-htime').text(data[i].time.split(' ')[0]),
									iconcalss = (data[i].censored==1)? 'fa fa-check':'fa fa-times',
									statustxt = (data[i].censored==1)? ' 應徵成功':' 應徵失敗',
									icon = $('<i>').addClass(iconcalss),
									hstatus = $('<span>').addClass('student-audit-hstatus').append(icon).append(statustxt),
									msg = $('<span>').addClass('student-audit-hmsg').text(data[i].msg),
									list = $('<div>').addClass('student-audit-list').append(time).append(hstatus).append(msg);
								historybox.append(list);
							}

		    			 });

		    			// show the light box
		    			$('#student-audit-lightbox').fadeIn(100);


		    		});


		    		body.prepend(mainbox);

 		 }

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

		    //注入條件
          var pass_search = ["全部", "尚未審核", "應徵成功", "應徵失敗", "已錄取", "不錄取", "完成工作"];
		  for(var i=0;i<pass_search.length;i++)
          $("#search-sel").append($("<option>").attr("value", i).text(pass_search[i]));

          //用錄取篩選
          $("#search-sel").change(function(event) {
          	sel_val = $('#search-sel').val();
          	sel_txt = $('#search-sel option:selected').text();

          	$('.work-list-box').each(function(index, el) {
	          	if(sel_val==0){
	                $('.work-list-box').removeClass('hide-work');
	          	}
	          	else{
	          		var match_check = $(this).find('.sub-box2 p').attr('class');
	          		if(match_check.indexOf('sta'+sel_val) >= 0){ $(this).removeClass('hide-work');}
	          		else{ $(this).addClass('hide-work'); }
			    }
	       	});

	      });

         

	     // 關閉詳細審核紀錄LightBox,清除裡面所有資料
		$( "#student-audit-lightbox-exit" ).click(function() {
        	 $('#student-audit-lightbox').fadeOut(100);
        	 $('#student-audit-history, .student-audit-current-status, #student-audit-again').html('');
        	 $('.pass-req').remove();
        });

    });

</script>
</head>
<body>


	<!-- 該工作的審核狀態 -->
	<div class="staff-apply-form" id="student-audit-lightbox"> 
		<div id='workedit-content-audit' class="staff-apply-box"> 

			<h1 class="student-audit-title">審核狀況 <i class="fa fa-times login-exit" id="student-audit-lightbox-exit"></i> </h1>
			<div class="student-audit-lightbox-status">目前審核狀態：
				<span id="student-audit-current-status"></span>
				<!--<div class="pass-req">要求再審核</div>-->
				<span id="student-audit-again"></span>
			</div>
			<p class="login-hint">歷史紀錄：</p>
			<div class="student-audit-history" id="student-audit-history"></div>
		</div>
	</div> 

	
<div id='search-box'>
<select id='search-sel'></select> 
<input type='text' placeholder='搜尋工作名稱' id='search-txt'>
</div>
<div id='company-work-list-container'></div>
</body>
</html>