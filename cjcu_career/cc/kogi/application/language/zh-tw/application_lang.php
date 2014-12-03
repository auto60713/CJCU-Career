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

//--------------------------------------------------------------------
// !SETTINGS
//--------------------------------------------------------------------

$lang['bf_site_name']			= '系統顯示名稱';
$lang['bf_term_begins']			= '設定開學日';
$lang['bf_site_email']			= '登記系統所使用的Email';
$lang['bf_site_email_help']		= '此為系統預設發送所使用的Email信箱';
$lang['bf_site_status']			= '系統狀態';
$lang['bf_online']				= '運作中';
$lang['bf_offline']				= '關閉';
$lang['bf_top_number']			= '每頁顯示的項目數量:';
$lang['bf_top_number_help']		= '列表顯示的數目';

$lang['bf_security']			= '安全';
$lang['bf_login_type']			= '登入類型';
$lang['bf_login_type_email']	= '只使用Email';
$lang['bf_login_type_username']	= '只使用帳號';
$lang['bf_allow_register']		= '允許使用者註冊?';
$lang['bf_login_type_both']		= '使用Email 或是 使用者帳號';
$lang['bf_use_usernames']		= '設定使用者登入後顯示的名稱';
$lang['bf_use_own_name']		= '使用名字';
$lang['bf_allow_remember']		= '允許啟用 \'記憶帳號功能\'?';
$lang['bf_remember_time']		= '記憶帳號時間設定:';
$lang['bf_week']				= '週';
$lang['bf_weeks']				= '週';
$lang['bf_days']				= '天';
$lang['bf_username']			= '使用者帳號';
$lang['bf_password']			= '密碼';
$lang['bf_password_confirm']	= '再輸入一次密碼';

$lang['bf_home_page']			= 'Home Page';
$lang['bf_pages']				= 'Pages';
$lang['bf_enable_rte']			= 'Enable RTE for pages?';
$lang['bf_rte_type']			= 'RTE Type';
$lang['bf_searchable_default']	= 'Searchable by default?';
$lang['bf_cacheable_default']	= 'Cacheable by default?';
$lang['bf_track_hits']			= 'Track Page Hits?';

$lang['bf_action_save']			= '儲存';
$lang['bf_action_delete']		= '刪除';
$lang['bf_action_cancel']		= '取消';
$lang['bf_action_download']		= '下載';
$lang['bf_action_preview']		= '預覽';
$lang['bf_action_search']		= '搜尋';
$lang['bf_action_purge']		= '清除';
$lang['bf_action_restore']		= '還原';
$lang['bf_action_show']			= '顯示';
$lang['bf_action_login']		= '登入';
$lang['bf_actions']				= '動作';


$lang['bf_do_check']			= '檢查是否有更新?';
$lang['bf_do_check_edge']		= 'Must be enabled to see bleeding edge updates as well.';

$lang['bf_update_show_edge']	= 'View bleeding edge updates?';
$lang['bf_update_info_edge']	= 'Leave unchecked to only check for new tagged updates. Check to see any new commits to the official repository.';

$lang['bf_ext_profile_show']	= 'Does User accounts have extended profile?';
$lang['bf_ext_profile_info']	= 'Check "Extended Profiles" to have extra profile meta-data available option(wip), omiting some default bonfire fields (eg: address).';

$lang['bf_yes']					= '是';
$lang['bf_no']					= '否';
$lang['bf_none']				= 'None';

$lang['bf_or']					= '或';
$lang['bf_size']				= '大小';
$lang['bf_files']				= '檔案';
$lang['bf_file']				= '檔案';

$lang['bf_with_selected']		= '所選擇的項目';

$lang['bf_env_dev']				= '開發用';
$lang['bf_env_test']			= '測試用';
$lang['bf_env_prod']			= '正式發布';


$lang['bf_user']				= '使用者';
$lang['bf_users']				= '使用者';
$lang['bf_username']			= '帳號';
$lang['bf_description']			= '敘述';
$lang['bf_email']				= 'Email';
$lang['bf_website']				= '網站';
$lang['bf_user_settings']		= '我的設定檔';

$lang['bf_both']				= 'both';
$lang['bf_go_back']				= '按此回到上一頁';
$lang['bf_new']					= 'New';
$lang['bf_required_note']		= '必填欄位會以 <b>粗體</b>顯示，';

$lang['bf_show_profiler']		= '顯示開發模式?';
$lang['bf_show_front_profiler']	= '開啟前台開發模式?';

$lang['bf_cache_not_writable']  = 'The application cache folder is not writable';

//--------------------------------------------------------------------
// MY_Model
//--------------------------------------------------------------------
$lang['bf_model_no_data']		= 'No data available.';
$lang['bf_model_invalid_id']	= 'Invalid ID passed to model.';
$lang['bf_model_no_table']		= 'Model has unspecified database table.';
$lang['bf_model_fetch_error']	= 'Not enough information to fetch field.';
$lang['bf_model_count_error']	= 'Not enough information to count results.';
$lang['bf_model_unique_error']	= 'Not enough information to check uniqueness.';
$lang['bf_model_find_error']	= 'Not enough information to find by.';
$lang['bf_model_bad_select']	= 'Invalid selection.';

//--------------------------------------------------------------------
// Contexts
//--------------------------------------------------------------------
$lang['bf_no_contexts']			= 'The contexts array is not properly setup. Check your application config file.';
$lang['bf_context_content']		= '主畫面';
$lang['bf_context_reports']		= '系統報告';
$lang['bf_context_settings']	= '系統設定';
$lang['bf_context_webcam']	= '監視器畫面';
$lang['bf_context_developer']	= '開發者工具';

//--------------------------------------------------------------------
// Activities
//--------------------------------------------------------------------
$lang['bf_act_settings_saved']	= 'App settings saved from';
$lang['bf_unauthorized_attempt']= 'unsuccessfully attempted to access a page which required the following permission "%s" from ';

$lang['bf_keyboard_shortcuts']		= '可使用的快速鍵:';

//--------------------------------------------------------------------
// Common
//--------------------------------------------------------------------
$lang['bf_question_mark']	= '?';
$lang['bf_language_direction']	= 'ltr';