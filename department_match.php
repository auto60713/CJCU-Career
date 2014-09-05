<? session_start(); 
if(isset($_SESSION['username'])) $department_no = $_SESSION['username']; 
else{echo "No permission!"; exit;
} 
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/work.css">
    <script>
    <? include_once('js_match_list.php'); 
    echo_match_list_array($department_no);  
    echo_dep_teacher_array($department_no);
    ?>

    $(function(){

 		var body = $('#match-list-container');

        if(match_list_array.length == 0){body.append("目前系上沒有任何實習");}
        else{
		    for(var i=0;i<match_list_array.length;i++){

		    	var img = $('<i>').addClass('fa fa-book').addClass('work-img'),
		    		stu_herf = $('<a>').attr({'target':'_blank','href':'student/'+match_list_array[i]['userid']}).text(match_list_array[i]['username']),
		    		stu = $('<h1>').addClass('work-tit').append(stu_herf),
		    		work_herf = $('<a>').attr({'target':'_blank','href':'work/'+match_list_array[i]['wid']}).text(match_list_array[i]['wname']),
		    		com_herf = $('<a>').attr({'target':'_blank','href':'company/'+match_list_array[i]['comid']}).text(match_list_array[i]['comname']),
		    		detil = $('<div>').addClass('manage-company-herf').append(work_herf,' 發布自 ',com_herf),
		   
                    match_btn = $('<div>').attr('id','match-btn').addClass('btn').text("選擇老師"),
                    sel = $('<select>').attr('id','match-sel'),

		    		subbox1 = $('<div>').addClass('sub-box').append(img),
	                subbox2 = $('<div>').addClass('sub-box').append(stu).append(detil),
		    		subbox3 = $('<div>').addClass('sub-box2').append(match_btn,sel),

		    		mainbox = $('<div>').addClass('work-list-box').append(subbox1).append(subbox2).append(subbox3);
		    		
		    		body.append(mainbox);
		    }
	    }

	    if(dep_teacher_array.length != 0){
	    	for(var i=0;i<dep_teacher_array.length;i++){
                var opt = $('<option>').attr('value',dep_teacher_array[i]['teacherid']).text(dep_teacher_array[i]['teachername']);
                $('select#match-sel').append(opt);
            }
	    }

    });
</script>
</head>
<body>

<div id='match-list-container'></div>
</body>
</html>