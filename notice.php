<?php session_start();

if(!isset($_SESSION['username'])){

    echo "No permission"; exit;
}
    $lev = $_SESSION['level'];
    $usr = $_SESSION['username'];  
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/notice.css?v=2">
	<script>

	<?php include_once("js_get_all_notify.php");  get_all_notify($usr,$lev); ?>

	var ctu = true;

	$(function(){

		var c = $('#msg');
        if((msglist_array_old.length == 0)&&(msglist_array_new.length == 0)){c.prepend("目前沒有訊息");}
        else{
		    appenData(msglist_array_old,0);
		    appenData(msglist_array_new,1);
		}

		// function appenData(array,n)
		// 將訊息組成上面格式的呈現，並插入到頁面上
		// 參數:array:為一個訊息組成的陣列(由後端組成)
		// n: 為識別此陣列是否為新訊息 是傳1，否傳0
		// 0 與 1 用來判斷是否要再該訊息加上背景顏色加強標註
		function appenData(array,n){
			
			    for(var i=0;i<array.length;i++){

			    	if(array[i].icon=="fa fa-times") var icon = $('<span>').addClass('notice-icon-times').append($('<i>').addClass(array[i].icon));
			    	else icon = $('<span>').addClass('notice-icon').append($('<i>').addClass(array[i].icon));
			        
			        var msg = $('<a>').addClass('notice-msg').html('  '+array[i].mcontent).prepend(icon),
			       	    time = $('<a>').addClass('notice-time').append(array[i].time.split(' ')[0]),
			       	    content = $('<div>').addClass('notice-content').append(msg).append(time),
			       	    box=$('<a>').addClass('notice-list').append(content);
			        c.prepend(box);
			    }	

			    c.fadeIn(300);
		}
		

		var ajax;

		function getMsg_longpolling(){

     ajax =  $.ajax({
                type:"POST",
                dataType:"json",
                data: {level:<?php echo '"'.$lev.'"'; ?>,username:<?php echo '"'.$usr.'"'; ?>},      
                url:"ajax_get_new_msg.php",
                beforeSend: function( xhr ) {
				    console.log('sent request in long polling');
				}
            })
			.done(function(data) {
		    	//data= data.trim();
               	if(data=='')console.log('no any data');            	
               	else if(data=='0')location.replace('index.php');               
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


		$('.list').click(function(event) {
		
			ctu=false;
			ajax.abort();
		});

	});

	</script>

</head>

<body>


<div id="msg" style="display:none;"></div>


</body>
</html>