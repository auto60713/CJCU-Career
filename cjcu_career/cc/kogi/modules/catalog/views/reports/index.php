<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/reports/catalog/create'); ?>">
		<?php echo lang('catalog_create_new_button'); ?>
	</a>

	<h3><?php echo lang('catalog_create_new'); ?></h3>

	<p><?php echo lang('catalog_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) :; ?>
				
	<h2>catalog</h2>
	<table>
		<thead>
			<tr>
			
		<th>Catalog</th>
		<th>Sort</th>
		
			<th><?php echo lang('catalog_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) :; ?>
			<tr>
				
				<td><?php echo $record->catalog; ?></td>
				<td><?php echo $record->sort; ?></td>
				<td><?php echo anchor(SITE_AREA .'/reports/catalog/edit/'. $record->id, lang('catalog_edit'), ''); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>