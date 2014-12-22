<?php session_start(); 
if(isset($_SESSION['username'])) $department_no = $_SESSION['username']; 
else{echo "No permission!"; exit;
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
	<div id="page-match-list" class="sub-tab tab-active" tabtoggle='workedit1'><i class="fa fa-user tab-img"></i> 實習列表</div>
	<div id="page-match" class="sub-tab" tabtoggle='workedit1'><i class="fa fa-pencil tab-img"></i> 負責老師</div>
</div>

<div class="workedit-content" id='workedit-content'>

	<!-- 實習列表 -->
	<div id='workedit-content-match-list' class="" tabtoggle='workedit2'>
    <select id="search-typefilter">
	    <option value='-1' selected="selected">顯示全部</option>
	    <option value='1' >應徵中</option>
	    <option value='4' >實習中</option>
	    <option value='5' >實習完成</option>
    </select>
    <input type='text' placeholder='搜尋工作名稱' id='search-txt'>
	</div>

	<!-- 媒合老師 -->
	<div id='workedit-content-match' class="workedit-content-hide" tabtoggle='workedit2'>
    請選擇校方負責人<select id="match-sel"></select><br>
	</div>

</div>

</body>

<script>
<?php include_once('js_match_list.php'); 
    echo_line_up_array($department_no);  
    echo_dep_teacher_array($department_no);
    echo_match_list_array($department_no);
?>

	$(function(){

// TAB Control
		var tabgroup = $('div[tabtoggle="workedit1"]');
		tabgroup.click(function(event) {
			tabgroup.removeClass('tab-active');
			$(this).addClass('tab-active');
			var currentId = $(this).attr('id');
			$('div[tabtoggle="workedit2"]').addClass('workedit-content-hide');
			switch(currentId){
				case 'page-match':
				    $('#workedit-content-match').removeClass('workedit-content-hide');
				break;
				case 'page-match-list':
				    $('#workedit-content-match-list').removeClass('workedit-content-hide');
				break;
			}
		});
		tabgroup[0].click();



//載入該系上的需要媒合的實習
        var body = $('#workedit-content-match');

        if(line_up_array.length == 0){body.html("沒有實習需要負責老師");}
        else{
		    for(var i=0;i<line_up_array.length;i++){

		    	var img = $('<i>').addClass('fa fa-book').addClass('work-img-match'),
		    		stu_herf = $('<a>').attr({'target':'_blank','href':'student-'+line_up_array[i]['userid']}).text(line_up_array[i]['username']),
		    		stu = $('<h1>').addClass('work-tit').append(stu_herf),
		    		work_herf = $('<a>').attr({'target':'_blank','href':'work-'+line_up_array[i]['wid']}).text(line_up_array[i]['wname']),
		    		com_herf = $('<a>').attr({'target':'_blank','href':'company-'+line_up_array[i]['comid']}).text(line_up_array[i]['comname']),
		    		detil = $('<div>').addClass('manage-company-herf').append(work_herf,' 發布自 ',com_herf),
		   
                    match_btn = $('<div>').attr('id',line_up_array[i]['line_no']).addClass('match-btn btn').text("媒合老師"),

		    		subbox1 = $('<div>').addClass('sub-box').append(img),
	                subbox2 = $('<div>').addClass('sub-box').append(stu).append(detil),
		    		subbox3 = $('<div>').addClass('sub-box2').append(match_btn),

		    		mainbox = $('<div>').addClass('work-list-box').append(subbox1).append(subbox2).append(subbox3);
		    		
		    		body.append(mainbox);
		    }
	    }

//載入該系上的老師
	    if(dep_teacher_array.length != 0){
	    	for(var i=0;i<dep_teacher_array.length;i++){
                var opt = $('<option>').attr('value',dep_teacher_array[i]['teacherid']).text(dep_teacher_array[i]['teachername']);
                $('select#match-sel').append(opt);
            }
	    }

//選擇老師
        var match_btn = $('div.match-btn');
		match_btn.on( "click", function() {
			var tea_name = $( "#match-sel option:selected" ).text(),
                tea_no = $( "select#match-sel" ).val();
		    if (confirm ('此實習的負責老師決定為 "'+tea_name+'"')){

		    	var line_no = $(this).attr('id'),
		    	    item = $(this).parents('.work-list-box');

		    	$.ajax({
			     	type:"POST",
			     	url: "ajax_work_edit.php",
			     	data:{mode:4,line_no:line_no,tea_no:tea_no},
                    success: function (data) { 
          
                        if(data == 'Success') item.fadeOut();
                    	else alert(data);
			        }
			    });
		    }
		});


//載入該系上的實習列表
        var body = $('#workedit-content-match-list');

        if(match_list_array.length == 0){body.html("目前系上沒有任何實習");}
        else{
		    for(var i=0;i<match_list_array.length;i++){

		    	var img = $('<i>').addClass('fa fa-inbox fa-3x').addClass('work-img'),
		    		work_herf = $('<a>').attr({'target':'_blank','href':'work-'+match_list_array[i]['workid']}).text(match_list_array[i]['workname']),
		    		work = $('<h1>').addClass('work-tit').append(work_herf),
		    		com_herf = $('<a>').attr({'target':'_blank','href':'company-'+match_list_array[i]['comid']}).text(match_list_array[i]['comname']),
		    		detil = $('<div>').addClass('manage-company-herf').append('發布自 ',com_herf),
                    stu = $('<div>').addClass('manage-company-herf');

                    switch(match_list_array[i]['state']) {
                        case 1:
                            var state_val = "應徵中";
                            break;
                        case 4:
                            var state_val = "實習中";
                            break;
                        case 5:
                            var state_val = "實習完成";
                            break;
                    } 

                    //該實習所錄取的學生
                        var msg='實習學生 : 負責老師 》',stu_link='';
		                $.ajax({
		                  type: 'POST',
		                  url: 'ajax_work_edit.php',
		                  data:{mode:5,workid:match_list_array[i]['workid']},
		                  success: function (data) { 
                            var stu_array = JSON.parse(data);
                            if(stu_array.length == 0) {msg = '尚未有學生錄取'; stu.append(msg);}
                            else{

                            	stu.append(msg);
                              for(var i=0;i<stu_array.length;i++){
                              	if (stu_array[i]['tid'] == null) stu_array[i]['tid'] = '(未配對)';
                                var stu_link = $('<a>').attr({'target':'_blank','href':'student-'+stu_array[i]['stuid']}).text(stu_array[i]['stuname'].trim()),
                                    tea_link = $('<a>').text(stu_array[i]['tid']);
                                
                                stu.append(stu_link,' : ',tea_link,' , ');
		                      }
		                    }
		                  },
		                  async: false
		                });

                var state = $('<a>').addClass('work-ch-pass sta'+match_list_array[i]['state']).text(state_val);

                   

		    	var	subbox1 = $('<div>').addClass('sub-box').append(img),
	                subbox2 = $('<div>').addClass('sub-box').append(work).append(detil).append(stu),
		    		subbox3 = $('<div>').addClass('sub-box2').append('狀態： ',state),

		    		mainbox = $('<div>').addClass('work-list-box').append(subbox1).append(subbox2).append(subbox3);
		    		
		    		body.append(mainbox);
		    }
	    }

//快速篩選
        $('#search-typefilter').on('change', function(event) {
		    resort_work();
		});

        $('#search-txt').on('input', function(event) {
		  	resort_work();
		});

        function resort_work(){

		  	var txt = $('#search-txt').val();
		  	var search_val = $('#search-typefilter').val();

		  	$('.work-list-box').removeClass('hide-work');

		        var is_null = 1; $("#search-echo").text('');
		  		$('.work-list-box').each(function(index, el) {
	          	if(search_val==-1){
	                $('.work-list-box').removeClass('hide-work'); is_null=0;
	          	}
	          	else{
	          		var match_check = $(this).find('.sub-box2 a').attr('class');
	          		if(match_check.indexOf('sta'+search_val) >= 0){ $(this).removeClass('hide-work'); is_null=0; }
	          		else{ $(this).addClass('hide-work'); }
			    }
	         	});
	         	if(is_null==1) $("#search-echo").text('沒有工作符合條件');

		  		if(txt!=''){
		  			$('.work-list-box').each(function(index, el) {
		  			var tit_txt = $(this).find('.work-tit a').text().toLowerCase();
		  			var search_txt = txt.toLowerCase();
		  			if(tit_txt.match(search_txt)==null) $(this).addClass('hide-work');
		  			});
		  		}

		  }



	});
</script>

</html>