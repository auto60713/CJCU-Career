<div class="box create rounded">

	<h3>shipment</h3>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) :; ?>
				
	<table>
		<thead>
		
			
		<th>Method</th>
		<th>Fee</th>
		
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) :; ?>
			<?php $record = (array)$record; ?>
			<tr>
			<?php foreach($record as $field => $value) :; ?>
				
				<?php if ($field != 'id') :; ?>
					<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('shipment_true') : lang('shipment_false')) : $value; ?></td>
				<?php endif; ?>
				
			<?php endforeach; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>