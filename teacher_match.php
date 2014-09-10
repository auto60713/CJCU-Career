<? session_start(); 
if(isset($_SESSION['username'])) $teacher_no = $_SESSION['username']; 
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
	
	<!-- 實習列表 -->
	<div id='workedit-content-match-list'>
    <select id="search-typefilter">
	    <option value='0' selected="selected">顯示全部</option>
	    <option value='1' >實習中</option>
	    <option value='2' >實習結束</option>
    </select>
    <input type='text' placeholder='搜尋工作名稱' id='search-txt'>
	</div>
	
</div>

</body>

<script>
<? include_once('js_match_list.php'); 
    echo_match_teacher_array($teacher_no);
?>

	$(function(){


//載入該系上的實習列表
        var body = $('#workedit-content-match-list');

        if(match_teacher_array.length == 0){body.append("您目前沒有負責的實習工作");}
        else{
		    for(var i=0;i<match_teacher_array.length;i++){

		    	var img = $('<i>').addClass('fa fa-book').addClass('work-img'),
		    		work_herf = $('<a>').attr({'target':'_blank','href':'work/'+match_teacher_array[i]['workid']}).text(match_teacher_array[i]['workname']),
		    		work = $('<h1>').addClass('work-tit').append(work_herf),
		    		com_herf = $('<a>').attr({'target':'_blank','href':'company/'+match_teacher_array[i]['comid']}).text(match_teacher_array[i]['comname']),
		    		com = $('<div>').addClass('manage-company-herf').append('發布自 ',com_herf),
		    		stu_herf = $('<a>').attr({'target':'_blank','href':'student/'+match_teacher_array[i]['stuid']}).text(match_teacher_array[i]['stuname']),
                    stu = $('<div>').addClass('manage-company-herf').append('實習學生 ',stu_herf),
                    state = $('<a>').addClass('work-ch-pass').text((match_teacher_array[i]['state']=='4'?'實習中':'實習結束')),


	                subbox1 = $('<div>').addClass('sub-box').append(img),
	                subbox2 = $('<div>').addClass('sub-box').append(work).append(com).append(stu),
		    		subbox3 = $('<div>').addClass('sub-box2').append('狀態： ',state),

		    		mainbox = $('<div>').addClass('work-list-box').append(subbox1).append(subbox2).append(subbox3);
		    		
		    		body.append(mainbox);
		    }
	    }






	});
</script>

</html>