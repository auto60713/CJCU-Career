/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'zh';
	// config.uiColor = '#AADC6E';
	//工具列設定
	config.toolbar = 'TadToolbar';
	config.height = '500px';
    config.toolbar_TadToolbar =
    [
        ['Source','-','Templates','-','Cut','Copy','Paste'],
        ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
        ['Link','Unlink','Anchor'],
        ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
        '/',
        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Format','FontSize','-','TextColor','BGColor']
    ];
	CKEDITOR.plugins.load('pgrfilemanager');
	//開啟圖片上傳功能
	//config.filebrowserBrowseUrl = 'ckfinder/ckfinder.html';
	//config.filebrowserImageBrowseUrl = 'ckfinder/ckfinder.html?Type=Images';
	//config.filebrowserFlashBrowseUrl = 'ckfinder/ckfinder.html?Type=Flash';
	//config.filebrowserUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	//config.filebrowserImageUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	//config.filebrowserFlashUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
