<?php if (validation_errors()) :?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<div id="ajax-content">
<?php // Change the css classes to suit your needs
	if (isset($college)) {
		$college = (array)$college;
	}
	$id = isset($college['id']) ? "/" . $college['id'] : '';
?>
<p class="small">*點選學院名稱可編輯</p>
<h2><a id="addbutton" href="#"><?php echo set_value('name', isset($college['name']) ? $college['name'] : ''); ?></a></h2>
<?php if (isset($dept) && is_array($dept) && count($dept)) : ?>
<table>
	<thead>
		<tr>

			<th>系所名稱</th>
			<th>可執行動作</th>

		</tr>
	</thead>
	<tbody>
		<?php foreach ($dept as $dept1) :
		?>
		<tr>
			<td><?php echo $dept1->dept_name?></td>
			<td><a class="ajaxify" href="<?php echo site_url(SITE_AREA .'/settings/college/edit_deptname/'.$dept1->id)?>">編輯</a>或<a class="ajaxify" href="<?php echo site_url(SITE_AREA . '/settings/college/del_dept/'.$dept1->id.'/'.$college['id']); ?>">刪除</a>
</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
	<div class="notification attention">
		<p><?php echo lang('dept_no_records'); ?></p>
	</div>
<?php endif; ?>
<div class="box good rounded">
	<a class="button ajaxify" href="<?php echo site_url(SITE_AREA .'/settings/college/add_dept'.$id)?>">新增系所</a>

	<h3>增加系所</h3>

	<p>
		<?php echo lang('college_edit_text'); ?>
	</p>
</div>
<div class="box good rounded" id="modify_college">
	<p>
	<?php echo form_open($this -> uri -> uri_string(), 'class="constrained"'); ?>
	<fieldset>
		<legend>修改學院名稱</legend>
	<?php if(isset($college['id'])):?>
	<input id="id" type="hidden" name="id" value="<?php echo $college['id']; ?>" />
	<?php endif; ?>
	<div>
		<label for="name">名稱</label>
		<input id="name" type="text" name="name" maxlength="50" value="<?php echo set_value('name', isset($college['name']) ? $college['name'] : ''); ?>" />
	</div>
	<div>
        <?php echo form_label('描述', 'college_description'); ?>
        <input id="college_description" type="text" name="college_description" maxlength="50" value="<?php echo set_value('college_description', isset($college['college_description']) ? $college['college_description'] : ''); ?>"  />
	</div>
	</fieldset>
	<div class="text-right">
<input type="submit" name="submit" class="button" value="確認修改" />
</div>
</p>
<?php echo form_close(); ?>
</div>
<div class="box delete rounded">
	<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA . '/settings/college/delete' . $id); ?>" onclick="return confirm('<?php echo lang('college_delete_confirm'); ?>')"><?php echo lang('college_delete_record'); ?></a>

	<h3><?php echo lang('college_delete_record'); ?></h3>

	<p>
		<?php echo lang('college_edit_text'); ?>
	</p>
</div>
</div>

<script>
	$(function() {function runEffect() {
			var selectedEffect = "slide";

			$( "#modify_college" ).show(selectedEffect,600);
		};
		$( "#modify_college" ).hide();

		$( "#addbutton" ).toggle(function() {
			runEffect();
			return false;
		},function() {$( "#modify_college" ).hide("drop",600);
		});
	});
</script>
