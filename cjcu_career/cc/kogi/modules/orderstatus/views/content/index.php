<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/content/orderstatus/create'); ?>">
		<?php echo lang('orderstatus_create_new_button'); ?>
	</a>

	<h3><?php echo lang('orderstatus_create_new'); ?></h3>

	<p><?php echo lang('orderstatus_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>訂單狀態列表</h2>
	<table>
		<thead>
			<tr>
			
		<th>名稱</th>
		<th>描述</th>
		
			<th><?php echo lang('orderstatus_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->name?></td>
				<td><?php echo $record->description?></td>
				<td><?php echo anchor(SITE_AREA .'/content/orderstatus/edit/'. $record->id, lang('orderstatus_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>