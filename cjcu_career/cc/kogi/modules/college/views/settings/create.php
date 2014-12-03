
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($college) ) {
	$college = (array)$college;
}
$id = isset($college['id']) ? "/".$college['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<fieldset>
	<legend>新增學院資料</legend>
<?php if(isset($college['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $college['id'];?>"  /><?php endif;?>
<div>
        <?php echo form_label('名稱', 'name'); ?>
        <input id="name" type="text" name="name" maxlength="25" value="<?php echo set_value('name', isset($college['name']) ? $college['name'] : ''); ?>"  />
</div>
<div>
        <?php echo form_label('描述', 'college_description'); ?>
        <input id="college_description" type="text" name="college_description" maxlength="50" value="<?php echo set_value('college_description', isset($college['college_description']) ? $college['college_description'] : ''); ?>"  />
</div>
</fieldset>


	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="新增學院" /> 或 <?php echo anchor(SITE_AREA .'/settings/college', lang('college_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
