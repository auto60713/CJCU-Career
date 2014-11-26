<? session_start(); 
if(!isset($_SESSION['username'])) { echo 'No permission!'; exit; }
?>

<!doctype html>
<html>
<head>
	<script></script>
	<script><? include_once("js_audit_detail.php"); echo_audit_detail_array($_SESSION['username'],0); ?></script>
	<script src="lib/jquery.validate.js"></script>
</head>
<style type="text/css">
form,.sign{
	padding-left: 20px;
}
.td1{
	font-size: 17px;
	font-weight: bolder;
    width: 110px;
    overflow: hidden;
}
.td2{
    padding-top: 5px;
    padding-bottom: 5px;
}
label.error{

	color: #D50000;
	font-weight: bold;
	margin-left: 10px;
}
</style>
<body>
<script>
	$(function(){

		<?  //公司的基本資料
		    include_once("js_detail.php"); echo_company_detail($_SESSION['username']); 
		?>

	    for(var key in company_detail_array){
	        $( "[name='"+key+"']" ).val( company_detail_array[key] );
		}	
		   
		var audit_history_container = $('#company-audit-history');
		if(audit_array.length>0) audit_history_container.html('');
		for(var i=0;i<audit_array.length;i++){

			var icontxt = (audit_array[i].censored==1)? 'fa fa-check': 'fa fa-times',
				statustxt = (audit_array[i].censored==1)? ' 通過': ' 不通過',
				time = $('<span>').addClass('company-audit-time').text(audit_array[i].time.split(' ')[0]),
				icon = $('<i>').addClass(icontxt),
				censored = $('<span>').addClass('company-audit-censored').append(icon).append(statustxt),
				msg = $('<span>').addClass('company-audit-msg').text(audit_array[i].msg),
				vialink = $('<a>').attr('target','_blank').attr('href', 'staff/'+audit_array[i].staff_no).text(audit_array[i].staff_no),
				via = $('<span>').addClass('company-audit-via').append('審核者：').append(vialink),
				all = $('<div>').addClass('company-audit-list').append(time).append(censored)
				.append(msg).append(via);
				audit_history_container.append(all);
		}

		//<i class="fa fa-check"></i> 通過
		switch(company_detail_array.censored) {
			case 0:
				icontxt ='fa fa-minus-square-o';
				statustxt = ' 未審核';
				color = '#555';
				break;
			case 1:
				icontxt ='fa fa-check';
				statustxt = ' 通過';
				color = '#339933';
				break;
			case 2 :case 3:
				icontxt ='fa fa-times';
				statustxt = ' 不通過';
				color = '#CC3333';
				break;

		}		
			var icon = icon = $('<i>').addClass(icontxt),
			again_txt = $('<span>').addClass('company-audit-again-txt').text('已要求再次審核！'),
			again_btn = $('<input>').addClass('company-audit-again').attr({
				value: '請求再次審核',
				type: 'button'
			}).on('click', function(event) {
				
				$.ajax({
					url: 'ajax_audit_again.php',
					type: 'post',
					data: {},
				})
				.done(function(data) {
					if(data!='0') {
					$('.company-audit-status').append(again_txt);
					again_btn.remove();
					}
				});

			});

		$('.company-audit-status').append(icon).append(statustxt).css('color', color);
		if(company_detail_array.censored==2) $('.company-audit-status').append(again_btn);
		if(company_detail_array.censored==3) $('.company-audit-status').append(again_txt);

		// TAB control
		var tabgroup = $('div[tabtoggle="workedit1"]');
		tabgroup.click(function(event) {
			tabgroup.removeClass('tab-active');
			$(this).addClass('tab-active');
			var index = tabgroup.index( this );
			$('div[tabtoggle="workedit2"]').removeClass('workedit-content-hide');
			$('div[tabtoggle="workedit2"]:not(div[tabtoggle="workedit2"]:eq('+index+'))').addClass('workedit-content-hide');
		});

		tabgroup[<?  echo (int)$_GET['page']; ?>].click();

	});

    //從後端得到公司所有類型
    <?php include("js_company_type.php"); ?> 
    for(var i=0;i<company_type_array.length;i++)
    $("#company_type").append($("<option>").attr("value", company_type_array_id[i]).text(company_type_array[i]));

    //從後端得到公司地點
    for(var i=0;i<company_zone_array.length;i++)
    $("#zone_name").append($("<option>").attr("value", company_zone_array_id[i]).text(company_zone_array[i]));

    //js_company_detail.php取得公司類型與位置
    <? echo_company_type_and_zone($_SESSION['username']); ?>
    $("#company_type").val(company_type);
	$("#zone_name").val(company_zone);
	
</script>




	
<div class="workedit-tabbox">
	<div class="sub-tab tab-active" tabtoggle='workedit1'><i class="fa fa-pencil"></i> 關於公司</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-check-square-o"></i> 審核狀況</div>
</div>


<div class="workedit-content" id='workedit-content'>
	
	<div id='workedit-content-edit' class="" tabtoggle='workedit2'>
	
	<form id="detail" name="form" method="post" action="updata.php">
	<!--用table來對齊表格-->
	有*字號為必填項目
        <table>                                                        
        <tr><td class='td1'>中文名稱*：</td>    <td class='td2'><input type="text" name="ch_name"/></td></tr>
        <tr><td class='td1'>英文名稱：</td>     <td class='td2'><input type="text" name="en_name"/></td></tr>
        <tr><td class='td1'>公司電話*：</td>    <td class='td2'><input type="text" name="phone"/></td></tr>
        <tr><td class='td1'>傳真：</td>         <td class='td2'><input type="text" name="fax"/></td></tr>
        <tr><td class='td1'>Email*：</td>       <td class='td2'><input type="text" name="email"/></td></tr>
        <tr><td class='td1'>統一編號*：</td>    <td class='td2'><input type="text" name="uni_num"/></td></tr>
        <tr><td class='td1'>負責人*：</td>      <td class='td2'><input type="text" name="boss_name" /></td></tr>
        <tr><td class='td1'>行業類型 :</td>     <td class='td2'><select name="type" id="company_type"></select></td></tr>
        <tr><td class='td1'>地點：</td>         <td class='td2'><select name="zone_name" id="zone_name"></select></td></tr>
        <tr><td class='td1'>公司地址*：</td>    <td class='td2'><input type="text" name="address"/></td></tr>
        <tr><td class='td1'>員工人數*：</td>    <td class='td2'><input type="text" name="staff_num"/></td></tr>
        <tr><td class='td1'>資本額：</td>       <td class='td2'><input type="text" name="budget"/></td></tr>
        <tr><td class='td1'>網址：</td>         <td class='td2'><input type="text" name="url" class="url"/></td></tr>
        <tr><td class='td1'>簡介：</td>         <td class='td2'><textarea name="introduction" cols="45" rows="5"></textarea></td></tr>
        </table>

        <input type="submit" name="button" value="修改" />　　
    </form>
	</div>



<div id='workedit-content-apply' class="workedit-content-hide" tabtoggle='workedit2'>
	
	<h1 class="company-audit-status">審核狀況：</h1>
	
	<p>歷史紀錄：</p>

	<div class="company-audit-history" id="company-audit-history">
		無歷史紀錄
	</div>
	

</div>



</div>

<script type="text/javascript">
//欄位限制
$(document).ready(function() { 

        $("#detail").validate({ 
            rules: { 
                ch_name: { required:true,maxlength:20 },
                en_name: { maxlength:20 },
                phone:   { required:true,maxlength:12 },
                fax:     { maxlength:12 },
                email:   { required:true,email:true },
                uni_num: { required:true,rangelength:[8,8],digits:true },
                boss_name:    { required:true,maxlength:12 },
                zone_name:    { required:true },
                address:      { required:true,maxlength:40 },
                staff_num:    { required:true,digits:true },
                budget:       { digits:true },
                url:          { url:true },
                introduction: { maxlength:80 }
            }
        }); 

        jQuery.extend(jQuery.validator.messages, {
            required: "此為必填項目",
            email: "請輸入正確的電子信箱",
            url: "請輸入正確的網址",
            digits: "請輸入數字",
            equalTo: "密碼不正確",
            maxlength: jQuery.validator.format("不得超過{0}個字"),
            rangelength: jQuery.validator.format("不符合格式"),
        });

      
});


</script>


</body>
</html>
