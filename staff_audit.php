<?php session_start(); 
include_once('cjcuweb_lib.php');
if(isset($_SESSION['level'])){
if($_SESSION['level']!=$level_staff){
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
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/work_detail_edit.css?v=0">
	<script>
	<?php include_once("js_get_all_audit.php");  
	get_all_audit(0); 
	get_all_audit(3); ?>
	</script>
	<script>
	var fa;
	$(function(){


		var notyet = $('#staff-audit-notyet'),
            total_list = company_list_array0.length+work_list_array0.length;

        if(total_list == 0) notyet.append("沒有任何請求");
        else {
		    for(var i=0;i<company_list_array0.length;i++){
		    		notyet.append( append_data(0,company_list_array0[i],i,0) );
		    }

		    for(var i=0;i<work_list_array0.length;i++){
		    		notyet.append( append_data(1,work_list_array0[i],i,0) );			
		    }
        }


		var again = $('#staff-audit-again'),
		    total_list2 = company_list_array3.length+work_list_array3.length;

        if(total_list2 == 0) again.append("沒有任何請求");
        else {
		    for(var i=0;i<company_list_array3.length;i++){
		    		again.append( append_data(0,company_list_array3[i],i,3) );
		    }

		    for(var i=0;i<work_list_array3.length;i++){
		    		again.append( append_data(1,work_list_array3[i],i,3) );			
		    }
        }
	
		function append_data(type,data,i,ch){

			if(type==0){
				icontype = 'fa fa-building-o';
				lintext = 'company';
				titname = data.ch_name;
				overview = $('<p>').addClass('staff-audit-overview').text("請務必核對帳號");
			}
			else{
				icontype = 'fa fa-book';
				lintext = 'work';
				titname = data.wname;
			var	href = $('<a>').attr("href", "/cjcuweb/company-"+data.comid).attr("target", "_blank"),
				overview = href.addClass('staff-audit-overview').append("發布自 "+data.comname);
			}
			var 
			icon = $('<i>').addClass(icontype),
			wlink= $('<a>').attr({href: lintext+'-'+data.id,target: '_blank'}).text(" "+titname),
			h1 = $('<h1>').append(icon).append(wlink),
			left = $('<div>').addClass('staff-audit-list-left').append(h1).append(overview),
			btn = $('<button>').attr({'type':'button','t': type, 'i':i , ch:ch}).addClass('staff-audit-btn').append(' 審核'),
			right= $('<div>').addClass('staff-audit-list-right').append(btn),

			all = $('<div>').attr({t:type,n:titname}).addClass('staff-audit-list').append(left).append(right);
			return all;
		}


		$('.staff-audit-btn').on('click', function(event) {
			var t = $(this).attr('t');
			var i = $(this).attr('i');
			var ch = $(this).attr('ch');

			fa = $(this).parent().parent();
			createapplyform(t,i,ch);

		});

		function createapplyform(t,i,ch){
			// t: type=0 => company , else =>work
			// ch: is check status
			if(t==0){

				if(ch==0) {
					tit = company_list_array0[i].ch_name;
					hidden_id = company_list_array0[i].id;
				}
				else {
					tit = company_list_array3[i].ch_name;
					hidden_id =company_list_array3[i].id;
				}
				
				icontype = 'fa fa-building-o';
			}
			else {
				if(ch==0) {
					tit = work_list_array0[i].wname;
					hidden_id = work_list_array0[i].id;
				}
				else {
					hidden_id = work_list_array3[i].id;
					tit =work_list_array3[i].wname;
				}

				icontype = 'fa fa-book';
			}
			hidden_t = t;

			$('.staff-apply-form').remove();

			var hidden1 = $('<input>').attr({value: hidden_id, type:'hidden', id:'hidden_id'}),
				hidden2 = $('<input>').attr({value: hidden_t, type:'hidden',id:'hidden_t'}),
				icon = $('<i>').addClass(icontype),
				tbox = $('<h1>').append(icon).append(' '+tit).css('font-size', '28px').attr({id:'obj-tit'}),
				close = $('<i>').addClass('fa fa-times').addClass('staff-apply-box-close'),
				span = $('<span>').text('審核說明：'),
				t = $('<textarea>').attr({id: 'staff-audit-apply-msg',placeholder:'選填'}),
				ok = $('<input>').attr({id: 'staff-audit-apply-ok', type: 'button',value :'通過'}).on('click', function(event) {
					submit_audit(true);
				}),
				no = $('<input>').attr({id: 'staff-audit-apply-no', type: 'button',value :'不通過'}).on('click', function(event) {
					submit_audit(false);
				}),
				errtext= $('<span>').attr('id', 'staff-audit-error'),
				gbtn = $('<div>').addClass('staff-apply-gbtn').append(errtext).append(ok).append(no),
				box = $('<div>').addClass('staff-apply-box').append(close).append(tbox).append("<hr><br>")
				.append(span).append("<br>").append(t).append("<br>").append(gbtn).append(hidden1).append(hidden2),

				bg = $('<div>').addClass('staff-apply-form').append(box);

				close.click(function(event) {$('.staff-apply-form').remove();});

			$('body').append(bg);
		}

/*
		$('#staff-audit-apply-ok').click(function(event) {
			submit_audit(true);
		});
		$('#staff-audit-apply-no').click(function(event) {
			submit_audit(false);
		});
*/
		// audit work or company

		function submit_audit(boo){
			// c is ok or no
			if(boo)	c = 1;
			else c = 2;
			// obj_id is company id or work id
			obj_id = $('#hidden_id').val();
			// t can judge 0 is company , 1 is work 
			t = $('#hidden_t').val();
			// m is supplement
			m = $('#staff-audit-apply-msg').val();
			// title text
			obj_name = $('#obj-tit').text();

			$.ajax({
				url: 'ajax_audit.php',
				type: 'post',
				data: {censored:c, obj_id:obj_id, type:t, msg:m,obj_name:obj_name},
				beforeSend:function(){
					$('#staff-audit-apply-ok, #staff-audit-apply-no ,#staff-audit-apply-msg').attr('disabled', '');
				}
			})
			.done(function(data) {
				console.log(data);
				if(data.split('-')[0]!='0'){
					fa.fadeOut('fast', function() {	$(this).remove();});
					$('.staff-apply-form').fadeOut('fast', function() {	$(this).remove();});
				}
				else audit_error();
			})
			.fail(function() {
				audit_error();
			});
			
		}

		function audit_error(){
			$('#staff-audit-error').text('發生錯誤，請在試一次！');
			$('#staff-audit-apply-ok, #staff-audit-apply-no ,#staff-audit-apply-msg').removeAttr('disabled');
		}


		// TAB Control 
		var tabgroup = $('div[tabtoggle="workedit1"]');
		tabgroup.click(function(event) {
			tabgroup.removeClass('tab-active');
			$(this).addClass('tab-active');
			var index = tabgroup.index( this );
			$('div[tabtoggle="workedit2"]').removeClass('workedit-content-hide');
			$('div[tabtoggle="workedit2"]:not(div[tabtoggle="workedit2"]:eq('+index+'))').addClass('workedit-content-hide');
		});
		tabgroup[<?php echo (int)$_GET['page']; ?>].click();

	});
	
		//filter control
		// $('<div>').attr({t:type,n:titname}).addClass('staff-audit-list')
		$('#type-filter').change(function(event) {
			filterByName();
		});

		$('#name-filter').keyup(function(event) {
			filterByName();
		});




		function filterByName(){

			ftype = $('#type-filter').val();
			fname = $('#name-filter').val();

			$('.staff-audit-list').css('display', 'block');

			switch(ftype) {
				case "1":
					$('.staff-audit-list[t!=0]').css('display', 'none');break;
				case "2":
					$('.staff-audit-list[t!=1]').css('display', 'none');break;		
			}	

			if(fname!='')
			$('.staff-audit-list').each(function(index, el) {
				var objname = $( this ).attr('n').toLowerCase();
				if(objname.match(fname.toLowerCase())==null) $( this ).css('display', 'none');
			});

		}


		//$('body').append($('<div>').addClass('staff-apply-form').append($('<div>').addClass('staff-apply-box').append('efwefwefwef')));

	</script>

</head>
<body>



<div class="staff-audit-filterbox">
<select id="type-filter">
	<option value="0" selected="selected">顯示全部</option>
	<option value="1">僅顯示公司</option>
	<option value="2">僅顯示工作</option>
</select>
<input type="text" id="name-filter" placeholder="過濾名稱">
</div>

<div class="workedit-tabbox">
	<div class="sub-tab tab-active" tabtoggle='workedit1'><i class="fa fa-file-text-o tab-img"></i> 未審核</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-repeat tab-img"></i> 要求再審</div>
</div>


<div class="workedit-content" id='workedit-content'>

	<div id='staff-audit-notyet' class="" tabtoggle='workedit2'></div>
	<div id='staff-audit-again' class="workedit-content-hide" tabtoggle='workedit2'></div>

</div>





</body>
</html>