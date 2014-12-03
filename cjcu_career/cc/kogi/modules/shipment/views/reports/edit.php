
<?php if (validation_errors()) :; ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($shipment) ) {
	$shipment = (array)$shipment;
}
$id = isset($shipment['id']) ? "/".$shipment['id'] : '';
; ?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($shipment['id'])):; ?><input id="id" type="hidden" name="id" value="<?php echo $shipment['id']; ?>"  /><?php endif; ?>
<div>
        <?php echo form_label('Method', 'method'); ?> <span class="required">*</span>
        <input id="method" type="text" name="method" maxlength="20" value="<?php echo set_value('method', isset($shipment['method']) ? $shipment['method'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Fee', 'fee'); ?> <span class="required">*</span>
        <input id="fee" type="text" name="fee" maxlength="3" value="<?php echo set_value('fee', isset($shipment['fee']) ? $shipment['fee'] : ''); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Edit shipment" /> or <?php echo anchor(SITE_AREA .'/reports/shipment', lang('shipment_cancel')); ?>
	</div>
	<?php echo form_close(); ?>

	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/reports/shipment/delete/'. $id); ?>" onclick="return confirm('<?php echo lang('shipment_delete_confirm'); ?>')"><?php echo lang('shipment_delete_record'); ?></a>
		
		<h3><?php echo lang('shipment_delete_record'); ?></h3>
		
		<p><?php echo lang('shipment_edit_text'); ?></p>
	</div>
