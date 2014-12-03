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

$lang['role_manage']				= '管理網站角色';
$lang['role_no_roles']				= '此系統中無任何角色';
$lang['role_create_button']			= '建立新角色';
$lang['role_create_note']			= '每個使用者皆須有一個角色，請確保所有使用者都有相對應的角色設定';
$lang['role_distribution']			= '帳號分類';
$lang['role_account_type']			= '帳號類型';

$lang['role_name']					= '角色名稱';
$lang['role_max_desc_length']		= '最大255字元';
$lang['role_default_role']			= '預設角色';
$lang['role_default_note']			= '確認這個角色是否要指派給所有新使用者';
$lang['role_permissions']			= '權限';
$lang['role_permissions_check_note']	= '確認所有應用到此角色的權限';
$lang['role_save_role']				= '儲存角色';
$lang['role_delete_role']			= '刪除角色';
$lang['role_delete_note']			= '刪除此角色將轉換所有使用者到預設角色';
$lang['role_can_delete_role']    = '可移除';	
$lang['role_can_delete_note']    = '這個角色可被刪除?';

$lang['role_roles']					= '角色';
$lang['role_new_role']				= '新角色';

$lang['role_login_destination']		= '登入目的地';
$lang['role_destination_note']		= '這個網址將會重新導向至成功登入頁面';

$lang['matrix_header']				= '權限控制';
$lang['matrix_permission']			= '名稱';
$lang['matrix_role']				= '角色';
$lang['matrix_note']				= '權限控制頁面，勾選方框啟動或移除權限';
$lang['matrix_insert_success']		= '權限已新增至您指定的角色中';
$lang['matrix_insert_fail']			= '發生錯誤，請參考以下資訊: ';
$lang['matrix_delete_success']		= '權限已從您指定的角色中移除';
$lang['matrix_delete_fail']			= '發生錯誤，請參考以下資訊: ';
$lang['matrix_auth_fail']			= '系統訊息：您目前無權限設定此網站角色的權限';