
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
<div>
        <?php echo form_label('Name', 'name'); ?> <span class="required">*</span>
        <input id="name" type="text" name="name" maxlength="20" value="<?php echo set_value('name', isset($orderstatus['name']) ? $orderstatus['name'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Description', 'description'); ?>
        <input id="description" type="text" name="description" maxlength="255" value="<?php echo set_value('description', isset($orderstatus['description']) ? $orderstatus['description'] : ''); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create orderstatus" /> or <?php echo anchor(SITE_AREA .'/developer/orderstatus', lang('orderstatus_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
