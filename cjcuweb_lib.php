<?

	// 各種身分的權限值
	$level_company = 4;
	$level_student = 3;
	$level_teacher = 2;
	$level_stuff = 1;

	// 過濾特殊符號防止注入，傳入字串後回傳過濾後的字串
	function sqlsrv_escape($str)
	{
	    if(get_magic_quotes_gpc()) $str= stripslashes($str);
	    return str_replace("'", "''", $str);
	}

	// 連結學校系統驗證身分是否正確
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

        // 暫時以此回應為正確 回傳 true 否則一律傳回 false
        if($body=="987654321") return true;
        
        } else  die('Error:'.$errno.$errstr);

        return true; //因為學校那邊關閉測試系統 所以直接改成ture
    }


?>