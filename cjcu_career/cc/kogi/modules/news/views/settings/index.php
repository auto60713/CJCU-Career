<style>
td { vertical-align: baseline; }
tr:hover { background: #f6f6f6; border-top: 1px solid #e7e7e7; border-bottom: 1px solid #e7e7e7; }
</style>
<div class="view split-view">
	
	<!-- News List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['title']) ? $record['id'] : $record['title']); ?></b><br/>
							<span class="small"><?php echo (empty($record['created_date']) ? lang('news_edit_text') : substr($record['created_date'],0,10));  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('news_no_records'); ?> <?php echo anchor(SITE_AREA .'/settings/news/create', lang('news_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- News Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/settings/news/create')?>"><?php echo lang('news_create_new_button');?></a>

				<h3><?php echo lang('news_create_new');?></h3>

				<p><?php echo lang('news_edit_text'); ?></p>
			</div>
			<br />
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
					<h2>目前系統已發佈的新聞稿</h2>
	<table>
		<thead>
			<tr>
		<th>標題</th>
		<th>內容</th>
		<th>發佈日期</th>
		<th>狀態</th>
		<th>文章分類</th>
		<th><?php echo lang('news_actions'); ?></th>
		</tr>
		</thead>
		<tbody>
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo mb_substr(strip_tags(str_replace(chr(0xC2).chr(0xA0),' ',html_entity_decode($record->title, ENT_QUOTES, 'UTF-8'))), 0, 30,'UTF-8') . '...'?></td>
				<td><?php echo mb_substr(strip_tags(str_replace(chr(0xC2).chr(0xA0),' ',html_entity_decode($record->content, ENT_QUOTES, 'UTF-8'))), 0, 20,'UTF-8') . '..'?></td>
				<td><?php echo substr ($record->created_date, 0,10);?></td>
				<td><?php if($record->published==0){echo '<span style="color:red;">未發佈</span>';}else if($record->sticky==1){echo '<img width="16px" src="'.Template::theme_url('images/pin.png').'">已發佈';}else{echo '已發佈';}?></td>
				<td><?php $catalog_name=$this->catalog_model->find($record->catalog);echo $catalog_name->catalog;?></td>
				<td><?php echo anchor(SITE_AREA .'/settings/news/edit/'. $record->id, lang('news_edit'), 'class="ajaxify"'); ?><?php if($record->sticky==0){echo '｜<a href="'.site_url(SITE_AREA .'/settings/news/sticky/'.$record->id).'">設為焦點新聞</a>';}else{echo '｜<a href="'.site_url(SITE_AREA .'/settings/news/sticky/'.$record->id.'/cancel').'">取消焦點新聞</a>';}?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
