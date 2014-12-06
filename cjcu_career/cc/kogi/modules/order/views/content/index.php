
<div class="view split-view">

	<!-- order List -->
	<div class="view">
	<div class="panel-header list-search">
			<span>&nbsp;&nbsp;<?php echo lang('order_search_remark'); ?></span>
			<?php render_search_box(); ?>
	</div>		
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['lidm']) ? $record['id'] : $record['lidm']); ?></b><br/>
							<span class="small">
							<?php 
								$result=$this->orderstatus_model->find_by('id',$record['status']);
								echo lang('order_status').':'.$result->name;
							?>
							</span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>

	<?php else: ?>

	<div class="notification attention">
		<p><?php echo lang('order_no_records'); ?> <?php //echo anchor(SITE_AREA .'/content/order/create', lang('order_create_new'), array("class" => "ajaxify")) ?></p>
	</div>

	<?php endif; ?>
	</div>
	<!-- order Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
			<br />
	<?php if ($this->auth->has_permission('Order.Content.Users')):?>
			<div class="box create rounded">
		<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/content/order/create'); ?>">
		點選開始申請
		</a>
	<h3>嗨！畢業校友您好，您可以在此申請證明文件</h3>

	<p>證明文件說明內容，此區塊提供您可申請證明文件，使用本功能讓您不需要再親自至學校辦理，按下右方申請即可開始使用</p>
	</div>
	<?php endif;?>
	<?php if ($this->auth->has_permission('Order.Content.As')):?>
			<div class="box create rounded">
	<h3>嗨！您所使用的權限為會計出納，您可以在此審核文件,請於左側檢視申請文件,並審核</h3>

	<p>確認入帳後,請在此審核文件</p>
	</div>
	<?php endif;?>
	<?php if ($this->auth->has_permission('Order.Content.Regis')):?>
			<div class="box create rounded">
	<h3>嗨！您所使用的權限為註冊課務組，您可以在此審核文件,請於左側檢視申請文件,並審核</h3>

	<p>請確認申請者資料是否齊全</p>
	</div>
	<?php endif;?>
	<?php if ($this->auth->has_permission('Order.Content.Career')):?>
			<div class="box create rounded">
		<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/content/order/create'); ?>">
		點選開始申請
		</a>
	<h3>嗨！職涯組的同仁，您正在使用管理介面,如果有需要替同學申請,可以在此申請證明文件</h3>

	<p>證明文件說明內容，此區塊提供您可申請證明文件，使用本功能讓您不需要再親自至學校辦理，按下右方申請即可開始使用</p>
	</div>
	<?php endif;?>
				<?php if (isset($records) && is_array($records) && count($records)) : ?>

		
	
	

	
	<h1><?php echo lang('order_manage'); ?></h1>
	<h4><?php echo lang('order_normal'); ?></h4>
	<?php if (!$this->auth->has_permission('Order.Content.Users')):?>
	<div>
	<div id="tabs">
		<ul>
			<li>
				<a href="#tabs-1"><?php echo lang('order_false');?></a>
			</li>
			
			<li>
				<a href="#tabs-3"><?php echo lang('order_checkout');?></a>
			</li>
			<li>
				<a href="#tabs-2"><?php echo lang('order_true');?></a>
			</li>
		</ul>
		<div id="tabs-1">
			<div>		
					<table>
					<thead>
						<tr>
					<th><?php echo lang('order_id'); ?></th>
					<th><?php echo lang('order_created_on'); ?></th>
					<th><?php echo lang('order_status'); ?></th>
					<th><?php echo lang('order_remark'); ?></th>
					<th><?php echo lang('order_actions'); ?></th>
					</tr>
					</thead>
					<tbody>
			<?php
			foreach ($records as $record) : ?>
						<tr>
							<td><?php echo $record->lidm?></td>
							<td><?php echo $record->created_on?></td>
							<td><?php
							$result=$this->orderstatus_model->find_by('id',$record->status);
								if($record->status==5){
									echo "<span style=\"color:green;\">".$result->name."</span>";
								}
								elseif($record->status==2){
									echo "<span style=\"color:red;\">".$result->name."</span>";
								}else{
									echo $result->name;
								}
							?>
							</td>
							<td><?php echo mb_substr(strip_tags(str_replace(chr(0xC2).chr(0xA0),' ',html_entity_decode($record->remark, ENT_QUOTES, 'UTF-8'))), 0, 20,'UTF-8') ?></td>
							<td><?php echo anchor(SITE_AREA .'/content/order/edit/'. $record->id, '<input type="button" value="'.lang('order_edit').'">', 'class="ajaxify"'); ?></td>
						</tr>
			<?php endforeach; ?>
					</tbody>
				</table>	
			</div>
			</div>
		
		<div id="tabs-3">
			<?php if (isset($records_ready) && is_array($records_ready) && count($records_ready)) : ?>
			<div>		
					<table>
					<thead>
						<tr>
					<th><?php echo lang('order_id'); ?></th>
					<th><?php echo lang('order_created_on'); ?></th>
					<th><?php echo lang('order_status'); ?></th>
					<th><?php echo lang('order_remark'); ?></th>
					<th><?php echo lang('order_actions'); ?></th>
					</tr>
					</thead>
					<tbody>
			<?php
			foreach ($records_ready as $record2) : ?>
						<tr>
							<td><?php echo $record2->lidm?></td>
							<td><?php echo $record2->created_on?></td>
							<td><?php 
								$result=$this->orderstatus_model->find_by('id',$record2->status);
								if($record2->status==5){
									echo "<span style=\"color:green;\">".$result->name."</span>";
								}
								elseif($record2->status==2){
									echo "<span style=\"color:red;\">".$result->name."</span>";
								}else{
									echo $result->name;
								}
							?>
							</td>
							<td><?php echo mb_substr(strip_tags(str_replace(chr(0xC2).chr(0xA0),' ',html_entity_decode($record2->remark, ENT_QUOTES, 'UTF-8'))), 0, 20,'UTF-8')?></td>
							<td><?php echo anchor(SITE_AREA .'/content/order/edit/'. $record2->id, lang('order_edit'), 'class="ajaxify"'); ?></td>
						</tr>
			<?php endforeach; ?>
					</tbody>
				</table>	
			</div>
		<?php else:?>
		<div class="notification attention">
		<p><?php echo lang('order_no_records'); ?></p>
		</div>
		<?php endif;?>
		</div>
		
		<div id="tabs-2">
			<?php if (isset($records_softdel) && is_array($records_softdel) && count($records_softdel)) : ?>
			<div>		
					<table>
					<thead>
						<tr>
					<th><?php echo lang('order_id'); ?></th>
					<th><?php echo lang('order_created_on'); ?></th>
					<th><?php echo lang('order_status'); ?></th>
					<th><?php echo lang('order_remark'); ?></th>
					<th><?php echo lang('order_actions'); ?></th>
					</tr>
					</thead>
					<tbody>
			<?php
			foreach ($records_softdel as $record1) : ?>
						<tr>
							<td><?php echo $record1->lidm?></td>
							<td><?php echo $record1->created_on?></td>
							<td><?php 
								$result=$this->orderstatus_model->find_by('id',$record1->status);
								if($record1->status==5){
									echo "<span style=\"color:green;\">".$result->name."</span>";
								}
								elseif($record1->status==2){
									echo "<span style=\"color:red;\">".$result->name."</span>";
								}else{
									echo $result->name;
								}
							?>
							</td>
							<td><?php echo mb_substr(strip_tags(str_replace(chr(0xC2).chr(0xA0),' ',html_entity_decode($record1->remark, ENT_QUOTES, 'UTF-8'))), 0, 20,'UTF-8')?></td>
							<td><?php echo anchor(SITE_AREA .'/content/order/edit/'. $record1->id, lang('order_view'), 'class="ajaxify"'); ?></td>
						</tr>
			<?php endforeach; ?>
					</tbody>
				</table>	
			</div>
		<?php else:?>
		<div class="notification attention">
		<p><?php echo lang('order_no_records'); ?></p>
		</div>
		<?php endif;?>
		</div>
		</div>
	</div>
			<?php else:?>
				<table>
					<thead>
						<tr>
					<th><?php echo lang('order_id'); ?></th>
					<th><?php echo lang('order_created_on'); ?></th>
					<th><?php echo lang('order_status'); ?></th>
					<th><?php echo lang('order_remark'); ?></th>
					<th><?php echo lang('order_actions'); ?></th>
					</tr>
					</thead>
					<tbody>
			<?php
			foreach ($records as $record) : ?>
						<tr>
							<td><?php echo $record->lidm?></td>
							<td><?php echo $record->created_on?></td>
							<td><?php 
								$result=$this->orderstatus_model->find_by('id',$record->status);
								if($record->status==5){
									echo "<span style=\"color:green;\">".$result->name."</span>";
								}
								elseif($record->status==2){
									echo "<span style=\"color:red;\">".$result->name."</span>";
								}else{
									echo $result->name;
								}
							?>
							</td>
							<td><?php echo mb_substr(strip_tags(str_replace(chr(0xC2).chr(0xA0),' ',html_entity_decode($record->remark, ENT_QUOTES, 'UTF-8'))), 0, 20,'UTF-8') ?></td>
							<td><?php echo anchor(SITE_AREA .'/content/order/edit/'. $record->id, '<input type="button" value="'.lang('order_edit').'">', 'class="ajaxify"'); ?></td>
						</tr>
			<?php endforeach; ?>
					</tbody>
				</table>
	
				<?php endif; ?>

			<?php endif;?>
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->

</div>
<script>
	head.ready(function() {
		$("#tabs").tabs();
	}); 
</script>
