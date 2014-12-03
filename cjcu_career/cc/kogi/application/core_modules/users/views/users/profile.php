<h2><?php echo lang('us_edit_profile'); ?></h2>

<?php if (auth_errors() || validation_errors()) : ?>
<div class="notification error">
	<?php echo auth_errors() . validation_errors(); ?>
</div>
<?php endif; ?>

<p class="small"><?php echo lang('bf_required_note'); ?></p>

<?php if (isset($user) && $user->role_name == 'Banned') : ?>
<div class="notification attention">
	<p><?php echo lang('us_banned_admin_note'); ?></p>
</div>
<?php endif; ?>

<?php echo form_open($this->uri->uri_string()); ?>

	<div>
		<label for="first_name"><?php echo lang('us_first_name'); ?></label>
		<input type="text" name="first_name" value="<?php echo isset($user) ? $user->first_name : set_value('first_name') ?>" />
	</div>

	<div>
		<label for="last_name"><?php echo lang('us_last_name'); ?></label>
		<input type="text" name="last_name" value="<?php echo isset($user) ? $user->last_name : set_value('last_name') ?>" />
	</div>
	
	<div>
		<label class="required" for="email"><?php echo lang('bf_email'); ?></label>
		<input type="text" name="email" class="medium" value="<?php echo isset($user) ? $user->email : set_value('email') ?>" />
	</div>
	
	<?php if ( config_item('auth.login_type') !== 'email' OR config_item('auth.use_usernames')) : ?>
	<div>
		<label for="username"><?php echo lang('bf_username'); ?></label>
		<input type="text" name="username" id="username" class="medium" value="<?php echo isset($user) ? $user->username : set_value('username') ?>" />
	</div>
	<?php endif; ?>

	<br />	
	<div>
		<label class="required" for="password"><?php echo lang('bf_password'); ?></label>
		<input type="password" id="password" name="password" value="" />
	</div>
	<div>
		<label class="required" for="pass_confirm"><?php echo lang('bf_password_confirm'); ?></label>
		<input type="password" id="pass_confirm" name="pass_confirm" value="" />
	</div>
	
	<div>
        <?php echo form_label('任職於', 'dept_id'); ?>
        <?php if (isset($user) && is_array($user) && count($user)) : ?>
        <select name="dept_id">
				<?php foreach ($dept as $dept_list):?>
				<option value="<?php echo $dept_list['id'];?>" <?php if($user->dept_id==$dept_list['id']){echo 'selected="selected"';}?>><?php echo $dept_list['dept_name'];?></option>
				<?php endforeach;?>
		</select>
		<?php else:?>
			<select name="dept_id">
				<?php foreach ($dept as $dept_list):?>
				<option value="<?php echo $dept_list['id'];?>"><?php echo $dept_list['dept_name'];?></option>
				<?php endforeach;?>
		</select>
		<?php endif;?>
	</div> 
	<div class="submits">
		<input type="submit" name="submit" value="<?php echo lang('bf_action_save') ?> " />
	</div>

	<?php if (isset($user) && has_permission('Site.User.Manage')) : ?>
	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/settings/users/delete/'. $user->id); ?>" onclick="return confirm('<?php echo lang('us_delete_account_confirm'); ?>')"><?php echo lang('us_delete_account'); ?></a>
		
		<?php echo lang('us_delete_account_note'); ?>
	</div>
	<?php endif; ?>

<?php echo form_close(); ?>