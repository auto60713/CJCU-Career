
<div class="view split-view">
	
	<!-- orderstatus List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['serial']; ?>">
						<p>
							<b><?php echo (empty($record['orderstatus_name']) ? $record['serial'] : $record['orderstatus_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['orderstatus_description']) ? lang('orderstatus_edit_text') : $record['orderstatus_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('orderstatus_no_records'); ?> <?php echo anchor(SITE_AREA .'/reports/orderstatus/create', lang('orderstatus_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- orderstatus Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/reports/orderstatus/create')?>"><?php echo lang('orderstatus_create_new_button');?></a>

				<h3><?php echo lang('orderstatus_create_new');?></h3>

				<p><?php echo lang('orderstatus_edit_text'); ?></p>
			</div>
			<br />
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
					<h2>orderstatus</h2>
	<table>
		<thead>
			<tr>
		<th>Name</th>
		<th>Description</th>
		<th><?php echo lang('orderstatus_actions'); ?></th>
		</tr>
		</thead>
		<tbody>
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record->name?></td>
				<td><?php echo $record->description?></td>
				<td><?php echo anchor(SITE_AREA .'/reports/orderstatus/edit/'. $record->serial, lang('orderstatus_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
