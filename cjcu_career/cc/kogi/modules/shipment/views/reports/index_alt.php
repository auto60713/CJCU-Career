
<div class="view split-view">
	
	<!-- shipment List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) :; ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) :; ?>
					<?php $record = (array)$record; ?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['shipment_name']) ? $record['id'] : $record['shipment_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['shipment_description']) ? lang('shipment_edit_text') : $record['shipment_description']); ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else:; ?>
	
	<div class="notification attention">
		<p><?php echo lang('shipment_no_records'); ?> <?php echo anchor(SITE_AREA .'/reports/shipment/create', lang('shipment_create_new'), array("class" => "ajaxify")); ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- shipment Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/reports/shipment/create'); ?>"><?php echo lang('shipment_create_new_button'); ?></a>

				<h3><?php echo lang('shipment_create_new'); ?></h3>

				<p><?php echo lang('shipment_edit_text'); ?></p>
			</div>
			<br />
				<?php if (isset($records) && is_array($records) && count($records)) :; ?>
				
					<h2>shipment</h2>
	<table>
		<thead>
			<tr>
		<th>Method</th>
		<th>Fee</th>
		<th><?php echo lang('shipment_actions'); ?></th>
		</tr>
		</thead>
		<tbody>
<?php
foreach ($records as $record) :; ?>
			<tr>
				<td><?php echo $record->method; ?></td>
				<td><?php echo $record->fee; ?></td>
				<td><?php echo anchor(SITE_AREA .'/reports/shipment/edit/'. $record->id, lang('shipment_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
