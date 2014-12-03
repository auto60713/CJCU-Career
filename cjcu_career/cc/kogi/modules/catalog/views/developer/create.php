
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
		<input type="submit" name="submit" value="Create catalog" /> or <?php echo anchor(SITE_AREA .'/developer/catalog', lang('catalog_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
