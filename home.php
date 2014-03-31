<?php session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>長榮大學 - 媒合系統</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script>
	$(function(){ 
		$('#view-header').load('public_view/header.php #header');
		$('#search-detail').hide();
		$('#btn_detail_search').on('click', function(event) {
			event.preventDefault();
			$('#search-detail').slideToggle('fast');
		});

		/* modle of work 
			<div class="work">
				<h1>wefewfwefwefwefewfwefwefwefwefewf</h1>
				<p>台南市</p>
				<p>校外 工讀</p>
				<p>需求 8人</p>
				<p class="date">2013/01/10</p>
			</div>
		*/

	});
	</script>
</head>
<body>
<div id="view-header"></div>

<div class="top">

	<div class="search-bar container">
		<div class="set-center">
			<input type="text" id="normal-search">
			<input type="button" id="search" value="搜尋">
			<a href="#" id="btn_detail_search">進階搜尋</a>
		</div>
	</div>

	<!--進階搜尋-->
	<div class="tag-bar container" id="search-detail">
    <input type="checkbox" id="search_type" value="type">
    工作類型 : <select name="work_type" id="work_type"><option>請選擇</option></select> 
		       <select name="work_type_list1" id="work_type_list1"><option>請選擇</option></select><!-- 要等 work_type 選完才載入 -->
			   <select name="work_type_list2" id="work_type_list2"><option>請選擇</option></select><!-- 要等 work_type 選完才載入 -->
			   <span id="work_type_hint"></span>
			   <br>

    <input type="checkbox" id="search_prop" value="prop">
    工作性質 : <select name="work_prop" id="work_prop"></select> <br>

    <input type="checkbox" id="search_io" value="io">
    校內外工作：<select name="work_io" id="work_io">
                <option value="0">校內</option>
                <option value="1">校外</option>
                </select> 
			    <br>

    <input type="checkbox" id="search_zone" value="zone">
    工作地點 : <select name="zone" id="zone"></select> 
			   <select name="zone_name" id="zone_name"></select>
		       <br>
	</div>
</div>

<div class="center">

	<div class="title container">
		<div class="title-left">
		<h1>Work List</h1>
		</div>

		<div class="title-right">
		</div>
	</div>

	<div class="work-list-bar container">
		<div class="list"></div>
		<div class="list"></div>
		<div class="list"></div>
		<div class="list"></div>
	</div>

</div>
</body>


<script>
	
	<?
	//後端傳來的工作資料
	include_once('js_work_list.php');
	echo_work_list_array(); 
	
	// php load some help data for js array
	// 後端傳來"進階搜尋項目"的資料
	include("js_add_work.php");
	
	//如果目前是搜尋狀態
    if(isset($_GET['search']))
       echo '$(".title-right").append($("<a></a>").attr("href", "home.php").text("取消搜尋"));';
    ?>

</script>

<!--搜尋功能的API-->
<script src="js/home_search_lib.js"></script>
</html>