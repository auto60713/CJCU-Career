<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/settings/catalog/create'); ?>">
		<?php echo lang('catalog_create_new_button'); ?>
	</a>

	<h3><?php echo lang('catalog_create_new'); ?></h3>

	<p><?php echo lang('catalog_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) :; ?>
				
	<h2>分類一覽</h2>
	<table>
		<thead>
			<tr>
			
		<th>分類名稱</th>
		<th>排序</th>
		
			<th><?php echo lang('catalog_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) :; ?>
			<tr>
				
				<td><?php echo $record->catalog; ?></td>
				<td><?php echo $record->sort; ?></td>
				<td><?php echo anchor(SITE_AREA .'/settings/catalog/edit/'. $record->id, lang('catalog_edit'), ''); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>