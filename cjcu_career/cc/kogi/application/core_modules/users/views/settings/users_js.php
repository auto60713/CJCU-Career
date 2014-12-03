
$.subscribe('list-view/list-item/click', function(user_id) {
	$('#content').load('<?php echo site_url(SITE_AREA .'/settings/users/view/') ?>/'+ user_id, function(response, status, xhr){
		if (status != 'error')
		{
			
		}
	});
	
	
});


$('#role-filter').change(function(){
	
	var role = $(this).val();
	
	$('#user-list .list-item').css('display', 'block');
	
	if (role != '0')
	{
		$('#user-list .list-item[data-role!="'+ role +'"]').css('display', 'none');
	} 
});

		$("#error_alert").hide();

$("#password,#pass_confirm").blur(function () {
				var pass=$('#password').val();
				var pass_confirm=$('#pass_confirm').val();
				if(pass !=pass_confirm){
					$("#submit").attr("disabled",　true);
					$("#error_alert").show(1000);
				}else
				{
					$("#submit").attr("disabled",　false);
					$("#error_alert").hide();
				}
});
