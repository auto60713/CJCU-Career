<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<div class="notification information">
	<p class="text-center">您的申請已成立,以下是匯款帳號</p>
</div>
<div class="box create rounded">
<a class="button good" href="<?php echo site_url(SITE_AREA .'/content/'); ?>">
		回主畫面
	</a>
	<h3>嗨！您好，您已完成申請囉</h3>

	<p>請根據以下資訊於三日內匯款,有任何問題請洽職涯發展組(分機)</p>
	

</div>
<?php echo form_open(); ?>
<fieldset>
	<legend>匯款帳戶資訊</legend>
	<div>本申請費一律採自動櫃員機（ATM）轉帳繳費方式辦理，繳費後請記得將交易明細表留存。</div>
	<ul>如至中國信託商業銀行各地行庫臨櫃繳款：
		<li>入帳行：中國信託商業銀行西台南分行</li>
		<li>戶名：長榮大學</li>
		<li>帳號：輸入網路報名「銀行繳款帳號」16 碼：</li>
		<li>8115473xxxxxxxxx，其中81154為銀行識別碼</li>
		<li>xxxxxxxxx表個人身份証後9碼數字。</li>
	</ul>
</fieldset>
<?php echo form_close(); ?>