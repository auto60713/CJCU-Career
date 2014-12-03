<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/reports/orderstatus/create'); ?>">
		<?php echo lang('orderstatus_create_new_button'); ?>
	</a>

	<h3><?php echo lang('orderstatus_create_new'); ?></h3>

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
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->name?></td>
				<td><?php echo $record->description?></td>
				<td><?php echo anchor(SITE_AREA .'/reports/orderstatus/edit/'. $record->serial, lang('orderstatus_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>