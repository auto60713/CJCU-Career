<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$lang['mig_intro']					= '本工具幫助您解決二次開發時可能出現的資料庫版本差異問題，並且提供一個簡單的方式執行版本控制';
$lang['mig_not_enabled']			= 'Migrations are not enabled.';
$lang['mig_installed_version']		= '已安裝的版本:';
$lang['mig_latest_version']			= '最新可用的版本:';
$lang['mig_db_not_current']			= '您的資料庫不是最新的';
$lang['mig_no_migrations']			= '沒有任何可用的版本';

$lang['mig_migrate_note']			= 'Performing migrations <b>WILL</b> change your database structure, possibly ending in disaster. If you are not comfortable with your migrations, please verify them before continuing.';
$lang['mig_migrate_to']				= 'Migrate database to version';
$lang['mig_choose_migration']		= '遷移至指定版本:';
$lang['mig_migrate_button']			= '執行';

$lang['mig_app_migrations']			= "應用程式設定";
$lang['mig_core_migrations']		= "Bonfire 框架設定";
$lang['mig_mod_migrations']			= "模組設定";