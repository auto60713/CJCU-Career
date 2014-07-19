<?
session_start();

if(!isset($_SESSION['username'])){

echo "No permission";
exit;

}
$lev = $_SESSION['level'];
$usr = $_SESSION['username'];  
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/notice.css?v=2">
	<script><? include_once("js_get_all_notify.php");  get_all_notify($usr,$lev); ?></script>
	<script>

	var ctu = true;

	$(function(){

		var c = $('#msg');

        if((msglist_array_old.length == 0)&&(msglist_array_new.length == 0)){c.prepend("目前沒有訊息");}
        else{
		appenData(msglist_array_old,0);
		appenData(msglist_array_new,1);
		}
		/*
		id: 2 mcontent: "您的工" recv: "zap" recv_level: 1 send: "cjcu" 
		send_level: 1 time: "2014-04-30 04:29:38.863" url: "wedf" icon:...
		<a href="#" class="notice-list">
		<img src="" class="notice-sender-img">
		<div class="notice-content">
			<p class="notice-msg">您的工作已被審dwqdqwd核通過 </p>
			<p class="notice-time"><i class="fa fa-comment"></i>2014-04-30</p>
		</div>
		</a>
		*/

		// function appenData(array,n)
		// 將訊息組成上面格式的呈現，並插入到頁面上
		// 參數:array:為一個訊息組成的陣列(由後端組成)
		// n: 為識別此陣列是否為新訊息 是傳1，否傳0
		// 0 與 1 用來判斷是否要再該訊息加上背景顏色加強標註
		function appenData(array,n){

			var news_bg = (n==1)? '#efe' : ' ';
			
			    for(var i=0;i<array.length;i++){
			    	
			       var msg = $('<p>').addClass('notice-msg').html(array[i].mcontent),
			       	   icon = $('<i>').addClass(array[i].icon),
			       	   time = $('<p>').addClass('notice-time').append(icon).append(array[i].time.split(' ')[0]),
			       	   content = $('<div>').addClass('notice-content').append(msg).append(time),
			       	   img = $('<img>').attr('src', 'http://akademik.unissula.ac.id/themes/sia/images/user.png').addClass('notice-sender-img'),
			       	   box=$('<a>').attr('href', array[i].url).addClass('notice-list').append(img).append(content).css('background-color', news_bg);
			       c.prepend(box);
			    }	
		}
		

		var ajax;
		getMsg_longpolling();
		
		//use long polling to get new msg every 3 sec
		function getMsg_longpolling(){

		 ajax =  $.ajax({
               type:"POST",
               dataType:"json",
               data: {level:<? echo '"'.$lev.'"'; ?>,username:<? echo '"'.$usr.'"'; ?>},      
               url:"ajax_get_new_msg.php",
               beforeSend: function( xhr ) {
				    console.log('sent request in long polling');
				}
            })
			.done(function(data) {
		    	//data= data.trim();
               	if(data=='')console.log('no any data');            	
               	else if(data=='0')location.replace('../../../cjcuweb/login.php');               
               	else{
         		//var arr = JSON.parse(data);
               	appenData(data,1);
                $('title').text('New Message~!!');
               	}
	               	
			})
			.fail(function() {ajax.abort(); })
			.always(function() {
				if(ctu) getMsg_longpolling();
			});
		
		}


		
		// 將LongPolling停止
		$('.list').click(function(event) {
			//console.log(ctu,ajax);
			ctu=false;
			ajax.abort();
			//console.log(ctu,ajax);
		});

	});

	</script>

</head>

<body>


<div id="msg"></div>


</body>
</html>