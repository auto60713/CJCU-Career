<?php if (validation_errors()) : ?>
<div class="notification error">
	<p><?php echo validation_errors(); ?></p>
</div>
<?php endif; ?>

<div class="notification information">
	<p class="text-center">快速鍵已設定完成，您無須作任何設定</p>
</div>
<p>
可使用的快速鍵:
</p>
<p>
ctrl+s/⌘+s : 儲存目前的操作<br>
alt+c : 回到主畫面
</p>