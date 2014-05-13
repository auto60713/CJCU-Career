<?

	// 各種身分的權限值
	$level_company = 4;
	$level_student = 3;
	$level_teacher = 2;
	$level_staff = 1;

    /*
    * 通知系統 send_msg  method
    * 參數 arr 為一陣列(須為以下格式，唯msg可選填，其餘不可為空)

      array(
      'conn'=>          $conn,
      'sender_id'=>     $sender_id,
      'sender_level'=>  $sender_level,
      'recv_id'=>       $recv_id,
      'recv_level'=>    $recv_level,
      'msg'=>           $msg,
      'url'=>           $url,
      'icon'=>          $icon
      );

    * conn 資料庫連線物件
    * sender_id 傳送人，通常為SESSION['username']
    * sender_level 傳送人等級，通常為SESSION['level']
    * recv_id 接收人，會收到通知的人
    * recv_level 接收人等級，通常需要先判斷為1~4其中之一
    * msg 傳送訊息(純字串)
    * url 連結的位置(點了會連到哪裡)
    * icon 為一個 font-awesome ICON 的 class 

    */

function send_msg($arr){

    $conn = $arr['conn'];
    $sender_id = $arr['sender_id'];
    $sender_level = ($arr['sender_level']==4)?1:0;
    $recv_id =  $arr['recv_id'];
    $recv_level = ($arr['recv_level']==4)?1:0;
    $msg = $arr['msg'];
    $url = $arr['url'];
    $icon = $arr['icon'];

    $sql1 = "UPDATE cjcu_notify SET isnews = 1 ,time = GETDATE() WHERE user_no=? and user_level = ?";
    $sql2 = "insert into msg(send,send_level,recv,recv_level,mcontent,url,icon) values (?,?,?,?,?,?,?)";

    $params1 = array($recv_id,$recv_level);
    $params2 = array($sender_id,$sender_level,$recv_id,$recv_level,$msg,$url,$icon);

    $result1 = sqlsrv_query($conn, $sql1, $params1);
    $result2 = sqlsrv_query($conn, $sql2, $params2);

    if($result1 && $result2) return true;
    else return false;
    
}

	/* 連結學校系統驗證身分是否正確
    function verification($user,$pwd){

        $uri = 'https://eportal.cjcu.edu.tw/ILMSAccountService/StudentAccout/'.$user.'?pwd='.$pwd;
        //preg_match('/^(.+:\/\/)([^:\/]+):?(\d*)(\/.+)/', $url, $matches);
        $uri_arr = parse_url($uri);
        $protocol = $uri_arr["scheme"];
        $host = $uri_arr["host"];
        $port = '80';
        $url = $uri_arr["path"].'?'.$uri_arr["query"];

        // 設定要傳送的 XML 資料
        $xml  = '<?xml version="1.0" encoding="utf8" ?>';
        $xml .= '<timezone>Asia/Taipei</timezone>';
     
        // 開啟一個 TCP/IP Socket
        $fp = fsockopen($host, $port, $errno, $errstr, 5); 
       
        if ($fp) {
        // 設定 header 與 body
        $httpHeadStr  = "GET {$url} HTTP/1.1\r\n";
        $httpHeadStr .= "Content-type: application/xml\r\n";
        $httpHeadStr .= "Host: {$host}:{$port}\r\n";
        $httpHeadStr .= "Content-Length: ".strlen($xml)."\r\n";
        $httpHeadStr .= "Connection: close\r\n";
        $httpHeadStr .= "\r\n";
        $httpBody = $xml."\r\n";
        // 呼叫 WebService    
        fputs($fp, $httpHeadStr.$httpBody);
        $header = '';
        $body ='';
        do { $header .= fgets ( $fp, 128 ); } 
        while ( strpos ( $header, "\r\n\r\n" ) === false );
        while ( ! feof ( $fp ) ) $body .= fgets ( $fp, 128 );
        
        // 釋放資源
        fclose($fp);


        // 帳號必須為stud 先不做密碼驗證
        if ($user == 'stud'){return true;}
        else{return false;}
     
        }

    }

*/
?>