<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<div id="ajax-content">
<?php if (isset($user) ) : ?>
<p class="small"><?php echo lang('bf_required_note'); ?>切換<a class="ajaxify" href="<?php echo site_url(SITE_AREA .'/settings/users/view/'. $user->id); ?>">檢視模式</a></p>
<?php else:?>
<?php endif;?>
<?php if (isset($user) && $user->role_name == 'Banned') : ?>
<div class="notification attention">
	<p><?php echo lang('us_banned_admin_note'); ?></p>
</div>
<?php endif; ?>
<?php if (isset($user) ) : ?>
<p class="small">*點選照片可上傳圖檔</p>
<div class="box good rounded" id="slide_upload">
	<h3>上傳照片</h3>
	<p>從電腦選取照片
		<?php echo form_open_multipart(SITE_AREA .'/settings/users/uploads','class="constrained"');?>
			<input id="id" type="hidden" name="id" value="<?php echo isset($user) ? $user->id : set_value('id') ?>" />
			<input type="file" name="userfile"/>
			<div class="text-right">
					<input type="submit" name="upload" value="上傳" />
			</div>
		<?php echo form_close(); ?>
	</p>
</div>
<?php endif;?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
	<div>
		<img src="<?php echo base_url().'user_img/'?><?php echo isset($user) ? $user->photo : 'default.png'; ?>" alt="照片" id="photo_btn">
	</div>
	
	<div>
		<label for="last_name"><?php echo lang('us_last_name'); ?></label>
		<input type="text" name="last_name" value="<?php echo isset($user) ? $user->last_name : set_value('last_name') ?>" />
	</div>
	
	<div>
		<label for="first_name"><?php echo lang('us_first_name'); ?></label>
		<input type="text" name="first_name" value="<?php echo isset($user) ? $user->first_name : set_value('first_name') ?>" />
	</div>
	
	<div>
		<label for="title"><?php echo lang('us_title'); ?></label>
		<input type="text" id="title" name="title" value="<?php echo isset($user) ? $user->title : set_value('title') ?>" />
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
	
	<div>
		<label for="ext"><?php echo lang('us_ext'); ?></label>
		<input type="text" name="ext" value="<?php echo isset($user) ? $user->ext : set_value('ext') ?>" />
	</div>
	
	<div>
		<label class="required" for="email"><?php echo lang('bf_email'); ?></label>
		<input type="text" name="email" class="medium" value="<?php echo isset($user) ? $user->email : set_value('email') ?>" />
	</div>
	
	<div>
		<label class="required" for="website"><?php echo lang('bf_website'); ?></label>
		<input type="text" name="website" class="medium" value="<?php echo isset($user) ? $user->website : set_value('website') ?>" />
	</div>
	
	<?php if ( $this->settings_lib->item('auth.login_type') !== 'email' OR $this->settings_lib->item('auth.use_usernames')) : ?>
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
	
	<?php if (has_permission('Bonfire.Roles.Manage')) :?>
	<fieldset>
		<legend><?php echo lang('us_role'); ?></legend>
		
		<div>
			<label for="role_id"><?php echo lang('us_role'); ?></label>
			<select name="role_id">
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
	
	<div class="submits">
		<?php if (isset($user) ) : ?>
		<div id="error_alert" style="color: red;">系統訊息：＂密碼＂與＂再輸入一次密碼＂內容不一致，因此系統自動禁用儲存按鈕，請修正並再試一次</div>
		<?php endif;?>
		<input type="submit" id="submit" name="submit" value="<?php echo lang('bf_action_save') ?> " /> <?php echo lang('bf_or') ?> <?php echo anchor(SITE_AREA .'/settings/users', lang('bf_action_cancel')); ?>
	</div>

	<?php if (isset($user) && has_permission('Permissions.'.$user->role_name.'.Manage') && $user->id != $this->auth->user_id()) : ?>
	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/settings/users/delete/'. $user->id); ?>" onclick="return confirm('<?php echo lang('us_delete_account_confirm'); ?>')"><?php echo lang('us_delete_account'); ?></a>
		
		<?php echo lang('us_delete_account_note'); ?>
	</div>
	<?php endif; ?>
<?php echo form_close(); ?>

<script>
	$(function() {function runEffect() {
			var selectedEffect = "slide";

			$( "#slide_upload" ).show(selectedEffect,600);
		};
		$( "#slide_upload" ).hide();
		$( "#photo_btn" ).toggle(function() {
			runEffect();
			return false;
		},function() {$( "#slide_upload" ).hide("drop",600);
		});
		
		});
	head.ready(function() {
		var availableTags = [
			"教授",
			"助理教授",
			"講師",
			"博士",
			"碩士",
			"老師",
			"學士",
			"行政助理",
			"主任",
			"校長",
			"系主任",
			"系助理",
			"院助理",
			"工讀生",
			"同學",
			"專業人士",
			"老闆",
			"總經理",
			"員工"
		];
		$( "#title" ).autocomplete({
			source: availableTags
		});
	});
</script>

</div>