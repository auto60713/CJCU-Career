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

		appenData(msglist_array_old,0);
		appenData(msglist_array_new,1);
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
		function appenData(array,n){

			var news_bg = (n==1)? '#efe' : ' ';
			
			for(var i=0;i<array.length;i++){
				
			   var msg = $('<p>').addClass('notice-msg').text(array[i].mcontent),
			   	   icon = $('<i>').addClass(array[i].icon),
			   	   time = $('<p>').addClass('notice-time').append(icon).append(array[i].time.split(' ')[0]),
			   	   content = $('<div>').addClass('notice-content').append(msg).append(time).css('background-color', news_bg),
			   	   img = $('<img>').attr('src', 'http://akademik.unissula.ac.id/themes/sia/images/user.png').addClass('notice-sender-img'),
			   	   box=$('<a>').attr('href', array[i].url).addClass('notice-list').append(img).append(content);
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
				getMsg_longpolling();
			});
		
		}


		

		$('.list').click(function(event) {
			console.log(ctu,ajax);
			ctu=false;
			ajax.abort();
			console.log(ctu,ajax);
		});

	});

	</script>

</head>

<body>


<div id="msg"></div>


</body>
</html>