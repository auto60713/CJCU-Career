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
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
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
	    th{
	    	/*border-bottom: 2px solid #424242;*/
	    }
	    .all-list,#add_dep_btn{
            margin-top: 30px;
	    }
        .all-list-tb th,.all-list-tb td{
        	text-align: left;
        	font-weight: normal;
            padding-right: 30px;
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
        .dep-id{
        	width: 70px;
        }

	</style>

</head>

<body>

<div class="workedit-tabbox">
	<div class="sub-tab tab-active" tabtoggle='workedit1'><i class="fa fa-user tab-img"></i> 工作</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-building-o tab-img"></i> 廠商</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-book tab-img"></i> 系所</div>
</div>


<div class="workedit-content" id='workedit-content'>

    <!--工作-->
	<div tabtoggle='workedit2' class="work_page">

        <a>搜尋工作</a><input type="text" name="search_work_name" value=""><a class="ps">(打完後字按下tab即搜尋)</a>
        <div class="all-list">
            <table id="work_table" class="all-list-tb">
            	<h3>工作列表(僅維護工讀,正職。實習各系所負責)</h3>
            	<tr><th>編號</th><th>發佈廠商</th><th>工作名稱</th><th>類型</th><th>狀態</th></tr>
            	<tr class="space"></tr>
            </table>
        </div>
	</div>

    <!--公司-->
	<div tabtoggle='workedit2' class="com_page workedit-content-hide">

        <a>搜尋廠商</a><input type="text" name="search_com_name" value=""><a class="ps">(打完後字按下tab即搜尋)</a>
        <div class="all-list">
            <table id="com_table" class="all-list-tb">
            	<h3>廠商列表</h3>
            	<tr><th>帳號</th><th>中文名稱</th></tr>
            	<tr class="space"></tr>
            </table>
        </div>
	</div>

    <!--系所-->
	<div tabtoggle='workedit2' class="dep_page workedit-content-hide">
        

        <a>搜尋系所</a><input type="text" name="search_dep_name" value=""><a class="ps">(打完後字按下tab即搜尋)</a>

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
            	<h3>系所列表(依照帳號排列)</h3>
            	<tr><th>序號</th><th>帳號</th><th>密碼</th><th>中文名稱</th></tr>
            	<tr class="space"></tr>
            </table>
        </div>
	</div>
</div>

</body>
<script type="text/javascript">
<?php
    include_once('js_match_list.php'); echo_com_list(); echo_dep_list();
    include_once('js_work_list.php'); staff_maintain_work();
?>

        var body = $('#work_table');
        if(staff_maintain_work.length == 0){body.html("目前沒有任何工作");}
        else{
		    for(var i=0;i<staff_maintain_work.length;i++){

		    	var w_id = $('<td>').text(staff_maintain_work[i]['id']),
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
		    	var	tr = $('<tr>').addClass('work-data').append(w_id,com,work,prop,check);


		    		body.append(tr);
		    }
		}


        body = $('#com_table');
        if(all_company.length == 0){body.html("目前沒有任何廠商");}
        else{
		    for(var i=0;i<all_company.length;i++){

		    	var id = $('<td>').text(all_company[i]['id']),
		        	link3 = $('<a>').attr('target','_blank').attr('href', 'company-'+all_company[i]['id']).text(all_company[i]['name']),
		        	name3 = $('<td>').html(link3),
		    		tr = $('<tr>').addClass('com-data').append(id,name3);
		    		body.append(tr);
		    }
		}

        body = $('#dep_table');
        if(dep_list.length == 0){body.html("目前沒有任何系所");}
        else{
		    for(var i=0;i<dep_list.length;i++){

		    	var sort = $('<td>').text(i),
		    	    no = $('<input>').attr({'type':'text','name':'dep'+dep_list[i]['id'],'value':dep_list[i]['no'].trim()}).addClass('dep-id'),
		         	no_td = $('<td>').append(no),
		        	pw = $('<td>').text(dep_list[i]['pw']),
		        	link2 = $('<a>').attr('target','_blank').attr('href', 'department-'+dep_list[i]['no']).text(dep_list[i]['ch_name']),
		        	name2 = $('<td>').append(link2),
		    		tr = $('<tr>').addClass('dep-data').append(sort,no_td,pw,name2);
		    		body.append(tr);
		    }
		}

        //搜尋工作
		$('input:text[name=search_work_name]').change(function() {
			var id = $(this).val();
			if(id!=""){
			$( ".work-data" ).hide();
		    $( "tr:contains('"+id+"')" ).fadeIn();
		    }
		    else{ $( ".work-data" ).fadeIn(); }
		});
        //搜尋廠商
		$('input:text[name=search_com_name]').change(function() {
			var id = $(this).val();
			if(id!=""){
			$( ".com-data" ).hide();
		    $( "tr:contains('"+id+"')" ).fadeIn();
		    }
		    else{ $( ".com-data" ).fadeIn(); }
		});
        //搜尋系所
		$('input:text[name=search_dep_name]').change(function() {
			var id = $(this).val();
			if(id!=""){
			$( ".dep-data" ).hide();
		    $( "tr:contains('"+id+"')" ).fadeIn();
		    }
		    else{ $( ".dep-data" ).fadeIn(); }
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


function echo_work_name(workid) {

		$.ajax({
			type:"POST",
			url: "ajax_echo_name.php",
			data:{mode:'work',workid:workid},
              success: function (data) { 
                  if(data != 0) return data;
              }
		});    	
}


//關閉工作
function close_work() {

	var workid = $('input:text[name=close_work_id]').val();
	var workname = echo_work_name(workid);

	if (confirm ("確定要關閉工作「"+workname+"」?")){

		$.ajax({
			type:"POST",
			url: "ajax_maintain.php",
			data:{mode:0,workid:workid},
              success: function (data) { 
              	if(data == 'Success'){
              	   var log = $('<h4>').addClass('log').text("已經關閉工作「"+workname+"」了");
              	   $('.work_page').append(log);
              	}
			    else alert(data);
			  }
		});    	

	}
}

//關閉公司
function close_company() {

	var comid = $('input:text[name=close_com_id]').val();
	if (confirm ("確定要關閉公司 "+comid+" ?")){

		$.ajax({
			type:"POST",
			url: "ajax_maintain.php",
			data:{mode:1,comid:comid},
              success: function (data) { 
              	if(data == 'Success'){
              	   var log = $('<h4>').addClass('log').text("已經關閉公司"+comid+"了");
              	   $('.com_page').append(log);
              	}
			    else alert(data);
			  }
		});    	

	}
}
 

//新增系所
function add_department() {

	var dep_id = $('input:text[name=dep_id]').val();
	var dep_name = $('input:text[name=dep_name]').val();
	if (confirm ("確定要新增系所 "+dep_name+" ?")){

		$.ajax({
			type:"POST",
			url: "ajax_maintain.php",
			data:{mode:2,depid:dep_id,depname:dep_name},
              success: function (data) { 
              	if(data == 'Success'){
              	   var log = $('<h4>').addClass('log').text("已經新增系所'"+dep_name+"'了");
              	   $('.dep_page').append(log);
              	}
			    else alert(data);
			  }
		});    	

	}
}


</script>
</html>