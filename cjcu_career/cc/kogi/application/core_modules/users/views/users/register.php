<h2>註冊</h2>

<?php if (auth_errors() || validation_errors()) : ?>
<div class="notification error">
	<?php echo auth_errors() . validation_errors(); ?>
</div>
<?php endif; ?>

<?php echo form_open($this->uri->uri_string()); ?>

	<label for="email"><?php echo lang('bf_email'); ?></label>
	<input type="text" name="email" id="email"  value="<?php echo set_value('email'); ?>"  placeholder="Email" />
	
	<?php if ( $this->settings_lib->item('auth.login_type') !== 'email' OR $this->settings_lib->item('auth.use_usernames') == 1): ?>
		<label for="username"><?php echo lang('bf_username'); ?></label>
		<input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="使用者名稱" />
	<?php endif; ?>
	<br/>
	<?php if ($this->settings_lib->item('auth.use_own_names')) : ?>
	<div>
		<label><?php echo lang('us_first_name'); ?></label>
		<input type="text" id="first_name" name="first_name" value="<?php echo set_value('first_name') ?>" />

		<label><?php echo lang('us_last_name'); ?></label>
		<input type="text" id="first_name" name="last_name" value="<?php echo set_value('last_name') ?>"  />
	</div>

	<?php endif; ?>	
	<div>
		<label for="password"><?php echo lang('bf_password'); ?></label>
		<input type="password" name="password" id="password" value="" placeholder="密碼" />
		<p class="small"><?php echo lang('us_password_mins'); ?></p>
	
		<label for="pass_confirm"><?php echo lang('bf_password_confirm'); ?></label>
		<input type="password" name="pass_confirm" id="pass_confirm" value="" placeholder="<?php echo lang('bf_password_confirm'); ?>" />
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
		<input type="submit" name="submit" id="submit" value="<?php echo lang('us_register'); ?>"  />	
	</div>

<?php echo form_close(); ?>

<p style="text-align: center">
	<?php echo lang('us_already_registered'); ?> <?php echo anchor('/login', lang('bf_action_login')); ?>
</p>
	
		