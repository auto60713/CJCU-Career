
<div class="view split-view">
	
	<!-- catalog List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) :; ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) :; ?>
					<?php $record = (array)$record; ?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['catalog_name']) ? $record['id'] : $record['catalog_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['catalog_description']) ? lang('catalog_edit_text') : $record['catalog_description']); ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else:; ?>
	
	<div class="notification attention">
		<p><?php echo lang('catalog_no_records'); ?> <?php echo anchor(SITE_AREA .'/reports/catalog/create', lang('catalog_create_new'), array("class" => "ajaxify")); ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- catalog Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/reports/catalog/create'); ?>"><?php echo lang('catalog_create_new_button'); ?></a>

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
<?php
foreach ($records as $record) :; ?>
			<tr>
				<td><?php echo $record->catalog; ?></td>
				<td><?php echo $record->sort; ?></td>
				<td><?php echo anchor(SITE_AREA .'/reports/catalog/edit/'. $record->id, lang('catalog_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
