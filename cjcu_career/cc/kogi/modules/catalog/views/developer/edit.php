
<?php if (validation_errors()) :; ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($catalog) ) {
	$catalog = (array)$catalog;
}
$id = isset($catalog['id']) ? "/".$catalog['id'] : '';
; ?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($catalog['id'])):; ?><input id="id" type="hidden" name="id" value="<?php echo $catalog['id']; ?>"  /><?php endif; ?>
<div>
        <?php echo form_label('Catalog', 'catalog'); ?> <span class="required">*</span>
        <input id="catalog" type="text" name="catalog" maxlength="20" value="<?php echo set_value('catalog', isset($catalog['catalog']) ? $catalog['catalog'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Sort', 'sort'); ?>
        <input id="sort" type="text" name="sort" maxlength="2" value="<?php echo set_value('sort', isset($catalog['sort']) ? $catalog['sort'] : ''); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Edit catalog" /> or <?php echo anchor(SITE_AREA .'/developer/catalog', lang('catalog_cancel')); ?>
	</div>
	<?php echo form_close(); ?>

	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/developer/catalog/delete/'. $id); ?>" onclick="return confirm('<?php echo lang('catalog_delete_confirm'); ?>')"><?php echo lang('catalog_delete_record'); ?></a>
		
		<h3><?php echo lang('catalog_delete_record'); ?></h3>
		
		<p><?php echo lang('catalog_edit_text'); ?></p>
	</div>
