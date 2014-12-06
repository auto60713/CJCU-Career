
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($orderstatus) ) {
	$orderstatus = (array)$orderstatus;
}
$id = isset($orderstatus['id']) ? "/".$orderstatus['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form" id="applydoc"'); ?>
<div class="box create rounded">

	<h3>申請證明文件</h3>

	<p>證明文件說明內容，此區塊提供您可申請證明文件，使用本功能讓您不需要再親自至學校辦理，按下右方申請即可開始使用</p>
    <p><img width="100%" src="<?php echo Template::theme_url()?>images/process.png"></p>
</div>
<?php if(isset($orderstatus['id'])): ?><input id="id" type="hidden" name="serial" value="<?php echo $orderstatus['id'];?>"  /><?php endif;?>
<input id="lidm" type="hidden" name="lidm" value="<?php echo $lidm;?>"  />
<input id="pic-userfile" type="hidden" name="pic-userfile" value=""  />
<!--<input id="pic-userfile2" type="hidden" name="pic-userfile2" value=""  />
<input id="pic-userfile3" type="hidden" name="pic-userfile3" value=""  />
<input id="pic-userfile4" type="hidden" name="pic-userfile4" value=""  />-->
<fieldset>
	<legend>選擇您要申請的項目 訂單編號:<?php echo $lidm;?></legend>

<div>
        <div>選擇申請項目<span class="required">*</span></div>
						<?php foreach ($items as $item) :?>
							<div><input type="checkbox" value="<?php echo $item->id;?>" class="item" name="item"><?php echo $item->name;?></div>
						<?php endforeach;?>
		<div style="color:red;">勾選加入項目</div>
</div>

</fieldset>
<fieldset class="step-2">
	<legend>申請內容一覽（包含注意事項）</legend>
	<h4>申請單號</h4>
	<table>
					<thead>
						<tr>
					<th width="20%">申請項目</th>
					<th width="10%">單價</th>
					<th width="40%">備註</th>
					<th width="20%">數量</th>
					<th width="10%">小計</th>
					<!--<th width="10%">刪除項目</th>-->
					</tr>
					</thead>
					<tbody id="order-detail">

	</table>
	
	<hr/>
	&nbsp;&nbsp;選擇寄送方式<span class="required">*</span>
	<?php foreach ($shipment_items as $shipment_item):?>
	<input type="radio" class="shipment" value="<?php echo $shipment_item->fee;?>" name="shipment" datatype="*" nullmsg="請選擇寄送方式"><?php echo $shipment_item->method;?>
	<?php endforeach;?>
    <div class="text-right">
    <span style="font-size:18px;">運費NT$：<span id="shippment_fee">0</span></span><br>
    <input type="hidden" name="total_price_with_shipping" value="0" />
    <input type="hidden" name="shippment_fee" value="0" />
    <span style="font-size:18px;">金額NT$：<span id="total_price">0</span></span><br>
    <span style="font-size:18px;">總金額NT$：<span id="total_price_with_shipping" style="color:red;">0</span></span></div>

</fieldset>
<fieldset class="step-2">
<legend>填寫申請資料</legend>
    <div>
            <?php echo form_label('寄送地址', 'address'); ?> <span class="required">*</span>
            <input type="text" name="address"  datatype="*" nullmsg="請填寫訊息" placeholder="請填寫您要寄送的地址">
    </div>
    <div>
            <?php echo form_label('聯繫電話', 'tel'); ?> <span class="required">*</span>
            <input type="text" name="tel" datatype="n" errormsg="請填寫手機號碼" placeholder="請輸入可以聯繫到您的（行動）電話">
    </div>
    <div>
            <?php echo form_label('E-mail', 'email'); ?> <span class="required">*</span>
            <input type="text" name="email" datatype="e" errormsg="E-mail格式錯誤" nullmsg="Email不能為空" placeholder="請輸入您的電子郵件信箱，以便寄送通知信">
    </div>
    <div>
            <?php echo form_label('申請文件備註', 'order_remark'); ?>
            <input type="text" name="order_remark" placeholder="如您所申請的文件為需填寫學年度(上下學期),請在此說明">
    </div>
    <div class="upload">
            <?php echo form_label('上傳證件影本', 'userfile'); ?> <span class="required">*</span>
            
            <input type="file" name="userfile" id="userfile"/>
            <p class="small indent">請先上傳影本圖檔再進行其他項目填寫</p>
            <p class="small indent"><input id="uploadfile" type="button" value="上傳" onclick="ajaxFileUpload();return false;"></p>
    </div>
    <!--<div class="upload">
            <?php echo form_label('上傳證件影本', 'userfile'); ?> <span class="required">*</span>
            
            <input type="file" name="userfile3" id="userfile3"/>
            <input type="file" name="userfile4" id="userfile4"/>
            
               
            
            <p class="small indent"><input id="uploadfile" type="button" value="上傳"></p>
    </div>-->
    <div id="uploaded">
            <?php echo form_label('上傳證件影本', 'userfile'); ?> <span class="required">*</span>

            <span style="color:green;">影本圖檔已上傳</span>
    </div>
	</fieldset>
	<div class="text-right step-3">
		<br/>
		<input type="submit" name="submit" value="提出申請" /> 或 <?php echo anchor(SITE_AREA .'/content/order', lang('order_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
<script type="text/javascript">
$('#uploaded').hide();
//$('.step-3').show();
function ajaxFileUpload()
{
    $("#loading")
    .ajaxStart(function(){
        $(this).show();
    })
    .ajaxComplete(function(){
        $(this).hide();
    });
    //$('#uploadfile').click(function(){
    //$('input:file').each(function(){
    //console.log(this);
    //var picture=$(this).attr('id');
    $.ajaxFileUpload
    (
        {
            url: <?php echo '"'.base_url().'index.php/admin/content/order/uploads"';?>, 
            secureuri:false,
            fileElementId: 'userfile',
            dataType: 'json',
            success: function (data, status)
            {
                if(typeof(data.error) != 'undefined')
                {
                    if(data.error != '')
                    {
                        alert(data.error);
                    }else
                    {
                      
                      $('#pic-userfile').val(data.msg);
                      console.log(data);
                       $('.upload').hide();
                        $('#uploaded').show();
                        $('.step-3').show();
                    
                    }
                }
                
            },
            error: function (data, status, e)
            {
                alert(e);
            }
        }
    )
    //});
   
   //});

    
    return false;
 
}
</script>