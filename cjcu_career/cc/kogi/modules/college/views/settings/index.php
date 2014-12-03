<style>
td { vertical-align: baseline; }
tr:hover { background: #f6f6f6; border-top: 1px solid #e7e7e7; border-bottom: 1px solid #e7e7e7; }
</style>
<div class="view split-view">
	
	<!-- college List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['name']) ? $record['id'] : $record['name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['college_description']) ? lang('college_edit_text') : $record['college_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('college_no_records'); ?> <?php echo anchor(SITE_AREA .'/settings/college/create', lang('college_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- college Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/settings/college/create')?>"><?php echo lang('college_create_new_button');?></a>

				<h3><?php echo lang('college_create_new');?></h3>

				<p><?php echo lang('college_edit_text'); ?></p>
			</div>
			<br />
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
					<h2>學院列表</h2>
	<table>
		<thead>
			<tr>
		<th>名稱</th>
		<th><?php echo lang('college_actions'); ?></th>
		</tr>
		</thead>
		<tbody>
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record->name?></td>
				<td><?php echo anchor(SITE_AREA .'/settings/college/edit/'. $record->id, lang('college_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('college_no_records'); ?> <?php echo anchor(SITE_AREA .'/settings/college/create', lang('college_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
