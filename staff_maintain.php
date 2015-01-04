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
	    	border-bottom: 2px solid #000000;
	    }
	    .all-list,#add_dep_btn{
            margin-top: 30px;
	    }
        .all-list-tb th{
        	font-style: normal;
            padding-right: 50px;
        }
        .space{
        	height: 10px;
        }

        #add_dep_btn:hover{
            color: #0080C0;
            cursor: pointer;
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

        <a>搜尋工作</a><input type="text" name="search_work_name" value="">
        <div class="all-list">
            <table id="work_table" class="all-list-tb">
            	<h3>工作列表</h3>
            	<tr><th>編號</th><th>發佈廠商</th><th>工作名稱</th><th>類型</th></tr>
            	<tr class="space"></tr>
            </table>
        </div>
	</div>

    <!--公司-->
	<div tabtoggle='workedit2' class="com_page workedit-content-hide">

        <a>搜尋廠商</a><input type="text" name="search_com_name" value="">
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
        

        <a>搜尋系所</a><input type="text" name="search_dep_name" value="">

        <h3>新增系所</h3>
        <table>
            <tr><td style="width:140px">請輸入系所帳號</td><td><input type="text" name="dep_id" value=""></td></tr>
            <tr><td>系所中文名稱</td><td><input type="text" name="dep_name" value=""></td></tr>
            <tr><td>密碼預設</td><td><input type="text" name="dep_pw" value="1234" disabled></td></tr>
        </table>
        <button type="button" onclick="add_department()">新增</button>


        <div class="all-list">
            <table id="dep_table" class="all-list-tb">
            	<h3>系所列表</h3>
            	<tr><th>帳號</th><th>密碼</th><th>中文名稱</th></tr>
            	<tr class="space"></tr>
            </table>
        </div>
	</div>
</div>

</body>
<script type="text/javascript">
<?php
    include_once('js_match_list.php'); echo_com_list(); 
    include_once('js_match_list.php'); echo_dep_list(); 
?>

        var body = $('#com_table');
        if(all_company.length == 0){body.text("目前沒有任何廠商");}
        else{
		    for(var i=0;i<all_company.length;i++){

		    	var id = $('<td>').text(all_company[i]['id']),
		        	ch_name = $('<td>').text(all_company[i]['name']),
		    		tr = $('<tr>').addClass('com-data').append(id,ch_name);
		    		body.append(tr);
		    }
		}

        body = $('#dep_table');
        if(dep_list.length == 0){body.text("目前沒有任何系所");}
        else{
		    for(var i=0;i<dep_list.length;i++){

		    	var no = $('<td>').text(dep_list[i]['no']),
		        	pw = $('<td>').text(dep_list[i]['pw']),
		        	ch_name = $('<td>').text(dep_list[i]['ch_name']),
		    		tr = $('<tr>').addClass('dep-data').append(no,pw,ch_name);
		    		body.append(tr);
		    }
		}


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