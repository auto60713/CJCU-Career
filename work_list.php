<?php session_start(); 
if(isset($_SESSION['username'])) $company_id = $_SESSION['username']; 
else{ echo "No permission!"; exit; } 
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/work.css">
    <script><?php include_once('js_work_list.php'); echo_work_manage_list_array($company_id);  ?>

  
    $(function(){

 		var body = $('#company-work-list-container');

        if(work_list_array.length == 0){body.append("目前沒有工作");}
        else{
		    for(var i=0;i<work_list_array.length;i++){

		   		var chclass='';
		   		var chtxt='';

		    	switch(work_list_array[i]['ch']) {
		    		case 0:
		    			chtxt="等待校方審核";
		    			chclass="sta0 work-ch-unaudit";
		    		break;
		    		case 1:
		    			chtxt="應徵中";
		    			chclass="sta1 work-ch-pass";
		    		break;
		    		case 2: case 22: case 3:
		    			chtxt="校方審核不通過";
		    			chclass="sta2 work-ch-unpass";
		    		break;
		    		case 4:
		    			chtxt="工作中";
		    			chclass="sta4 work-ch-pass";
		    		break;
		    		case 5:
		    			chtxt="工作完成";
		    			chclass="sta5 work-ch-pass";
		    		break;
		    	}
		    	
		    	var img = $('<i>').addClass('fa fa-book fa-3x').addClass('work-img'),
		    		tita = $('<a>').attr('href', '#work'+work_list_array[i]['wid']+"-0").text(work_list_array[i]['wname']),
		    		profile = $('<a>').attr({'href':'work-'+work_list_array[i]['wid'],'Target':'_blank'}).text('預覽工作資料'),
		    		tit = $('<h1>').addClass('work-tit').append(tita),
		    		hint = $('<p>').addClass('work-hint')
		    		.append(profile,'<br>'+ (work_list_array[i]['isout']=='0'?'校外 ':'校內 ')+ work_list_array[i]['propname'] +'<br>發佈時間 '+ work_list_array[i]['date'].split(" ")[0]),
		    		hint2 = $('<p>').append('應徵人數：'+work_list_array[i]['apply_count']+'<br>'+'通過/上限：'+ work_list_array[i]['check_count']+'/'+ work_list_array[i]['rno'] ),
		    		
		    		ch = $('<p>').addClass(chclass).attr('id', 'chstatus').text(chtxt),
		    		subbox1 = $('<div>').addClass('sub-box').append(img),
		    		subbox2 = $('<div>').addClass('sub-box').append(tit).append(hint),
		    		subbox3 = $('<div>').addClass('sub-box2').append(ch).append(hint2),

		    		mainbox = $('<div>').addClass('work-list-box').append(subbox1).append(subbox2).append(subbox3);
		    		
		    		body.append(mainbox);
		    }
		}

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
	          		var match_check = $(this).find('.sub-box2 p').attr('class');
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
</head>
<body>
<div id='search-box'>
<select id="search-typefilter">
	<option value='-1' selected="selected">顯示全部</option>
	<option value='0' >僅顯示未審核</option>
	<option value='1' >僅顯示應徵中</option>
	<option value='2' >僅顯示不通過</option>
	<option value='4' >僅顯示工作中</option>
	<option value='5' >僅顯示已完成</option>
</select>
<input type='text' placeholder='搜尋工作名稱' id='search-txt'>
</div>
<div id='company-work-list-container'><div id='search-echo'></div></div>
</body>
</html>