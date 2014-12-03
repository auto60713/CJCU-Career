<!doctype html>
<html lang="zh-tw">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=980" />
	<meta name="description" content="">
	<title><?php echo config_item('site.title'); ?></title>
	<?php echo Assets::css(); ?>
	<?php echo Assets::external_js('head.min.js'); ?>
</head>
<body>
<div>
	<div class="page">

		<!-- Header -->
		<div class="head">
		
		

		</div>
		


		<div class="main">
			<?php
				// acessing our userdata cookie
				$cookie = unserialize($this->input->cookie($this->config->item('sess_cookie_name')));
				$logged_in = isset ($cookie['logged_in']);
				unset ($cookie);

				if ($logged_in) : ?>
			<div class="profile">
				<a href="<?php echo site_url();?>">首頁</a> |
				<a href="<?php echo site_url('admin');?>">進入管理後台</a> |
				<a href="<?php echo site_url('logout');?>">登出</a>
			</div>
			<?php endif;?>

			<?php echo Template::message(); ?>
			<?php echo isset($content) ? $content : Template::yield(); ?>

		</div>	<!-- /main -->
	</div>	<!-- /page -->

	<div class="foot">
		<?php if (ENVIRONMENT == 'development') :?>
			<p style="float: right; margin-right: 80px;">Page rendered in {elapsed_time} seconds, using {memory_usage}.</p>
		<?php endif; ?>

		<p>Powered by Kogi</p>
	</div>

	<div id="debug"></div>
</div>
</body>
</html>
