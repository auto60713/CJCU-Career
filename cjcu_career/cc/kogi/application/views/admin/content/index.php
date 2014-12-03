<div id="ajax-content">

<style>
	td {
		vertical-align: baseline;
	}
	tr:hover {
		background: #f6f6f6;
		border-top: 1px solid #e7e7e7;
		border-bottom: 1px solid #e7e7e7;
	}
</style>

<br/>

	<p><?php echo $users -> last_name . $users -> first_name;?>您好，歡迎使用<?php echo $this->settings_lib->item('site.title')?></p>


<?php echo form_open(); ?>

<div>
	<div class="tabs">
		<ul>
			<li>
				<a href="#tabs-1">快速功能表</a>
			</li>
		</ul>
		<div id="tabs-1">
			<div>		
						<!--<a class="button good" href="<?php echo site_url().'/admin/settings/banner';?>">輪播管理</a>-->
						<a class="button good" href="<?php echo site_url().'/admin/settings/news';?>">最新消息管理</a>
						<a class="button good" href="<?php echo site_url().'/admin/settings/users';?>">後台使用者管理</a>
			</div>
			</div>

		</div>
</div>
</div>
<?php echo form_close();?>
<?php echo form_open(); ?>
<div>
	<div class="tabs">
		<ul>
			<li>
				<a href="#tabs-1">基本個人資料</a>
			</li>
		</ul>
		<div id="tabs-1">
			<div>		
						<br><br><br><br><br><br><br><br>需與交換機連線<br><br><br><br><br><br><br><br><br>
			</div>
			</div>

		</div>
</div>

	<?php echo form_close(); ?>

<script>
	head.ready(function() {
		$(".tabs").tabs();
	}); 
</script>
</div>