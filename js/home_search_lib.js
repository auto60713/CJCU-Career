// put work in work-list-container's index
//秀出工作==================

	var list_container_index = 0;

	for(var i=0;i<work_list_array.length;i++){

		var a_link = $('<a>').attr({href:'work/'+work_list_array[i].wid}),
			div_work = $('<div>').addClass('work'),
			work_name = $('<h1>').text(work_list_array[i].wname),
			work_zone = $('<p>').text(work_list_array[i].zname),
			work_propn = $('<p>').text(((work_list_array[i].isout=='0')?'校內 ':'校外 ') + work_list_array[i].propname),
			work_recr = $('<p>').text('需求 '+ work_list_array[i].rno +' 人'),
			work_date = $('<p>').addClass('date').text(work_list_array[i].date.split(' ')[0]);
			

		div_work.append(work_name).append(work_zone).append(work_propn).append(work_recr).append(work_date);
		a_link.append(div_work);

		if(list_container_index==4)list_container_index=0;

		$('.list:eq('+list_container_index+')').append(a_link);
		list_container_index++;
	}


//填入進階搜尋項目==================

        // 生成工作位置基本資料
		$("#zone").append($("<option></option>").attr("value", 0).text("國內"));
		$("#zone").append($("<option></option>").attr("value", 1).text("國外"));

		// 生成工作位置細目
		change_zone_list();
		
		// 生成工作類型
		for(var i=0;i<work_type.length;i++)
		$("#work_type").append($("<option></option>").attr("value", work_type_id[i]).text(work_type[i]));

		// 工作類型第一層 改變時，用ajax列出 第二層 工作類型細目
		$('#work_type').change(function() {
			var id = $(this).val();
			// 清空工作類別細目
			$("#work_type_list1 option").remove();
			// 執行AJAX取得細目資料
			$.ajax({
			type:"POST",
			async:false, 
			url:"ajax_work_type_list.php",
			data:"id="+id+"&list=1",
			success:function(msg){ $('#work_type_list1').html(msg);	},
			error: function(){alert("網路連線出現錯誤!");}
			});
		});

		// 工作類型第二層 改變時，用ajax列出 第三層 工作類型細目
		$('#work_type_list1').change(function() {
			var id = $(this).val();
			// 清空工作類別細目
			$("#work_type_list2 option").remove();
			// 執行AJAX取得細目資料
			$.ajax({
			type:"POST",
			async:false, 
			url:"ajax_work_type_list.php",
			data:"id="+id+"&list=2",
			success:function(msg){ $('#work_type_list2').html(msg);	},
			error: function(){alert("網路連線出現錯誤!");}
			});
		});

     	// 生成 工作性質
		for(var i=0;i<work_prop.length;i++)
		$("#work_prop").append($("<option></option>").attr("value", work_prop_id[i]).text(work_prop[i]));


		// 工作地點改變時，用AJAX列出地點細目
		$('#zone').change(function() {
			// 清空地點細目
			change_zone_list();
		});

		function change_zone_list(){
			var zone = $('#zone').val();
			$("#zone_name option").remove();
			// 執行AJAX取得細目資料
			$.ajax({
			type:"POST",
			async:false, 
			url:"ajax_zone_list.php",
			data:"zone="+zone,
			success:function(msg){ $('#zone_name').html(msg);},
			error: function(){alert("網路連線出現錯誤!");}
			});
		}


		
//搜尋啟用==================
	var url = $(location).attr('pathname')+"?";

	$( "#search" ).click(function() {
    //搜尋的條件用php get

    //普通搜尋***
    if( $( "#normal-search" ).val() != "" ){
    var search = '&search=' + $( "#normal-search" ).val();
    url += search;
    }


    //進階搜尋***

    //類型
    if($("#search_type").is(":checked")){
    var type = '&type=' + $( "#work_type_list2" ).val();
    url += type;
    }
    //性質
    if($("#search_prop").is(":checked")){
    var prop = '&prop=' + $( "#work_prop" ).val();
    url += prop;
    }
    //校內外
    if($("#search_io").is(":checked")){
    var io = '&io=' + $( "#work_io" ).val();
    url += io;
    }
    //地點
    if($("#search_zone").is(":checked")){
    var zone = '&zone=' + $( "#zone_name" ).val();
    url += zone;
    }


    window.location.replace(url);
    });


