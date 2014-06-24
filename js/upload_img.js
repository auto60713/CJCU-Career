
// upload profile image

$(function(){

	// init to hide this ui
	$('#upload-profile-lightbox').hide();


	$('#upload-close, #upload-btn-close').click(function(event) {
		$('#upload-profile-lightbox').hide();
	});

	$('#profile-img').click(function(event) {
		
		$("#status").html("");
		$('.upload-img-max').attr('src','');
		$('.upload-img-min').attr('src','');
		$('#upload-profile-lightbox').show();

	});	


	$('#file1').change(function(event) {

		$(this).attr('disabled', 'true');

		var file = $(this)[0].files[0];
		var formdata = new FormData();
		formdata.append("file1", file);

		var ajax = new XMLHttpRequest();

		ajax.upload.addEventListener("progress", progressHandler, false);

		ajax.addEventListener("load", completeHandler, false);
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);

		ajax.open("POST", "image_upload.php");
		ajax.send(formdata);

		
	});


	function progressHandler(event){
	$("#loaded_n_total").html("Uploaded "+event.loaded+" bytes of "+event.total);
	var percent = (event.loaded / event.total) * 100;
	$("#progressBar").val(Math.round(percent));
	$("#status").html(Math.round(percent)+"% 上傳中...請稍候");

	}

	function completeHandler(event){
	$("#status").html("上傳完成");
	$("#progressBar").val(0);
	$('#file1').removeAttr('disabled');
	$('.upload-img-max').attr('src',event.target.responseText);
	$('.upload-img-min').attr('src',event.target.responseText);
	$('#profile-img').attr('src',event.target.responseText);
	}

	function errorHandler(event){
	$("#status").html("上傳失敗");
	}

	function abortHandler(event){
	$("#status").html("上傳取消");
	}





});

