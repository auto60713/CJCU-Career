<?php

//如果該公司審核未經學校通過 部分功能不開放
function censored_check(){

    include_once("sqlsrv_connect.php");

    $sql = "select * from company where id=?";
    $params  = array($_SESSION['username']);
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

    $result  = sqlsrv_query( $conn , $sql , $params , $options );
    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    
        // 如果該公司申請通過
        if($row['censored'] == 1){
        $hreftag = '<a href="#company-addwork"><div class="company-addwork list">新增工作</div></a><hr>';
        $hreftag.= '<a href="#company-work"><div class="company-work list">管理工作</div></a><hr>';
        $hreftag.= '<a href="#company-staff"><div class="company-staff list">工作負責人</div></a><hr>';
        $hreftag.= '<a href="#company-notice"><div class="company-notice list">系統紀錄</div></a><hr>';
        $hreftag.= '<a href="#explanation"><div class="explanation list">操作說明</div></a><hr>';
        echo "$('.left-box').append('".$hreftag."');\n";
        }
        // 工作負責人
        else if($row['censored'] == 5){
        $hreftag = '<a href="#company-work"><div class="company-work list">管理工作</div></a><hr>';
        $hreftag.= '<a href="#company-notice"><div class="company-notice list">系統紀錄</div></a><hr>';
        $hreftag.= '<a href="#explanation"><div class="explanation list">操作說明</div></a><hr>';
        echo "$('.left-box').append('".$hreftag."');\n";
        }
        // 沒通過
        else if($row['censored'] == 3 ||$row['censored'] == 0){
        $hreftag = '<a href="#company-notice"><div class="company-notice list">系統紀錄</div></a><hr>';
        $hreftag.= '<a href="#explanation"><div class="explanation list">操作說明</div></a><hr>';
        echo "$('.left-box').append('".$hreftag."');\n";
        }
}

?>