<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/developer/shipment/create'); ?>">
		<?php echo lang('shipment_create_new_button'); ?>
	</a>

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
		
		<?php foreach ($records as $record) :; ?>
			<tr>
				
				<td><?php echo $record->method; ?></td>
				<td><?php echo $record->fee; ?></td>
				<td><?php echo anchor(SITE_AREA .'/developer/shipment/edit/'. $record->id, lang('shipment_edit'), ''); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>