<?php
session_start(); 
if(isset($_SESSION['level'])){
    if($_SESSION['level']!=1){ 
    	echo "No permission"; exit; 
    }
}
else{ 
	echo "No permission"; exit; 
}
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/work_detail_edit.css?v=0">
	<script>

	$(function(){

		// TAB Control 
		var tabgroup = $('div[tabtoggle="workedit1"]');
		tabgroup.click(function(event) {
			tabgroup.removeClass('tab-active');
			$(this).addClass('tab-active');
			var index = tabgroup.index( this );
			$('div[tabtoggle="workedit2"]').removeClass('workedit-content-hide');
			$('div[tabtoggle="workedit2"]:not(div[tabtoggle="workedit2"]:eq('+index+'))').addClass('workedit-content-hide');
		});
		tabgroup[0].click();

	});

	</script>
	<style type="text/css">
	    .all-list,#add_dep_btn{
            margin-top: 30px;
	    }
        .all-list-tb{
            width: 100%;
        }
        .all-list-tb th,.all-list-tb td{
            padding-right: 10px;

            text-overflow: ellipsis;
            white-space: nowrap;

        	text-align: left;
        	font-weight: normal;
            overflow: hidden;
        }
        .space{
        	height: 10px;
        }
        #add_dep_btn:hover{
            color: #0080C0;
            cursor: pointer;
        }
        .ps{
        	font-size: 9px;
        	color: #808080;
        }
        .search_sign{
        	margin:0px 5px;
        }

	</style>

</head>

<body>

<div class="workedit-tabbox" style="display:none">
	<div class="sub-tab tab-active" tabtoggle='workedit1'><i class="fa fa-user tab-img"></i> 工作</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-building-o tab-img"></i> 廠商</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-book tab-img"></i> 系所</div>
    <div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-book tab-img"></i> 單位</div>
</div>


<div class="workedit-content" id='workedit-content' style="display:none">

    <!--工作-->
	<div tabtoggle='workedit2' class="work_page">

        <a>搜尋工作名稱</a><input type="text" name="search_work_name" value="" class="search_sign"><a class="ps">(打完後字按下tab即搜尋)</a>
        <div class="all-list">
            <table id="work_table" class="all-list-tb">
            	<h3>工作列表</h3>
            	<tr><th>序號</th><th>工作名稱</th><th>發佈廠商</th><th>類型</th><th>狀態</th></tr>
            	<tr class="space"></tr>
            </table>
        </div>
	</div>

    <!--公司-->
	<div tabtoggle='workedit2' class="com_page workedit-content-hide">

        

        <a>搜尋廠商名稱</a><input type="text" name="search_com_name" value="" class="search_sign"><a class="ps">(打完後字按下tab即搜尋)</a>
        
        <div class="all-list">
        <h3>新增廠商</h3>
        <table>
            <tr><td style="width:140px">請輸入廠商帳號</td><td><input type="text" name="com_id" value=""></td></tr>
            <tr><td>廠商中文名稱</td><td><input type="text" name="com_name" value=""></td></tr>
            <tr><td>密碼預設</td><td><input type="text" name="com_pw" value="1234" disabled></td></tr>
            <tr><td>地址</td><td><input type="text" name="com_address" value=""></td></tr>
            <tr><td>連絡電話</td><td><input type="text" name="com_phone" value=""></td></tr>
        </table>
        <button type="button" onclick="add_company()">新增</button>
        </div>

        <div class="all-list">
            <table id="com_table" class="all-list-tb">
            	<h3>廠商列表</h3>
            	<tr><th>序號</th><th>帳號</th><th>密碼</th><th>中文名稱</th></tr>
            	<tr class="space"></tr>
            </table>
        </div>
	</div>

    <!--系所-->
	<div tabtoggle='workedit2' class="dep_page workedit-content-hide">
        

        <a>搜尋系所名稱</a><input type="text" name="search_dep_name" value="" class="search_sign"><a class="ps">(打完後字按下tab即搜尋)</a>

        <div class="all-list">
            <h3>新增系所</h3>
            <table>
                <tr><td style="width:140px">請輸入系所帳號</td><td><input type="text" name="dep_id" value=""></td></tr>
                <tr><td>系所中文名稱</td><td><input type="text" name="dep_name" value=""></td></tr>
                <tr><td>密碼預設</td><td><input type="text" name="dep_pw" value="1234" disabled></td></tr>
            </table>
            <button type="button" onclick="add_department()">新增</button>
        </div>

        <div class="all-list">
            <table id="dep_table" class="all-list-tb">
            	<h3>系所列表(依照帳號字母排列)</h3>
            	<tr><th>序號</th><th>帳號</th><th>密碼</th><th>中文名稱</th></tr>
            	<tr class="space"></tr>
            </table>
        </div>
	</div>

    <!--單位-->
    <div tabtoggle='workedit2' class="com_page workedit-content-hide">

        <a>搜尋單位名稱</a><input type="text" name="search_dep2_name" value="" class="search_sign"><a class="ps">(打完後字按下tab即搜尋)</a>

        <div class="all-list">
            <h3>新增單位</h3>
            <table>
                <tr><td style="width:140px">請輸入單位帳號</td><td><input type="text" name="dep2_id" value=""></td></tr>
                <tr><td>單位中文名稱</td><td><input type="text" name="dep2_name" value=""></td></tr>
                <tr><td>密碼預設</td><td><input type="text" name="dep2_pw" value="1234" disabled></td></tr>
            </table>
            <button type="button" onclick="add_department2()">新增</button>
        </div>

        <div class="all-list">
            <table id="dep2_table" class="all-list-tb">
                <h3>單位列表(依照帳號字母排列)</h3>
                <tr><th>序號</th><th>帳號</th><th>密碼</th><th>中文名稱</th></tr>
                <tr class="space"></tr>
            </table>
        </div>
    </div>

</div>

</body>
<script type="text/javascript">
<?php
    include_once('js_match_list.php'); echo_com_list(); echo_dep_list(); echo_dep2_list();
    include_once('js_work_list.php'); staff_maintain_work();
?>

        var body = $('#work_table');
        if(staff_maintain_work.length == 0){body.html("目前沒有任何工作");}
        else{
		    for(var i=0;i<staff_maintain_work.length;i++){

		    	var w_id = $('<td>').text(i+1),
		    	    w_link = $('<a>').attr('href', '#work'+staff_maintain_work[i]['id']+'-0').text(staff_maintain_work[i]['name']),
		        	work = $('<td>').html(w_link),
		        	com_link = $('<a>').attr('target','_blank').attr('href', 'company-'+staff_maintain_work[i]['com_id']).text(staff_maintain_work[i]['com_name']),
		        	com = $('<td>').html(com_link),
		        	prop = $('<td>').text(staff_maintain_work[i]['prop']);

                    switch(staff_maintain_work[i]['check']) {
                        case 1:
                            var check_name = "應徵中";
                        break;
                        case 4:
                            var check_name = "工作中";
                        break;
                        case 5:
                            var check_name = "工作已完成";
                        break;
                    } 

		        var	check = $('<td>').text(check_name);
		    	var	tr = $('<tr>').addClass('work-data').append(w_id,work,com,prop,check);

		    		body.append(tr);
		    }
		}

        body = $('#com_table');
        if(all_company.length == 0){body.html("目前沒有任何廠商");}
        else{
		    for(var i=0;i<all_company.length;i++){

		    	com_table_append_data(body,all_company[i])
		    }
		}

        body = $('#dep_table');
        if(dep_list.length == 0){body.html("目前沒有任何系所");}
        else{
            for(var i=0;i<dep_list.length;i++){

                dep_table_append_data(body,dep_list[i])
            }
        }

        body = $('#dep2_table');
        if(dep2_list.length == 0){body.html("目前沒有任何單位");}
        else{
		    for(var i=0;i<dep2_list.length;i++){

		    	dep_table_append_data(body,dep2_list[i])
		    }
		}

        $('.workedit-tabbox,.workedit-content').fadeIn(300);

//動態新增一筆廠商資料(前端)
function com_table_append_data(body,params) {

        var sort = $('<td>').text(i+1),
                    id = $('<td>').text(params['id']),
                    pw3 = $('<td>').text(params['pw']),
                    link3 = $('<a>').attr('target','_blank').attr('href', 'company-'+params['id']).text(params['name']),
                    name3 = $('<td>').html(link3),
                    delet_btn = $('<button>').attr({'type':'button','com_id':params['id'],'com_name':params['name']}).addClass('com-delete-btn').text('停權'),
                    delet = $('<td>').append(delet_btn),

                    tr = $('<tr>').addClass('com-data').append(sort,id,pw3,name3,delet);
                    body.append(tr);
}
//動態新增一筆系所資料(前端)
function dep_table_append_data(body,params) {

		var number = $('<td>').text(i+1),
		    no = $('<input>').attr({'type':'text','name':'dep'+params['id'],'value':params['no'].trim()}),
		    no_td = $('<td>').append(no),
		    pw = $('<td>').text(params['pw']),
		    link2 = $('<a>').attr('target','_blank').attr('href', 'department-'+params['no']).text(params['ch_name']),
		    name2 = $('<td>').append(link2),
		    delet_btn2 = $('<button>').attr({'type':'button','dep_no':params['id'],'dep_name':params['ch_name']}).addClass('dep-delete-btn').text('刪除'),
            delet2 = $('<td>').append(delet_btn2),

		    tr = $('<tr>').addClass('dep-data').append(number,no_td,pw,name2,delet2);
		    body.append(tr);
}


        //搜尋名稱
		$('.search_sign').change(function() {

			switch( $(this).attr("name") ) {
                case "search_work_name":
                    var data_type = ".work-data"; break;

                case "search_com_name":
                    var data_type = ".com-data"; break;

                case "search_dep_name":
                    var data_type = ".dep-data"; break;

                case "search_dep2_name":
                    var data_type = ".dep-data"; break;
            } 

			var id = $(this).val();
			if(id!=""){
			$( data_type ).hide();
		    $( "tr:contains('"+id+"')" ).fadeIn();
		    }
		    else{ $( data_type ).fadeIn(); }
		});
       

        //更改系所帳號
		$('input.dep-id').change(function() {
			var id = $(this).attr('name').split("p")[1],
			    new_no = $(this).val();

			$.ajax({
			type:"POST",
			url: "ajax_maintain.php",
			data:{mode:3,id:id,no:new_no},
              success: function (data) { 
                  alert(data);
              }
		    });    	


		});

        //公司停權
        $( ".com-delete-btn" ).click(function() {

            var com_id   = $( this ).attr('com_id'),
                com_name = $( this ).attr('com_name');

            if (confirm ("確定要停權 '"+com_name.trim()+"' ?")){

                $.ajax({
                    type:"POST",
                    url: "ajax_maintain.php",
                    data:{mode:6,comid:com_id},
                      success: function (data) { 
                        if(data == 'Success'){
                          
                          $( "tr:contains('"+com_name+"')" ).fadeOut();
                        }
                        else alert(data);
                      }
                });     

            }
        });


        //刪除系所
        $( ".dep-delete-btn" ).click(function() {

            var dep_no   = $( this ).attr('dep_no'),
                dep_name = $( this ).attr('dep_name');

            if (confirm ("確定要刪除 '"+dep_name+"' ?")){

		        $.ajax({
		        	type:"POST",
		        	url: "ajax_maintain.php",
		        	data:{mode:4,id:dep_no},
                      success: function (data) { 
                      	if(data == 'Success'){
                      	  
		                  $( "tr:contains('"+dep_name+"')" ).fadeOut();
                      	}
		        	    else alert(data);
		        	  }
		        });    	

	        }
        });

//新增廠商
function add_company() {

    var com_id = $('input:text[name=com_id]').val(),
        com_name = $('input:text[name=com_name]').val(),
        com_address = $('input:text[name=com_address]').val(),
        com_phone = $('input:text[name=com_phone]').val();

        $.ajax({
            type:"POST",
            url: "ajax_maintain.php",
            data:{mode:5,id:com_id,name:com_name,address:com_address,phone:com_phone},
              success: function (data) { 
                if(data == 'Success'){

               var com_list = [{"id":com_id,"pw":1234,"name":com_name}];
                   body = $('#com_table');
                   com_table_append_data(body,com_list[0]);
                }
                else alert(data);
              }
        });   

    $('input:text[name=com_id]').val('');
    $('input:text[name=com_name]').val('');
}
//新增系所
function add_department() {

	var dep_id = $('input:text[name=dep_id]').val();
	var dep_name = $('input:text[name=dep_name]').val();

		$.ajax({
			type:"POST",
			url: "ajax_maintain.php",
			data:{mode:2,depid:dep_id,depname:dep_name},
              success: function (data) { 
              	if(data == 'Success'){

               var dep_list = [{"id":"N/A","no":dep_id,"pw":1234,"ch_name":dep_name}];
              	   body = $('#dep_table');
              	   dep_table_append_data(body,dep_list[0],1);
              	}
			    else alert(data);
			  }
		});

    $('input:text[name=dep_id]').val('');
    $('input:text[name=dep_name]').val('');
}
//新增單位
function add_department2() {

    var dep2_id = $('input:text[name=dep2_id]').val();
    var dep2_name = $('input:text[name=dep2_name]').val();

        $.ajax({
            type:"POST",
            url: "ajax_maintain.php",
            data:{mode:22,dep2id:dep2_id,dep2name:dep2_name},
              success: function (data) { 
                if(data == 'Success'){

               var dep2_list = [{"id":"N/A","no":dep2_id,"pw":1234,"ch_name":dep2_name}];
                   body = $('#dep2_table');
                   dep_table_append_data(body,dep2_list[0],2);
                }
                else alert(data);
              }
        });

    $('input:text[name=dep2_id]').val('');
    $('input:text[name=dep2_name]').val('');
}


</script>
</html>