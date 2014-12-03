
	
<?php  
	// acessing our userdata cookie
	$cookie = unserialize($this->input->cookie($this->config->item('sess_cookie_name')));
	$logged_in = isset ($cookie['logged_in']);
	unset ($cookie);
		
	if ($logged_in) : 
				redirect('admin');
		?>
	

	
	
	
<?php else : ?>
	<p style="text-align: center">
		<?php echo anchor('/login', '登入'); ?>
	</p>

<?php endif; ?>