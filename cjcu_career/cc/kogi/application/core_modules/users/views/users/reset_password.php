<h2>重設您的密碼</h2>

<p>輸入您要使用的新密碼</p>

<?php if (auth_errors() || validation_errors()) : ?>
<div class="notification error">
	<?php echo auth_errors() . validation_errors(); ?>
</div>
<?php endif; ?>

<?php echo form_open(current_url()) ?>
	<input type="hidden" name="user_id" value="<?php echo $user->id ?>" />

	<label for="password"><?php echo lang('bf_password'); ?></label>
	<input type="password" name="password" placeholder="密碼..." />
	<p class="small"><?php echo lang('us_password_mins'); ?></p>
	
	<label for="pass_confirm"><?php echo lang('bf_password_confirm'); ?></label>
	<input type="password" name="pass_confirm" placeholder="再輸入一次..." />
	
	<div class="submits">
		<input type="submit" name="submit" value="更改密碼" />
	</div>

<?php echo form_close(); ?>