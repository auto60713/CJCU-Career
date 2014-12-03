<?php
// Setup our default assets to load.
Assets::add_js(array(Template::theme_url('js/jquery-1.5.2.min.js'),Template::theme_url('js/jquery.placeholder.min.js') ,Template::theme_url('js/jquery.form.js'), Template::theme_url('js/jquery-ui.min.js'),Template::theme_url('js/ui.js'),Template::theme_url('js/jwerty.js'),Template::theme_url('js/ckeditor/ckeditor.js'),Template::theme_url('js/ckeditor/adapters/jquery.js'),Template::theme_url('/js/highcharts.js'),Template::theme_url('/js/exporting.js'),Template::theme_url('js/jquery.wijmo-complete.1.4.0.min.js')), 'external', true);

if (isset($shortcut_data) && is_array($shortcut_data['shortcut_keys'])) {
	Assets::add_js($this -> load -> view('ui/shortcut_keys', $shortcut_data, true), 'inline');
}
?>
<!doctype html>
<html lang="zh">
	<head>
		<meta charset="UTF-8">
		<meta name="robots" content="noindex">
		<title><?php echo isset($toolbar_title) ? $toolbar_title . ' : ' : ''; ?> <?php echo $this->settings_lib->item('site.title')
			?></title>

		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">

		<?php echo Assets::css(null, 'screen', true); ?>

		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<script type="text/javascript" src="<?php echo base_url() .'assets/js/head.min.js' ?>"></script>
		
		<script>
			head.feature("placeholder", function() {
				var inputElem = document.createElement('input');
				return new Boolean('placeholder' in inputElem);
			});
		</script>
		
	</head>
	<body>

		<noscript>
			<p>
				請開啟Javascript功能
			</p>
		</noscript>

		<div id="message">
			<?php echo Template::message(); ?>
		</div>

		<div id="header">
			 
			<div id="toolbar">
				<div id="toolbar-right">
					<?php if(isset($shortcut_data) && is_array($shortcut_data['shortcuts']) && is_array($shortcut_data['shortcut_keys']) && count($shortcut_data['shortcut_keys'])):?><img src="<?php echo Template::theme_url('images/keyboard-icon.png') ?>" id="shortkeys_show" title="快速鍵" alt="Keyboard Shortcuts"/><?php endif; ?> <a href="" id="tb_email" title="<?php echo lang('bf_user_settings') ?>" target="_blank"><?php echo $this->settings_lib->item('auth.use_usernames') ? ($this->settings_lib->item('auth.use_own_names') ? $this->auth->user_name() : $this->auth->username()) : $this->auth->email() ?></a>
					<a href="<?php echo site_url('logout') ?>" id="tb_logout" title="Logout">Logout</a>
				</div>

				<h1><a href="<?php echo site_url(); ?>" target="_blank"><!--<img src="<?php echo Template::theme_url('images/title.png');?>">--><?php echo $this->settings_lib->item('site.title') ?></a></h1>

				<div id="toolbar-left">
					<?php echo context_nav() ?>
				</div>
				
			</div>

			<?php echo modules::run('subnav/subnav/index', $this -> uri -> segment(2)); ?>

			<div id="nav-bar">
				<?php if (isset($toolbar_title)) : ?>
				<h1><?php echo $toolbar_title ?></h1>
				<?php endif; ?>

				<?php Template::block('sub_nav', ''); ?>
			</div>
		</div>
		

		<div class="content-main <?php echo isset(Template::$blocks['nav_bottom']) ? 'with-bottom-bar' : '' ?>">
			<?php echo Template::yield(); ?>
		</div>

		<?php Template::block('nav_bottom', ''); ?>

		<div id="loader">
			<div class="box">
				<img src="<?php echo Template::theme_url()?>images/ajax_loader.gif" />
			</div>
		</div>

		<div id="shortkeys_dialog" title="快速鍵" style="display: none">
			<p>
				<?php echo lang('bf_keyboard_shortcuts') ?>
				<?php if (isset($shortcut_data) && is_array($shortcut_data['shortcut_keys'])): ?>
				<ul>
					<?php foreach($shortcut_data['shortcut_keys'] as $key => $data): ?>
					<li>
						<span><?php echo $data?></span> : <?php echo $shortcut_data['shortcuts'][$key]['description']; ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</p>
		</div>

		<div id="debug">
			
		</div>

		<script>
head.js(<?php echo Assets::external_js(null, true) ?>);
head.js(<?php echo Assets::module_js(true) ?>
	);
		</script>
		<?php echo Assets::inline_js(); ?>
	</body>
</html>
