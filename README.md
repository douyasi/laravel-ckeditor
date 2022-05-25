# CKEditor for Laravel

>  `CKEditor` —— 国外大名鼎鼎的富文本编辑器，官方网站：https://ckeditor.com/ 。目前官方最新版本为 `CKEditor5` ，建议配合 `React/Vue` 等前端框架工程化使用。

[![Latest Stable Version](https://poser.pugx.org/douyasi/laravel-ckeditor/v/stable.svg?format=flat-square)](https://packagist.org/packages/douyasi/laravel-ckeditor)
[![Latest Unstable Version](https://poser.pugx.org/douyasi/laravel-ckeditor/v/unstable.svg?format=flat-square)](https://packagist.org/packages/douyasi/laravel-ckeditor)
[![License](https://poser.pugx.org/douyasi/laravel-ckeditor/license?format=flat-square)](https://packagist.org/packages/douyasi/laravel-ckeditor)
[![Total Downloads](https://poser.pugx.org/douyasi/laravel-ckeditor/downloads?format=flat-square)](https://packagist.org/packages/douyasi/laravel-ckeditor)


## 兼容版本

本扩展包经过测试，适配 `Laravel 5.1` 以上稳定版本（`5.0` 版本理论上也是可行的，但未经测试）。

## 安装与配置

在 `composer.json` 新增 `"douyasi/laravel-ckeditor": "~1.0"` 依赖，然后执行： `composer update` 操作。

依赖安装完毕之后，在 `app.php` 中添加：

```php
'providers' => [
        'Douyasi\CKEditor\CKEditorServiceProvider',
],
```

然后，执行下面 `artisan` 命令，发布该扩展包配置等项。

```bash
php artisan vendor:publish --provider="Douyasi\CKEditor\CKEditorServiceProvider" --force
```

现在您可以访问 `/laravel-ckeditor/example/basic` (基础版）或 `/laravel-ckeditor/example/standard` (标准版）或 `/laravel-ckeditor/example/full` (完整版）路由，不出意外，您可以看到扩展包提供的示例页面。

编辑器图片默认会上传到 `public/uploads/content` 目录下；编辑器相关功能配置位于 `config/ckeditor.php` 文件中。

## 使用说明

>   参考本扩展包 `resources\views` 目录下 `example` 代码，引入必须的静态的资源 `{!! ckeditor_js() !!}` 和 `{!! ckeditor_css() !!}` 。

#### 各版本编辑器工具栏对比图

![基础版](http://mweb-upyun.test.upcdn.net/2018/01/12/23f5d8cb246f111d2ab1d83abfad2cf0.png)
图1 - 基础（`basic`）版

![标准版](http://mweb-upyun.test.upcdn.net/2018/01/12/f41ba89ad60005d6d52fa8ff8962c296.png)
图2 - 标准（`standard`）版 

![完整版](http://mweb-upyun.test.upcdn.net/2018/01/12/62a7d4b79d60f739b314619049b2511c.png)
图3 - 完整（`full`）版  

目前本扩展包自定义（`customized`）版与完整版完全相同，发布包资源之后，开发者自行配置与修改 `customized.blade.php` 模板文件（位于 `resource/views/vendor/ckeditor/parts/` 目录），其他版本的模板建议不要修改。


#### 使用示例

如果想使用 `CKEditor` 基础版编辑器，就引入 `@include('ckeditor::parts.basic', ['editorId' => 'editor1'])` 代码。其中，传入的 `editorId` 变量值需与前端上面 `textarea` 元素 `id` 一一对应。其他版本，如 `standard` (标准版）、 `full` （完整版） 、 `customized` （自定义版）以此来推。

下面示例代码引入的 `full` 版 CKEditor 编辑器：

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CKEditor Example</title>
    {!! ckeditor_js() !!}
    {!! ckeditor_css() !!}
</head>
<body>
    <textarea id="editor1" cols="10" rows="10">
        &lt;p&gt;This is some sample text. You are using &lt;a href=&quot;http://ckeditor.com&quot;&gt;CKEditor&lt;/a&gt;, an online &lt;abbr title=&quot;What You See Is What You Get&quot;&gt;WYSIWYG&lt;/abbr&gt;&amp;nbsp;editor.&lt;/p&gt;
    </textarea>
    @section('ckeditorExtraScript')
    // 可以继续追加额外的 CKEditor 代码，具体请参考官方文档 https://sdk.ckeditor.com/ 或 https://docs.ckeditor.com/ckeditor4/docs/
    language: 'zh-TW',
    uiColor: '#9AB8F3',
    filebrowserImageUploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&type=images&by=btn_up',
    // filebrowserUploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&by=btn_up',
    imageUploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&type=images&by=drop_or_clipboard_up',  // only for image
    // uploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&by=drop_or_clipboard_up',
    @overwrite
    @include('ckeditor::parts.full', ['editorId' => 'editor1'])
</body>
</html>
```

#### 图片上传

图片上传默认使用本扩展包提供的服务（仅限本地存储），你也可以编写自己的代码使用自己的
路由。要禁用本包上传服务，只需修改 `ckeditor.php` 配置中 `usingLocalPackageUploadServer` 项为 `false` 。

图片上传支持三种模式：传统表单、浏览器拖曳上传和剪切板粘贴图片上传（PS - 部分浏览器可能不支持拖曳与剪切板粘贴上传）。

![upload-gif](https://s1.ystatic.cn/uploads/content/20180503/5aeb2a713fcf5_45o.gif) 

传统浏览器 form 表单按钮提交上传，需配置 `filebrowserImageUploadUrl`  或 `filebrowserUploadUrl` ；浏览器拖曳文件上传或者剪切板粘贴图片上传，需配置 `imageUploadUrl` 或 `uploadUrl` ：

```javascript
filebrowserImageUploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&type=images&by=btn_up',
imageUploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&type=images&by=drop_or_clipboard_up',
filebrowserUploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&by=btn_up',
uploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&by=drop_or_clipboard_up',
```

## 关于

博客 ： http://douyasi.com

>   `Copyright (c) 2014-2099` [douyasi](https://github.com/douyasi) - 由 [ycrao](https://raoyc.com) 创建的组织。