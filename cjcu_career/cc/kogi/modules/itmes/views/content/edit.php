
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($itmes) ) {
	$itmes = (array)$itmes;
}
$id = isset($itmes['id']) ? "/".$itmes['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($itmes['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $itmes['id'];?>"  /><?php endif;?>
<br/>
<div>
        <?php echo form_label('項目名稱', 'name'); ?> <span class="required">*</span>
        <input id="name" type="text" name="name" maxlength="30" value="<?php echo set_value('name', isset($itmes['name']) ? $itmes['name'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('售價', 'price'); ?> <span class="required">*</span>
        <input id="price" type="text" name="price" maxlength="11" value="<?php echo set_value('price', isset($itmes['price']) ? $itmes['price'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('運費', 'fee'); ?> <span class="required">*</span>
        <input id="fee" type="text" name="fee" maxlength="3" value="<?php echo set_value('fee', isset($itmes['fee']) ? $itmes['fee'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('製作工時', 'working_day'); ?> <span class="required">*</span>
        <input id="working_day" type="text" name="working_day" maxlength="2" value="<?php echo set_value('working_day', isset($itmes['working_day']) ? $itmes['working_day'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('注意事項', 'notice'); ?>
        <input id="notice" type="text" name="notice" maxlength="50" value="<?php echo set_value('notice', isset($itmes['notice']) ? $itmes['notice'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('備註', 'remark'); ?>
        <input id="remark" type="text" name="remark" maxlength="100" value="<?php echo set_value('remark', isset($itmes['remark']) ? $itmes['remark'] : ''); ?>"  />
</div>

<fieldset>
        <legend>說明</legend>
        <div>請輸入您要指定的名稱以及描述這個狀態。<span style="color:red;">＊表示必填</span></div>
</fieldset>
<hr/>

	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="編輯" /> 或 <?php echo anchor(SITE_AREA .'/content/itmes', lang('itmes_cancel')); ?>
	</div>
	<?php echo form_close(); ?>

	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/content/itmes/delete/'. $id); ?>" onclick="return confirm('<?php echo lang('itmes_delete_confirm'); ?>')"><?php echo lang('itmes_delete_record'); ?></a>
		
		<h3><?php echo lang('itmes_delete_record'); ?></h3>
		
		<p><?php echo lang('itmes_edit_text'); ?></p>
	</div>
