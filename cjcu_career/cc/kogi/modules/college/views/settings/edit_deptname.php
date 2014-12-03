<?php if (validation_errors()) :?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<div id="ajax-content">
	<?php echo form_open($this -> uri -> uri_string(), 'class="constrained ajax-form"'); ?>
	<fieldset>
	<legend>編輯系所名稱</legend>
	<?php if(isset($dept)):?>
	<input id="id" type="hidden" name="id" value="<?php echo $dept->id?>" />
	<?php endif; ?>
	
	<div>
		<label for="dept_name">系所名稱</label>
		<input id="dept_name" type="text" name="dept_name" maxlength="25" value="<?php echo set_value('dept_name', isset($dept) ? $dept->dept_name : ''); ?>" />
	    <p class="small indent">中文不得超過25字，英文以50字元為限</p>
	</div>
	<input id="college_id" type="hidden" name="college_id" value="<?php echo $dept->college_id?>" />
	</fieldset>
	<div class="text-right">
		<input type="submit" name="submit" value="確認編輯"  />或<?php echo anchor(SITE_AREA .'/settings/college/edit/'.$dept->college_id, '取消','class="ajaxify"'); ?>
	</div>
	<?php echo form_close(); ?>
</div>


