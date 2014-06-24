
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>

$(function(){

$('#upload_btn').click(function(){



var file = $("#file1")[0].files[0];

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
$("#status").html( event.target.responseText);
$("#progressBar").val(0);
}

function errorHandler(event){
$("#status").html("上傳失敗");
}

function abortHandler(event){
$("#status").html("上傳取消");
}




});
</script>
</head>
<body>


<h2>HTML5 使用 AJAX 搭配「進度列」上傳檔案</h2>

<form id="upload_form" enctype="multipart/form-data" method="post">
  <input type="file" name="file1" id="file1"><br>
  <input type="button" value="Upload File" id="upload_btn"> 
  <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
  <h3 id="status"></h3>
  <p id="loaded_n_total"></p> 
</form>

</body>

</html>