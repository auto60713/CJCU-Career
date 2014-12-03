<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
	Copyright (c) 2011 Lonnie Ezell

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:
	
	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

$lang['db_maintenance']			= '維護';
$lang['db_database_maintenance']			= '資料庫維護';
$lang['db_backups']				= '備份';
$lang['db_database_backups']				= '資料庫備份';

$lang['db_backup_warning']		= '注意:由於PHP執行時間及記憶體的限制,備份大資料庫是不允許的 . 假如你的資料庫非常龐大，你可能需使用指令直接從SQL伺服器備份, 如果您沒有管理者權限，請聯絡管理者為您備份。';
$lang['db_filename']			= '檔案名稱';

$lang['db_drop_question']		= '添加 &lsquo;Drop Tables&rsquo; 指令?';
$lang['db_compress_question']	= '壓縮類型?';
$lang['db_insert_question']		= '添加 &lsquo;Insert &rsquo; 指令?';

$lang['db_restore_note']		= '還原選項是唯一能夠讀取未壓縮文件， 如果你只是想備份和下載到您的電腦，Gzip 和 Zip 是好的選擇';

$lang['db_gzip']				= 'gzip';
$lang['db_zip']					= 'zip';
$lang['db_backup']				= '備份';
$lang['db_tables']				= 'Tables';
$lang['db_restore']				= '還原';
$lang['db_database']			= 'Database';
$lang['db_drop']				= '移除';
$lang['db_repair']				= '修復';
$lang['db_optimize']			= '最佳化';
$lang['db_apply']			= '執行';

$lang['db_delete_note']			= '刪除選擇的備份檔: ';
$lang['db_no_backups']			= '沒有找到之前的備份檔';
$lang['db_backup_delete_confirm']	= '確定刪除以下備份檔?';
$lang['db_drop_confirm']		= '確定刪除以下資料表?';
$lang['db_drop_attention']		= '<p>從資料庫刪除資料表將會遺失資料</p><p><strong>這個可能使您的應用程式沒有功能</strong></p>';

$lang['db_table_name']			= '資料表名稱';
$lang['db_records']				= '行數';
$lang['db_data_size']			= '資料大小';
$lang['db_index_size']			= '索引大小';
$lang['db_data_free']			= '大小';
$lang['db_engine']				= '引擎';
$lang['db_no_tables']			= '在當前資料庫沒有找到資料表';

$lang['db_restore_results']		= '恢復結果';
$lang['db_back_to_tools']		= '回到資料庫工具';
$lang['db_restore_file']		= '恢復資料庫從檔案';
$lang['db_restore_attention']	= '<p>從備份檔恢復資料庫，將可能造成一些之前或全部的資料庫遺失。</p><p><strong>這個可能造成一些資料遺失。</strong>.</p>';

$lang['db_database_settings']	= '資料庫設定';
$lang['db_hostname']			= 'Hostname';
$lang['db_dbname']				= '資料庫名稱';
$lang['db_advanced_options']	= '進階選項';
$lang['db_persistant_connect']	= '持續連接';
$lang['db_display_errors']		= '顯示資料庫錯誤';
$lang['db_enable_caching']		= '開啟查詢快取';
$lang['db_cache_dir']			= '快曲目路';
$lang['db_prefix']				= '前綴';

$lang['db_servers']				= '伺服器';
$lang['db_driver']				= 'Driver';
$lang['db_persistant']			= '持久';
$lang['db_debug_on']			= '除錯模式';
$lang['db_strict_mode']			= '嚴格模式';
$lang['db_running_on_1']		= '您目前正在運行';
$lang['db_running_on_2']		= '伺服器.';

$lang['db_successful_save']		= '設定儲存成功';
$lang['db_erroneous_save']		= '儲存發生錯誤';
$lang['db_successful_save_act']	= '資料庫設定儲存成功';
$lang['db_erroneous_save_act']	= '資料庫設定儲存出錯';