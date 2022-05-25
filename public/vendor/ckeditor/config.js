/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.pasteFromWordRemoveStyles = true;
    config.forcePasteAsPlainText = true;
    config.image_previewText = ' ';
    config.font_names='宋体/宋体, SimSun;'+'微软雅黑/微软雅黑, Microsoft YaHei;'+'黑体/黑体, SimHei;'+'楷体/楷体, 楷体_GB2312, SimKai;'+'隶书/隶书, SimLi;'+ 'Hiragino Sans GB;' + config.font_names;
    config.defaultLanguage = 'zh-cn';
    config.font_defaultLabel = '宋体';
};
