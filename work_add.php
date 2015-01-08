<?php
session_start();
include_once("cjcuweb_lib.php");

// 防止駭客繞過登入
if(isset ($_SESSION['username'])){

	// 取得公司電話與地址
	include_once("sqlsrv_connect.php");

	if($_SESSION['level']==4) {$sql = "select address,phone from company where id=?"; $who = '公司';}
	else if($_SESSION['level']==5||$_SESSION['level']==1) {$sql = "select address,phone from department where no=?"; $who = '單位';}
	$params = array($_SESSION['username']);
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$result = sqlsrv_query($conn,$sql,$params,$options);
	$row = sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC);
	$company_address = trim($row[0]);
	$company_phone = trim($row[1]);



	// 編輯模式,檢查該工作是否為其公司,否則顯示錯誤
	if($_GET['mode']=='edit'){
			
		if(!isCompanyWork($conn,$_SESSION['username'],$_GET['workid'])){
			if($_SESSION['level']!=$level_staff&&$_SESSION['level']!=$level_department){
			    echo 'No permission!';
			    exit();
			}
		}

	}


}
else{
//重定向瀏覽器 且 後續代碼不會被執行 
header("Location: index.php"); 
exit;
}


// 是否為該公司的工作
function isCompanyWork($conn,$companyid,$workid){
//工作負責人轉換
if (preg_match("/-/i", $companyid)) $companyid = strstr($companyid,'-',true);

	$sql = "select company_id from work where id=?";
	$params = array($workid);
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$result = sqlsrv_query($conn,$sql,$params,$options);
	$row = sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC);
	if($row[0]==$companyid) return true;
	else return false;
}

?>

<!DOCTYPE html>
<html>
<head>
<script src="lib/jquery.validate.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">

.match_dep,.match_dep_tag_box,.instead{
	display: none;
}
.instead td{
	color: #DF7000;
}

label.error{

	color: #D50000;
	font-weight: bold;
	margin-left: 10px;
}
form{
	padding-left: 20px;
}
.td1{
	font-size: 17px;
	font-weight: bolder;
    width: 110px;
    overflow: hidden;

    padding-top: 5px;
    padding-bottom: 5px;
}

div.ui-datepicker{
 font-size:10px;
}
.match_dep_tag{
	cursor: pointer;
	font-size: 10px;
	display: inline;
	margin-right:2px;
	padding: 2px 5px;
	width: auto;
	background-color: #408080;
	color: #FFFFFF;
	border-radius: 2px;
}
.match_dep_tag:hover{
	background-color: #67B4B4;
}
</style>
</head>
<body>

<button id="btn-copy-work" class="btn-copy-work hidden"><i class="fa fa-files-o"></i> 從現有工作複製</button>
<button id="btn-instead-work" class="btn-copy-work hidden"><i class="fa fa-files-o"></i> 廠商代PO</button>

<form name="work" id="work_edit_form" method="post" action="work_add_finish.php">
<table>
<tr class="instead">
	<td class='td1'>選擇廠商：</td>
	<td><select name="instead_com" id="instead_com"><option value="0">請選擇</option></select></td>
</tr>

<tr>
	<td class='td1'>工作名稱：</td>
	<td><input type="text" name="name" id="name"/></td>
</tr>

<tr>
	<td class='td1'>工作類型：</td>
	<td><select name="work_type" id="work_type"><option>請選擇</option></select> 
		<select name="work_type_list1" id="work_type_list1"><option>請選擇</option></select>
		<select name="work_type_list2" id="work_type_list2"><option>請選擇</option></select>
	</td>
</tr>

<tr>
	<td class='td1'>工作日期：</td>
	<td><input type="text" id="bg_date" name="bg_date" placeholder="選擇時間"><b style="margin:0px 5px;">到</b>
		<input type="text" id="ed_date" name="ed_date" placeholder="選擇時間">
	</td>
</tr>

<tr>
	<td class='td1'>工作性質：</td>
	<td><select name="work_prop" id="work_prop"></select>
        <div class="match_dep">請選擇發佈的系所<select name="match_dep" id="dep_list"></select></div>
        <div class="match_dep_tag_box"></div>
        <input type="hidden" name="match_dep_set" id="match_dep_set"/>
	</td>
</tr>

<tr>
	<td class='td1'>工作類別：</td>
	<td><input type="radio" name="isoutside" value="0" checked="true">校外工作
	    <input type="radio" name="isoutside" value="1">校內工作
	</td>
</tr>

<tr>
	<td class='td1'>工作區域：</td>
	<td><select name="zone" id="zone"></select> 
		<select name="zone_name" id="zone_name"></select>
	</td>
</tr>

<tr>
	<td class='td1'>招募人數：</td>
	<td><input type="text" name="recruitment_no" id="recruitment_no" value="1" /></td>
</tr>

<tr>
	<td class='td1'>聯絡地址：</td>
	<td><input type="text" name="address" id="address"/> 
		<label><input type="checkbox" id="address_same" >同<?php echo $who ?>地址</label> 
		<?php echo '<input type="hidden" name="hidden_address" id="hidden_address" value="'.$company_address.'"/>';?>
	</td>
</tr>

<tr>
	<td class='td1'>聯絡電話：</td>
	<td><input type="text" name="phone" id="phone"/> 
		<label><input type="checkbox" id="phone_same" >同<?php echo $who ?>電話</label>
		<?php echo '<input type="hidden" name="hidden_phone" id="hidden_phone" value="'.$company_phone.'"/>';?>
	</td>
</tr>
  
<tr>
	<td class='td1'>薪資待遇：</td>
	<td><select id="pay_way">
		    <option value="1">時薪</option>
		    <option value="2">月薪</option>
		    <option value="3">面議</option>
	    </select>
		<input type="pay" name="pay" id='pay' placeholder="請輸入數字,面議則留白"/>
	</td>
</tr>

<tr>
	<td class='td1'>工作內容：</td>
	<td><textarea name="detail" cols="45" rows="5" id='detail'></textarea></td> 
</tr>

</table>

<?php  //紀錄該工作的ID
	if($_GET['mode']=='edit') echo "<input type='hidden' name='work-id' value=".$_GET['workid'].">";
?>

<input class="work-add-submit" type="submit" name="button" value="確定" />
</form>



<script>

	
	<?php
	// php load some help data for js array
	include_once("js_search_work_data.php"); echo_work_sub_data();
	include_once('js_work_list.php'); echo_work_manage_list_array($_SESSION['username']);
	include_once('js_match_list.php'); echo_com_list();
	// if it's edit mode and load init data to js array
	if($_GET['mode']=='edit'){
	include_once('js_work_detail.php');
	echo_work_detail_edit_array($conn,$_GET['workid']);
	}
	//應該要做一個回傳身分的ajax
	if( $_SESSION['level'] != 4 ) echo '$( "#btn-instead-work" ).fadeIn();';

	?> 
	
	$(function(){

	
		// 生成工作位置基本資料
		$("#zone").append($("<option></option>").attr("value", 0).text("國內"));
		$("#zone").append($("<option></option>").attr("value", 1).text("國外"));

		// 生成工作位置細目
		change_zone_list();

		//日曆API
		$('#bg_date,#ed_date').datepicker({dateFormat: 'yy-mm-dd'});
		
		// 生成工作類型
		for(var i=0;i<work_type.length;i++)
		$("#work_type").append($("<option></option>").attr("value", work_type_id[i]).text(work_type[i]));
		
		// 生成 工作性質
		for(var i=0;i<work_prop.length;i++)
		$("#work_prop").append($("<option></option>").attr("value", work_prop_id[i]).text(work_prop[i]));

		// 工作類型第一層 改變時，用ajax列出 第二層 工作類型細目
		$('#work_type').change(function() {
			var id=$(this).val();
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
			var id=$(this).val();
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


        //廠商代PO
        $( "#btn-instead-work" ).click(function() {
        	if($( ".instead" ).is(":visible")) {
        		$( ".instead" ).fadeOut();
                $( "#instead_com" ).val(0);
            }
            else $( ".instead" ).fadeIn();
        });

        //列出所有廠商
		for(var i=0;i<all_company.length;i++){

			var op = $('<option>').val(all_company[i]['id']).text(all_company[i]['name']);
		    		
			$('#instead_com').append(op);
		}
		
        //自動填入該廠商的聯絡地址跟電話
		$('#instead_com').change(function() {
			var id=$(this).val();
			$.ajax({
			type:"POST",
			async:false, 
			url:"ajax_echo_name.php",
			data:{mode:"com-msg",id:id},
			success:function(data){ 
                $('#phone').val(data.split("&&")[0]);	
                $('#address').val(data.split("&&")[1]);
		    },
			error: function(){alert("網路連線出現錯誤!");}
			});
		});
		



		// 如果工作是實習 列出所有系所
		$('#work_prop').change(function() {
			var id=$(this).val();
			$("#dep_list option,.match_dep_tag_box div").remove();
			if(id==3) {
			$( ".match_dep_tag_box" ).append($('<div>').attr( "id", "all" ).addClass("match_dep_tag").text("不限"));
            $( ".match_dep,.match_dep_tag_box" ).fadeIn();
			$.ajax({
			    type:"POST",
			    async:false, 
			    url:"ajax_dep_list.php",
			    data:"",
			    success:function(msg){ $('#dep_list').html(msg);	},
			    error: function(){alert("網路連線出現錯誤!");}
			});

			}
			else{$( ".match_dep,.match_dep_tag_box" ).fadeOut();}
		});
		//選擇多個系所
        $( "#dep_list" ).change(function() {
            var id=$( "#dep_list" ).val();
            if(id=="all") $('.match_dep_tag').remove();
            else $('#'+id+',#all').remove();

            var name=$( "#dep_list option:selected" ).text(),
                tag = $('<div>').attr( "id", id ).addClass("match_dep_tag").text(name);

                $( ".match_dep_tag_box" ).append(tag);
        });
        //刪除系所TAG
        $('.match_dep_tag').live('click', function() {
            $(this).remove();
        });
        //submit時TAG轉成字串
        $( "#work_edit_form" ).submit(function( event ) {

            var pay_way = $("#pay_way option:selected").text(),
                pay = $( "#pay" ).val();

            $( "#pay" ).val(pay_way+pay);

            var text = "";
            for (i = 0; i < $('.match_dep_tag').length; i++) {
                text += $( ".match_dep_tag:eq( "+i+" )" ).attr('id') + ",";
            }
            $( "#match_dep_set" ).val(text);
        return;
        //event.preventDefault();
        });


		// 工作地點改變時，用AJAX列出地點細目
		$('#zone').change(function() {
			// 清空地點細目
			change_zone_list();
		});
		// 勾選了"同公司地址",自動輸入
		$("#address_same").click( function(){
	   		if( $(this).is(':checked') ) $('#address').val($('#hidden_address').val());
	   		else $('#address').val('');
		});
		// 勾選了"同公司電話",自動輸入
		$("#phone_same").click( function(){
			if( $(this).is(':checked') ) $('#phone').val($('#hidden_phone').val());
	   		else $('#phone').val('');
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



		// 新增工作，從現有工作中複製資料
		$("#btn-copy-work").click(function(event) {
			
				$('#lightbox-copy-work').fadeIn(100, function() {

				var box = $('.listbox-copy-work');

				if(work_list_array.length>0) box.html('');
				else box.html('您目前沒有新增任何工作...');


				for(var i=0;i<work_list_array.length;i++){

					var icon = $('<i>').addClass('fa fa-book'),
						sub = $('<div>').addClass('list-copy-work').attr('wid', work_list_array[i].wid);

						sub.append(icon).append(' ' + work_list_array[i].wname );

						sub.on('click',function(event) {

							console.log('click');
							var wid = $(this).attr('wid');

							$.ajax({
								url: 'js_work_detail.php',
								type: 'post',
								dataType: 'json',
								data: {workid: wid},
							})
							.done(function (data) {
								console.log(data);
								setInit(data,true);
								$('#lightbox-copy-work').fadeOut(100);

							});


						});

						box.append(sub);
				}

			});
		});

		$('#lightbox-copy-exit').click(function(event) {
			$('#lightbox-copy-work').fadeOut(100);
		});

		/* .............................................................................
		   編輯模模式...................................................................
		// .............................................................................*/

		<?php  if($_GET['mode']=='edit') echo 'setInit(work_detail_array,false);';
               else { echo '$("#btn-copy-work").fadeIn();'; }
		 ?>

		function setInit(work_detail_array,is_copy_mode){

			if(!is_copy_mode) $('#work_edit_form').attr('action', 'work_update.php');


			$('#name').val(work_detail_array['name']);
			$('#work_type').val(work_detail_array['type1']);
			
			var id=$('#work_type').val();
			// 清空工作類別細目
			$("#work_type_list1 option").remove();
			// 執行AJAX取得細目資料
			$.ajax({
			type:"POST",
			async:true, 
			url:"ajax_work_type_list.php",
			data:"id="+id+"&list=1",
			success:function(msg){ $('#work_type_list1').html(msg);	
			$('#work_type_list1').val( parseInt(work_detail_array['type2']));
			},
			error: function(){alert("網路連線出現錯誤!");}
			});

			
			var id= parseInt(work_detail_array['type2']);
			// 清空工作類別細目
			$("#work_type_list1 option").remove();
			// 執行AJAX取得細目資料
			$.ajax({
			type:"POST",
			async:true, 
			url:"ajax_work_type_list.php",
			data:"id="+id+"&list=2",
			success:function(msg){ $('#work_type_list2').html(msg);	
			$('#work_type_list2').val(work_detail_array['type3']);
			},
			error: function(){alert("網路連線出現錯誤!");}
			});
			

			$('#work_prop').val(work_detail_array['prop']); 
			$('#bg_date').val(work_detail_array['start_date'].split(" ")[0]); 
			$('#ed_date').val(work_detail_array['end_date'].split(" ")[0]); 
			$('input[type="radio"][value="'+work_detail_array['is_outside']+'"]').attr('checked', 'true');
			$('#zone').val(work_detail_array['zone']);
			$('#zone_name').val(work_detail_array['zone_id']);
			$('#recruitment_no').val(parseInt(work_detail_array['rno']));
			$('#address').val(work_detail_array['address']);
			$('#phone').val(work_detail_array['phone']);
			$('#pay').val(work_detail_array['pay']);
			$('#detail').val(work_detail_array['detail']);
		}


	});


//欄位限制
$(document).ready(function() { 

        $("#work_edit_form").validate({ 
            rules: { 
                name:            { required:true,maxlength:20 },
                work_type_list2: { required:true },
                ed_date:         { required:true },
                zone_name:       { required:true },
                recruitment_no:  { required:true,maxlength:3,digits:true },
                address:         { required:true,maxlength:40 },
                phone:           { required:true,maxlength:14 },
                detail:          { maxlength:80 }
            }
        }); 

        jQuery.extend(jQuery.validator.messages, {
            required: "此為必填項目",
            digits: "請輸入正整數",
            maxlength: jQuery.validator.format("不得超過{0}個字"),
            rangelength: jQuery.validator.format("不符合格式"),
        });

      
});


</script>



<!-- 從現有的工作中複製 -->
<div class="staff-apply-form" id="lightbox-copy-work" style="display:none"> 
	<div class="staff-apply-box"> 
	
		<h2 class="listbox-copy-work-title"><i class="fa fa-files-o"></i> 複製工作 <i class="fa fa-times login-exit" id="lightbox-copy-exit"></i></h2>  
		<p class="listbox-copy-work-hint">請選擇欲複製的工作，系統會將該工作資料為您填入</p>

		<div class="listbox-copy-work"></div>
	
	</div> 
</div>

</body>


</html>