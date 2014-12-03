<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<div id="ajax-content">
<p class="small"><?php echo lang('bf_required_note'); ?>切換<a class="ajaxify" href="<?php echo site_url(SITE_AREA .'/settings/users/edit/'. $user->id); ?>">編輯模式</a></p>

<?php if (isset($user) && $user->role_name == 'Banned') : ?>
<div class="notification attention">
	<p><?php echo lang('us_banned_admin_note'); ?></p>
</div>
<?php endif; ?>
<?php echo form_open($this->uri->uri_string()); ?>

	<div>
		<img src="<?php echo base_url().'user_img/'.$user->photo; ?>" alt="照片" id="photo_btn">
	</div>
	
	<div>
		<label for="last_name"><?php echo lang('us_last_name'); ?></label>
		<input type="text" readonly="readonly" name="last_name" value="<?php echo isset($user) ? $user->last_name : set_value('last_name') ?>" />
	</div>
	
	<div>
		<label for="first_name"><?php echo lang('us_first_name'); ?></label>
		<input type="text" readonly="readonly" name="first_name" value="<?php echo isset($user) ? $user->first_name : set_value('first_name') ?>" />
	</div>
	
	<div>
		<label for="title"><?php echo lang('us_title'); ?></label>
		<input type="text" readonly="readonly" name="title" value="<?php echo isset($user) ? $user->title : set_value('title') ?>" />
	</div>
	
	<div>
        <?php echo form_label('任職於', 'dept_id'); ?>
        <select name="dept_id" disabled="disabled">
				<?php foreach ($dept as $dept_list):?>
				<option value="<?php echo $dept_list['id'];?>" <?php if($user->dept_id==$dept_list['id']){echo 'selected="selected"';}?>><?php echo $dept_list['dept_name'];?></option>
				<?php endforeach;?>
		</select>
	</div>        
	
	<div>
		<label for="ext"><?php echo lang('us_ext'); ?></label>
		<input type="text" readonly="readonly" name="ext" value="<?php echo isset($user) ? $user->ext : set_value('ext') ?>" />
	</div>
	
	<div>
		<label class="required" for="email"><?php echo lang('bf_email'); ?></label>
		<input type="text" readonly="readonly" name="email" class="medium" value="<?php echo isset($user) ? $user->email : set_value('email') ?>" />
	</div>
	
	<div>
		<label class="required" for="website"><?php echo lang('bf_website'); ?></label>
		<input type="text" readonly="readonly" name="website" class="medium" value="<?php echo isset($user) ? $user->website : set_value('website') ?>" />
	</div>
	
	<?php if (has_permission('Bonfire.Roles.Manage')) :?>
	<fieldset>
		<legend><?php echo lang('us_role'); ?></legend>
		
		<div>
			<label for="role_id"><?php echo lang('us_role'); ?></label>
			<select name="role_id" disabled="disabled">
			<?php if (isset($roles) && is_array($roles) && count($roles)) : ?>
				<?php foreach ($roles as $role) : ?>
					<?php if (has_permission('Permissions.'. ucfirst($role->role_name) .'.Manage')) : ?>
				<option value="<?php echo $role->role_id ?>" <?php echo isset($user) && $user->role_id == $role->role_id ? 'selected="selected"' : '' ?> <?php echo !isset($user) && $role->default == 1 ? 'selected="selected"' : ''; ?>>
					<?php echo ucfirst($role->role_name) ?>
				</option>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			</select>
		</div>
	</fieldset>
	<?php endif; ?>

<?php echo form_close(); ?>
</div>