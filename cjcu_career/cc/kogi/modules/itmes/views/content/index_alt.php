
<div class="view split-view">
	
	<!-- itmes List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['itmes_name']) ? $record['id'] : $record['itmes_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['itmes_description']) ? lang('itmes_edit_text') : $record['itmes_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('itmes_no_records'); ?> <?php echo anchor(SITE_AREA .'/content/itmes/create', lang('itmes_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- itmes Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/content/itmes/create')?>"><?php echo lang('itmes_create_new_button');?></a>

				<h3><?php echo lang('itmes_create_new');?></h3>

				<p><?php echo lang('itmes_edit_text'); ?></p>
			</div>
			<br />
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
					<h2>itmes</h2>
	<table>
		<thead>
			<tr>
		<th>Name</th>
		<th>Price</th>
		<th>Fee</th>
		<th>Working Day</th>
		<th>Notice</th>
		<th>Remark</th>
		<th><?php echo lang('itmes_actions'); ?></th>
		</tr>
		</thead>
		<tbody>
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record->name?></td>
				<td><?php echo $record->price?></td>
				<td><?php echo $record->fee?></td>
				<td><?php echo $record->working_day?></td>
				<td><?php echo $record->notice?></td>
				<td><?php echo $record->remark?></td>
				<td><?php echo anchor(SITE_AREA .'/content/itmes/edit/'. $record->id, lang('itmes_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
