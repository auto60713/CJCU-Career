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
		   
                    match_btn = $('<div>').attr('id',match_list_array[i]['line_no']).addClass('match-btn btn').text("媒合老師"),

		    		subbox1 = $('<div>').addClass('sub-box').append(img),
	                subbox2 = $('<div>').addClass('sub-box').append(stu).append(detil),
		    		subbox3 = $('<div>').addClass('sub-box2').append(match_btn),

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

	    //選擇老師
        var match_btn = $('div.match-btn'),
            tea_name = $( "#match-sel option:selected" ).text(),
            tea_no = $( "select#match-sel" ).val();

		match_btn.on( "click", function() {
		    if (confirm ('此工作將會配對 "'+tea_name+'"')){

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





    });
</script>
</head>
<body>

請選擇校方負責人
<select id="match-sel"></select>

<div id='match-list-container'></div>
</body>
</html>