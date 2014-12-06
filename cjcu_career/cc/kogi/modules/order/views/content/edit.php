
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($order) ) {
	$order = (array)$order;
}
$id = isset($order['id']) ? "/".$order['id'] : '';
?>
<h1><?php echo lang('order_edit_heading');?></h1>
<h5>狀態：<?php 
								$result=$this->orderstatus_model->find_by('id',$order['status']);
								echo $result->name;
							?>
</h5>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($order['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $order['id'];?>"  /><?php endif;?>

<fieldset>
	<legend><?php echo lang('order_id').'：'.set_value('lidm', isset($order['lidm']) ? $order['lidm'] : ''); ?></legend>
	<table>
					<thead>
						<tr>
					<th>申請項目</th>
					<th>製作工時</th>
					<th>注意事項</th>
					</tr>
					</thead>
					<tbody>
			
						
						<?php foreach ($query as $value):?>
							<?php foreach($value as $apply):?>
							<tr>
								<td><?php echo $apply['name'];?></td>
								<td><?php echo $apply['working_day'];?>個工作天</td>
								<td><?php echo $apply['notice'];?></td>
							</tr>
						<?php endforeach;?>
					<?php endforeach;?>
						
			
					</tbody>
	</table>
	<hr/>
	<div class="text-right">總金額：NT$<?php echo $order['amount']+$order['shipment_fee'];?></div>	
</fieldset>
<fieldset>
					
						<legend><?php echo lang('order_extra_info'); ?></legend>
						
						<div>
										<?php echo lang('order_created_on').":"; ?>
										<?php echo set_value('created_on', isset($order['created_on']) ? $order['created_on'] : ''); ?>
						</div>

						<div>
										<?php echo lang('order_ip').":"; ?>
										<?php echo set_value('ip', isset($order['ip']) ? $order['ip'] : ''); ?>
						</div>
						<div>
										<?php echo lang('order_address').":"; ?>
										<?php echo set_value('address', isset($order['address']) ? $order['address'] : ''); ?>
						</div>
						<div>
										<?php echo lang('order_remark').":"; ?>
										<?php echo set_value('remark', isset($order['remark']) ? $order['remark'] : ''); ?>
						</div>
						<div>
										<?php echo lang('order_user_remark').":"; ?>
										<?php echo set_value('order_remark', isset($order['order_remark']) ? $order['order_remark'] : ''); ?>
						</div>
						
					
</fieldset>
<FIELDSET>
	<LEGEND>證件影本</LEGEND>
	<div>
		<img width="300px" id="pic" src="<?php echo base_url().'doc_img/'.$order['pic-userfile'];?>">
		<input type="hidden" id="pic-userfile" name="pic-userfile" value="<?php echo $order['pic-userfile'];?>">
		<input type="hidden" name="shipment_fee" value="<?php echo $order['shipment_fee'];?>">
		<input type="hidden" name="amount" value="<?php echo $order['amount'];?>">
	</div>
</FIELDSET>
<?php if ($this->auth->has_permission('Order.Content.Users')):?>
	<?php if($order['status']==2):?>
<fieldset>
					
						
									<legend>經審核後您有缺件未補,請重新上傳證件</legend>
									<div class="upload"><?php echo form_label('上傳證件影本', 'userfile'); ?> <span class="required">*</span>
            
						            <input type="file" name="userfile" id="userfile"/>
						            <p class="small indent"><input id="uploadfile" type="button" value="上傳" onclick="ajaxFileUpload();return false;"></p></div>
						            <div id="uploaded"><p class="small indent">上傳成功</p></div>
						
					
</fieldset>
<?php endif;?>
<?php endif;?>
<?php if ($this->auth->has_permission('Order.Content.Regis')||$this->auth->has_permission('Order.Content.Career')):?>
<fieldset>
					
						
									<legend><?php echo lang('order_add_remark'); ?>(如審核未過，請填寫原因)</legend>
									<div>
													<?php echo form_label(lang('order_remark'), 'remark'); ?>
										<?php echo form_textarea( array( 'name' => 'remark', 'id' => 'remark', 'rows' => '5', 'cols' => '80', 'value' => set_value('remark', isset($order['remark']) ? $order['remark'] : '') ) )?>
									</div>
									<div>
												<?php echo form_label(lang('order_status'), 'status'); ?>
												<select name="status">
												<?php foreach ($order_status as $status_row) :?>
												  <option value ="<?php echo $status_row->id;?>" <?php if($order['status']==$status_row->id){ echo 'selected="selected"';}?>><?php echo $status_row->name;?></option>
												<?php endforeach;?>
												</select>
									</div>
						
					
</fieldset>
<?php endif;?>
<?php if ($this->auth->has_permission('Order.Content.As')):?>
	<?php if($order['status']!=4):?>
<div class="box good rounded">
		<a class="button" href="<?php echo site_url(SITE_AREA .'/content/order/signal/'.$id.'/4'); ?>">確認已收款</a>

		<h3><?php echo lang('order_actions_dept_title'); ?></h3>

		<p><?php echo lang('order_actions_dept_description');?>會計部門，點擊按鈕確認帳款</p>
</div>
<?php endif;?>
<?php endif;?>
	
					
	
		



<div>
        <input id="lidm" type="hidden" name="lidm" maxlength="17" value="<?php echo set_value('lidm', isset($order['lidm']) ? $order['lidm'] : ''); ?>"  />
</div>

<?php if (!$this->auth->has_permission('Order.Content.As')):?>
	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="<?php echo lang('order_edit');?>" /><?php echo lang('order_or');?>
		<?php echo anchor(SITE_AREA .'/content/order', lang('order_cancel')); ?>
	</div>
<?php endif;?>
	<?php echo form_close(); ?>
<?php if($this->auth->has_permission('Order.Content.Career')):?>
<?php if($order['deleted']==0):?>	
	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/content/order/delete/'. $id); ?>" onclick="return confirm('<?php echo lang('order_delete_confirm'); ?>')"><?php echo lang('order_delete_record'); ?></a>

		<h3><?php echo lang('order_delete_record'); ?></h3>

		<p><?php echo lang('order_delete_text'); ?></p>
	</div>
<?php endif;?>
<?php endif;?>
<script type="text/javascript">
$('#uploaded').hide();
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