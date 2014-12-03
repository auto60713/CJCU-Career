
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
<div>
        <?php echo form_label('Name', 'name'); ?> <span class="required">*</span>
        <input id="name" type="text" name="name" maxlength="30" value="<?php echo set_value('name', isset($itmes['name']) ? $itmes['name'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Price', 'price'); ?> <span class="required">*</span>
        <input id="price" type="text" name="price" maxlength="11" value="<?php echo set_value('price', isset($itmes['price']) ? $itmes['price'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Fee', 'fee'); ?> <span class="required">*</span>
        <input id="fee" type="text" name="fee" maxlength="3" value="<?php echo set_value('fee', isset($itmes['fee']) ? $itmes['fee'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Working Day', 'working_day'); ?> <span class="required">*</span>
        <input id="working_day" type="text" name="working_day" maxlength="2" value="<?php echo set_value('working_day', isset($itmes['working_day']) ? $itmes['working_day'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Notice', 'notice'); ?>
        <input id="notice" type="text" name="notice" maxlength="50" value="<?php echo set_value('notice', isset($itmes['notice']) ? $itmes['notice'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Remark', 'remark'); ?>
        <input id="remark" type="text" name="remark" maxlength="100" value="<?php echo set_value('remark', isset($itmes['remark']) ? $itmes['remark'] : ''); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create itmes" /> or <?php echo anchor(SITE_AREA .'/developer/itmes', lang('itmes_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
