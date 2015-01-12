<!doctype html>
<html>
<script type="text/javascript">

$(function(){

<?php 
switch ($_POST['mode']) {

	case 'stu':
        echo "$('#page_stu').show();";
    break;
    case 'com':
        echo "$('#page_com').show();";
    break;
    case 'dep':
        echo "$('#page_dep').show();";
    break;
    case 'staff':
        echo "$('#page_staff').show();";
    break;
}
?>


});
</script>

<style type="text/css">
.hidden{
	margin: 20px;
	display: none;
}
h3{
	color: #00486A;
}
p,table{
	margin-left: 20px;
	margin-bottom: 20px;
}
td{
	min-width: 55px;
}
</style>
<body>

	<div id="page_stu" class="hidden">

		<h3>個人資訊</h3>
    	<p>檢視基本個人資料(依照學生系統)</p>

	    <h3>我的應徵</h3>
    	<p>管理應徵的工作。</p>

	    <h3>通知</h3>
    	<p>在系統上的操作會有紀錄，並在這裡呈現。</p>
	</div>

	

	<div id="page_com" class="hidden">

		<h3>大頭照</h3>
    	<p>點選左方圖像可以上傳一張代表公司的圖像。</p>

		<h3>公司資訊</h3>
    	<p>可以修改基本資訊以及查看公司的審核狀況。 <br>
           剛註冊的公司會處於待審核的狀態， <br>
           校方審查過後，才可開始發佈工作。
    	</p>

	    <h3>新增工作</h3>
    	<p>發佈的工作需要經過校方的審核才能上架，並在首頁出現。</p>

	    <h3>管理工作</h3>
    	<p>工作發佈之後可以在這裡管理及修改工作資訊。<br>
    	   或是結束應徵。<br>
	    </p>

	    <h3>工作負責人</h3>
    	<p>你可以新增公司的工作負責人來幫忙管理工作，<br>
           並且一樣從廠商入口登入。
	    </p>

	    <h3>通知</h3>
    	<p>在系統上的操作會有紀錄，並在這裡呈現。</p>
	</div>


	<div id="page_dep" class="hidden">

		<h3>大頭照</h3>
    	<p>點選左方圖像可以上傳一張代表本系的圖像。</p>

		<h3>系所資訊</h3>
    	<p>可以修改基本資訊供人檢視。</p>

	    <h3>新增工作</h3>
    	<p>發佈的工作會在首頁出現。 <br>
    	   如果是選擇"幫廠商代發"，可以從列表中選擇廠商， <br>
    	   以該廠商的身分發佈工作。 
    	</p>
    	  
	    </p>
	    <h3>我發佈的工作</h3>
    	<p>工作發佈之後可以在這裡管理及修改工作資訊。<br>
    	   或是結束應徵。<br>
	    </p>
    	  
	    <h3>實習管理</h3>
	    <p>列出目前系上的實習項目。<br>
	       點選工作名稱可以管理該實習，<br>
	       點選圖示可以檢視該實習的實習資訊。
	    </p>

        <h3>通知</h3>
    	<p>在系統上的操作會有紀錄，並在這裡呈現。</p>
 
	</div>


	<div id="page_staff" class="hidden">

		<h3>大頭照</h3>
    	<p>點選左方圖像可以上傳一張代表該單位的圖像。</p>

		<h3>基本資訊</h3>
    	<p>可以修改基本資訊供人檢視。</p>

	    <h3>審核工作與公司</h3>
    	<p>審核剛註冊的廠商或是廠商要發佈的工作。</p>

	    <h3>新增工作</h3>
    	<p>發佈的工作會在首頁出現。 <br>
    	   如果是選擇"幫廠商代發"，可以從列表中選擇廠商， <br>
    	   以該廠商的身分發佈工作。 
    	</p>
    	  
	    </p>
	    <h3>我發佈的工作</h3>
    	<p>工作發佈之後可以在這裡管理及修改工作資訊。<br>
    	   或是直接結束應徵。<br>
    	   如果是工作分類是"實習"可以轉為實習中，
	    </p>
    	  
	    </p>
	    <h3>維護</h3>
	    <table>
            <tr><td valign="top">工作：點選工作名稱可以直接管理該工作。</td></tr>
            <tr><td valign="top">廠商：列出目前駐進的廠商。</td></tr>
            <tr><td valign="top">系所：列出目前建立的系所帳號與密碼。</td></tr>
	    </table>
 

	</div>
</body>
</html>
