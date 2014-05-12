<? session_start(); 
if(isset($_SESSION['username'])) $company_id = $_SESSION['username']; 
else{echo "No permission!"; exit;
} 
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/work.css">
    <script><? include_once('js_work_list.php'); echo_work_manage_list_array($company_id);  ?>

    /* front-end 架構
<div class="work-list-box">

	<div class="sub-box"><img src="" class="work-img"></div>
	<div class="sub-box">
		<h1 class="work-tit"><a href="#">標題</a></h1>
		<p class="work-hint">類別<br>校外 工讀<br>時間0</p>
	</div>
	<div class="sub-box2">
		<p class="work-ch-pass/unpass">審核通過/審核不通過</p>
		<p>應徵人數：20<br>目前通過：0/10</p>
	</div>

</div>
    */
    $(function(){

 		 var body = $('#company-work-list-container');


		 for(var i=0;i<work_list_array.length;i++){

		   		chclass='';
		   		chtxt='';

		    	switch(work_list_array[i]['ch']) {
		    		case 0:
		    			chtxt="未審核";
		    			chclass="work-ch-unaudit";
		    		break;
		    		case 1:
		    			chtxt="審核通過";
		    			chclass="work-ch-pass";
		    		break;
		    		case 2: case 3:
		    			chtxt="審核不通過";
		    			chclass="work-ch-unpass";
		    		break;
		    	}
		    	
		    	var img = $('<i>').addClass('fa fa-book').addClass('work-img'),
		    		
		    		tita = $('<a>').attr('href', '#work'+work_list_array[i]['wid']+"-0").text(work_list_array[i]['wname']),
		    		tit = $('<h1>').addClass('work-tit').append(tita),
		    		hint = $('<p>').addClass('work-hint')
		    		.append(work_list_array[i]['name']+'<br>'+ (work_list_array[i]['isout']=='0'?'校內 ':'校外 ')+ work_list_array[i]['propname'] +'<br>'+ work_list_array[i]['date']),
		    		hint2 = $('<p>').append('應徵人數：'+work_list_array[i]['apply_count']+'<br>'+'通過/上限：'+ work_list_array[i]['check_count']+'/'+ work_list_array[i]['rno'] ),
		    		
		    		ch = $('<p>').addClass(chclass).attr('id', 'chstatus').text(chtxt),
		    		subbox1 = $('<div>').addClass('sub-box').append(img),
		    		subbox2 = $('<div>').addClass('sub-box').append(tit).append(hint),
		    		subbox3 = $('<div>').addClass('sub-box2').append(ch).append(hint2),

		    		mainbox = $('<div>').addClass('work-list-box').append(subbox1).append(subbox2).append(subbox3);
		    		
		    		body.append(mainbox);
		    }

		  $('#search-typefilter').on('change', function(event) {
		  	resort_work();
		  });
		  
		  $('#search-txt').on('input', function(event) {
		  	resort_work();
		  });

		  function resort_work(){

		  	txt = $('#search-txt').val();
		  	vl = $('#search-typefilter').val();

		  	$('.work-list-box').removeClass('hide-work');

		  		if(vl!=0){
		  			switch(vl) {	
		    		case '1': chtxt="審核通過"; break;
		    		case '2': chtxt="審核不通過"; break;
		    		case '3': chtxt="未審核"; break;
		    		}
		  			$('.work-list-box').each(function(index, el) {
		  			var tit_txt = $(this).find('#chstatus').text().toLowerCase();
		  			var search_txt = chtxt;
		  			if(tit_txt.match(search_txt)==null) $(this).addClass('hide-work');
		  			});
		  		}

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
	<option value='0' selected="selected">顯示全部</option>
	<option value='1' >僅顯示通過</option>
	<option value='2' >僅顯示不通過</option>
	<option value='3' >僅顯示未審核</option>
</select>
<input type='text' placeholder='搜尋工作名稱' id='search-txt'>
</div>
<div id='company-work-list-container'></div>
</body>
</html>