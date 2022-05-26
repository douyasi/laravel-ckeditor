# CKEditor(4) for Laravel with image upload support

>  [CKEditor](https://ckeditor.com), A famous WYSIWYG editor for web.

[![Latest Stable Version](https://poser.pugx.org/douyasi/laravel-ckeditor/v/stable.svg?format=flat-square)](https://packagist.org/packages/douyasi/laravel-ckeditor)
[![Latest Unstable Version](https://poser.pugx.org/douyasi/laravel-ckeditor/v/unstable.svg?format=flat-square)](https://packagist.org/packages/douyasi/laravel-ckeditor)
[![License](https://poser.pugx.org/douyasi/laravel-ckeditor/license?format=flat-square)](https://packagist.org/packages/douyasi/laravel-ckeditor)
[![Total Downloads](https://poser.pugx.org/douyasi/laravel-ckeditor/downloads?format=flat-square)](https://packagist.org/packages/douyasi/laravel-ckeditor)

## Update Log

- Version `1.2` have published on `2022/05/25`, update `CKEditor(4)` to current newest version `4.19.0`, make some adapters to image uploads

## Compatibility

This package have been tested for `Laravel 5` up versions. It's compatible with Laravel from `5` to `9` by all versions.

## Installation and Configurations

Add `"douyasi/laravel-ckeditor": "~1.0"` to your Laravel project `composer.json` file. 

Or, just execute `composer require "douyasi/laravel-ckeditor:~1.0"` command in your terminal when change to target project directory.

```bash

$ cd /path/to/your/laravel/project
$ vim composer.json
# add "douyasi/laravel-ckeditor": "~1.0" to it
$ composer install/update -vvv
# or execute
$ composer require "douyasi/laravel-ckeditor: ~1.0"
```

If Laravel package discovery failed, you need to add code below to Laravel `config/app.php` file:

```php
'providers' => [
        'Douyasi\CKEditor\CKEditorServiceProvider',
],
```

Execute `artisan` command below in terminal to publish all assets by this package.

```bash
php artisan vendor:publish --provider="Douyasi\CKEditor\CKEditorServiceProvider" --force
```

Then, serve your Laravel app, and visit links below.

```bash
$ php artisan serve
# then visit
# http://127.0.0.1:8000/laravel-ckeditor/example/basic
# http://127.0.0.1:8000/laravel-ckeditor/example/standard
# http://127.0.0.1:8000/laravel-ckeditor/example/full
```

`/laravel-ckeditor/example/basic` for basic mode, and `/laravel-ckeditor/example/standard` for standard mode, and `/laravel-ckeditor/example/full` for full mode.

Images will be upload to `public/uploads/content` directory, and the config file of this package is located in `config/` directory named `ckeditor.php`.

## Usage

>   See the `example.blade.php` code in `resources\views` directory, you need add `{!! ckeditor_js() !!}` and `{!! ckeditor_css() !!}` in your blade template file for loading CKEditor's static assets.

#### Toolbar layout under different CKEditor(4) modes

![basic](http://mweb-upyun.test.upcdn.net/2018/01/12/23f5d8cb246f111d2ab1d83abfad2cf0.png)
Figure 1 - `basic` mode

![standard](http://mweb-upyun.test.upcdn.net/2018/01/12/f41ba89ad60005d6d52fa8ff8962c296.png)
Figure 2 - `standard` mode

![full](http://mweb-upyun.test.upcdn.net/2018/01/12/62a7d4b79d60f739b314619049b2511c.png)
Figure 3 - `full` mode

`customized` mode as same as full mode, you can modify it (located in `resource/views/vendor/ckeditor/parts/customized.blade.php` directory) after package asset published. Other versions should not be modified. 

#### Example

Here is an example of `full` mode of CKEditor in blade html/php file. Include the code `@include('ckeditor::parts.basic', ['editorId' => 'editor1'])` when using basic mode. The value of `editorId` should be as same as the value of `id` in html `textarea` element (that rendered as `CKEditor` instance here). Other modes are similar without examples here.

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
    // add some addon config, ref: https://sdk.ckeditor.com/ or https://docs.ckeditor.com/ckeditor4/docs/
    language: 'zh-TW',
    uiColor: '#9AB8F3',
    filebrowserImageUploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&type=Images&by=btn_up',
    // filebrowserUploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&by=btn_up',
    imageUploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&type=Images&by=drop_or_clipboard_up',  // only for image
    // uploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&by=drop_or_clipboard_up',
    @overwrite
    @include('ckeditor::parts.full', ['editorId' => 'editor1'])
</body>
</html>
```

#### Upload Image(s)

Make your own image or file upload code, just change `usingLocalPackageUploadServer` value to `false` in `ckeditor.php` file to disable image upload by this package.

Support upload a image by three ways:

- btn upload: traditional form upload, need to select a file and click a button
- drop upload: drop/drag image file to browser editor area, then upload automatically
- clipboard upload: screen shot to clipboard and paste it to editor area, then upload automatically

![upload-gif](https://s1.ystatic.cn/uploads/content/20180503/5aeb2a713fcf5_45o.gif) 

Setting `filebrowserImageUploadUrl` or `filebrowserUploadUrl` value when using traditional form upload, setting `imageUploadUrl` or `uploadUrl` value when using drop or clipboard upload.

```javascript
filebrowserImageUploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&type=Images&by=btn_up',
imageUploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&type=Images&by=drop_or_clipboard_up',
filebrowserUploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&by=btn_up',
uploadUrl : '/laravel-ckeditor/upload?_token={!! csrf_token() !!}&by=drop_or_clipboard_up',
```

## About

blog: http://douyasi.com

>   `Copyright (c) 2014-2099` [douyasi](https://github.com/douyasi)