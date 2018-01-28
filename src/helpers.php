<?php

/**
 * CKEditor css 相关依赖
 * 
 * @return string
 */
function ckeditor_css()
{

    return '<!--CKEditor css-->
    <link href="/vendor/ckeditor/contents.css" rel="stylesheet">';

}

/**
 * CKEditor js 相关依赖
 *
 * @param boolean $using_min 是否使用压缩版js，默认true
 * @return string
 */
function ckeditor_js()
{
    return '<script type="text/javascript" src="/vendor/ckeditor/ckeditor.js"></script>';
}


/**
 * 取得 CKEditor 入库的正文内容
 *
 * @param string $content
 * @return string
 */
function ckeditor_content($content)
{
    return htmlspecialchars_decode($content);
}