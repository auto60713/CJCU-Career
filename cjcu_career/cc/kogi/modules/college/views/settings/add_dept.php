<?php if (validation_errors()) :?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<div id="ajax-content">

<?php echo form_open('admin/settings/college/add_dept', 'class="constrained ajax-form"'); ?>
<fieldset>
	<legend>新增系所名稱</legend>
	<?php if(isset($check)):?>
<input id="id" type="hidden" name="id" value="<?php echo $check; ?>" />
<?php endif; ?>
<div>
<label for="dept_name">系所名稱</label>
<input id="dept_name" type="text" name="dept_name" maxlength="25"  />
<p class="small indent">中文不得超過25字，英文以50字元為限</p>
</div>
</fieldset>
<div class="text-right">
<br/>
<input type="submit" name="submit" value="確認新增" />或<?php echo anchor(SITE_AREA .'/settings/college/edit/'.$check, '取消','class="ajaxify"'); ?>
</div>
<?php echo form_close(); ?>
</div>