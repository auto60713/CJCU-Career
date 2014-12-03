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
<?php if($news['published']==0):?>
<div class="box good rounded">
      <a class="button constrained ajax-form" href="<?php echo site_url(SITE_AREA .'/settings/news/publish'. $id);?>">發佈</a>
    <h3>此公告尚未發佈</h3>
    <p>如要發佈此公告，請點選右側發佈按鈕</p>
</div>
<?php endif;?>
<div class="box good rounded">
  <div style="float:left; width:200px;height:165px;">
  <img width="180" height="119" src="<?php if(!empty($news['pic'])){ echo base_url().'product_img/'.$news['pic'];}else{echo "http://placehold.it/180x119";}?>" alt="照片" id="photo_btn">
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
    <legend>最新消息編輯</legend>
<div>
        <?php echo '標題：' ?>
        <input id="title" type="text" name="title" maxlength="120" value="<?php echo set_value('title', isset($news['title']) ? $news['title'] : ''); ?>"  />
        <input type="hidden" id="pic" name="pic" value="<?php echo $news['pic'];?>">
        <input type="hidden" id="published" name="published" value="<?php echo $news['published'];?>">
        <br>日期： <input id="created_date" type="text" name="created_date" maxlength="14" value="<?php echo set_value('created_date', isset($news['created_date']) ? date("Y-m-d",strtotime($news['created_date'])) : ''); ?>"  />
        <script>head.ready(function(){$('#created_date').datepicker({ dateFormat: 'yy-mm-dd'});});</script>
</div>
<div>
        <?php echo "文章分類:";?>
        <?php foreach ($catalogs as $catalog):?>
            <?php if($catalog->id==$news['catalog']):?>
                <input type="radio" name="catalog" value="<?php echo $catalog->id;?>" checked><?php echo $catalog->catalog;?>
            <?php else:?>
                <input type="radio" name="catalog" value="<?php echo $catalog->id;?>"><?php echo $catalog->catalog;?>
            <?php endif;?>
        <?php endforeach;?>
</div>



<div>
        <script>head.ready(function() {$("textarea#content").ckeditor({});});</script>
        <textarea class="cleditor" id="content" type="textarea" name="content" maxlength="120"><?php echo set_value('content', isset($news['content']) ? $news['content'] : ''); ?></textarea>
</div>
</fieldset>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="確定編輯" /> 或 <?php echo anchor(SITE_AREA .'/settings/news', lang('news_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
  <div class="box delete rounded">
    <a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/settings/news/publish'. $id.'/1'); ?>">文章下架</a>
    
    <h3>文章下架</h3>
    
    <p>此功能可使最新消息文章暫時下架，之後可由後台再次發佈</p>
  </div>
	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/settings/news/delete/'. $id); ?>" onclick="return confirm('<?php echo lang('news_delete_confirm'); ?>')"><?php echo lang('news_delete_record'); ?></a>
		
		<h3><?php echo lang('news_delete_record'); ?></h3>
		
		<p><?php echo lang('news_del_text'); ?></p>
	</div>
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
                        $('#photo_btn').attr('src','http://www.aesolution.com.tw/ae/product_img/'+data.msg);
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

