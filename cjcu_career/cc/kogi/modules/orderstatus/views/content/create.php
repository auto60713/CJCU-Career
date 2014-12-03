
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($orderstatus) ) {
	$orderstatus = (array)$orderstatus;
}
$id = isset($orderstatus['serial']) ? "/".$orderstatus['serial'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($orderstatus['serial'])): ?><input id="serial" type="hidden" name="serial" value="<?php echo $orderstatus['serial'];?>"  /><?php endif;?>
<br>
<div>
        <?php echo form_label('名稱', 'name'); ?> <span class="required">*</span>
        <input id="name" type="text" name="name" maxlength="20" value="<?php echo set_value('name', isset($orderstatus['name']) ? $orderstatus['name'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('描述', 'description'); ?>
        <input id="description" type="text" name="description" maxlength="255" value="<?php echo set_value('description', isset($orderstatus['description']) ? $orderstatus['description'] : ''); ?>"  />
</div>

<fieldset>
	<legend>說明</legend>
	<div>請輸入您要指定的名稱以及描述這個狀態。<span style="color:red;">＊表示必填</span></div>
</fieldset>
<hr/>
	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="新增" /> 或 <?php echo anchor(SITE_AREA .'/content/orderstatus', lang('orderstatus_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
