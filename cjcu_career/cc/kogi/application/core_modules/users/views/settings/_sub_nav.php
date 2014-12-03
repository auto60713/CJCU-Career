<div id="sub-nav" class="button-group">
	<a href="<?php echo site_url(SITE_AREA .'/settings/users/edit/'.$user->id) ?>" <?php echo $this->uri->segment(4) == 'edit' ? 'class="current"' : '' ?> >編輯模式</a>
	<a href="<?php echo site_url(SITE_AREA .'/settings/users/view/'.$user->id) ?>" <?php echo $this->uri->segment(4) == 'view' ? 'class="current"' : '' ?> >檢視模式</a>
</div>