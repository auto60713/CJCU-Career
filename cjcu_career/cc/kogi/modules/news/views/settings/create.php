
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($news) ) {
	$news = (array)$news;
}
$id = isset($news['id']) ? "/".$news['id'] : '';
?>
<div class="box good rounded">
  <div style="float:left; width:200px;height:165px;">
  <img width="180" height="119" src="http://placehold.it/180x119" alt="照片" id="photo_btn">
  </div>
    <h3>上傳標題照片</h3>
    <p>從電腦選取照片
      <form id="uploadfile" enctype="multipart/form-data" name="uploadfile" method="post" action="">
        <input type="file" name="userfile" id="userfile"/>
        <div class="text-right">
          <input id="uploadfile" type="button" value="上傳" onclick="ajaxFileUpload();return false;">  
        </div>
      </form>
    </p>
  </div>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($news['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $news['id'];?>"  /><?php endif;?>
<fieldset>
    <legend>新增最新消息</legend>
<div>
        <?php echo '標題:'; ?>
        <input id="title" type="text" name="title" maxlength="120" value="<?php echo set_value('title', isset($news['title']) ? $news['title'] : ''); ?>"  />
</div>
<div>
        <?php echo "文章分類:";?>
        <?php foreach ($catalogs as $catalog):?>
            <input type="radio" name="catalog" value="<?php echo $catalog->id;?>"><?php echo $catalog->catalog;?>
        <?php endforeach;?>
</div>
<div>
        <input type="hidden" id="pic" name="pic" value="">
        <input type="hidden" name="sticky" value="0">
        <input type="checkbox" name="published" value="1">立刻發佈 ｜ 
        日期：<input id="created_date" type="text" name="created_date" maxlength="14" value=""  />
        <script>head.ready(function(){$('#created_date').datepicker({ dateFormat: 'yy-mm-dd'});});</script>

</div>
<div>
        <script>head.ready(function() {$("textarea#content").ckeditor({});});</script>
        <textarea class="ckeditor" id="content" type="textarea" name="content" maxlength="120"><?php echo set_value('content', isset($news['content']) ? $news['content'] : ''); ?></textarea>
</div>
</fieldset>


	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="新增公告" /> 或 <?php echo anchor(SITE_AREA .'/settings/news', lang('news_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
<script>
function ajaxFileUpload()
{
    $("#loading")
    .ajaxStart(function(){
        $(this).show();
    })
    .ajaxComplete(function(){
        $(this).hide();
    });
     
    $.ajaxFileUpload
    (
        {
            url: <?php echo '"'.base_url().'index.php/admin/settings/news/uploads"';?>, 
            secureuri:false,
            fileElementId:'userfile',
            dataType: 'json',
            success: function (data, status)
            {
                if(typeof(data.error) != 'undefined')
                {
                    if(data.error != '')
                    {
                        alert(data.error);
                    }else
                    {
                      $('#pic').val(data.msg);
                        $('#photo_btn').attr('src',<?php echo '"'.base_url().'product_img/"';?>+data.msg);
                    }
                }
            },
            error: function (data, status, e)
            {
                alert(e);
            }
        }
    )
     
    return false;
 
}
</script>
