# CKEditor for Laravel

>  `CKEditor` —— 国外大名鼎鼎的富文本编辑器，官方网站：https://ckeditor.com/ 。

[![Latest Stable Version](https://poser.pugx.org/douyasi/laravel-ckeditor/v/stable.svg?format=flat-square)](https://packagist.org/packages/douyasi/laravel-ckeditor)
[![Latest Unstable Version](https://poser.pugx.org/douyasi/laravel-ckeditor/v/unstable.svg?format=flat-square)](https://packagist.org/packages/douyasi/laravel-ckeditor)
[![License](https://poser.pugx.org/douyasi/laravel-ckeditor/license?format=flat-square)](https://packagist.org/packages/douyasi/laravel-ckeditor)
[![Total Downloads](https://poser.pugx.org/douyasi/laravel-ckeditor/downloads?format=flat-square)](https://packagist.org/packages/douyasi/laravel-ckeditor)

## 兼容版本

本扩展包经过测试，适配 `Laravel 5.1` 以上稳定版本（`5.0` 版本理论上也是可行的，但未经测试）。

## 安装与配置

在 `composer.json` 新增 `"douyasi/laravel-editor-md": "dev-master"` 依赖，然后执行： `composer update` 操作。

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

参考本扩展包 `resources\views` 目录下 `example` 代码，引入必须的静态的资源 `{!! ckeditor_js() !!}` 和 `{!! ckeditor_css() !!}` 。

如需要使用 `CKEditor` 基础版工具栏布局，就引入 `@include('ckeditor::parts.basic', ['editorId' => 'editor1'])` 其中 传入的 `editorId` 变量值需与前端上面 `textarea` 元素 `id` 一一对应。其他版本，如 `standard` (标准版）、 `full` （完整版） 、 `customized` （自定义版）以此来推，自定义版的 `blade` 模板可供开发者自行配置与修改（其他版本建议不要随意修改）。

`full` 版使用示例：

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
    @overwrite
    @include('ckeditor::parts.'.$mode, ['editorId' => 'editor1'])
</body>
</html>
```




