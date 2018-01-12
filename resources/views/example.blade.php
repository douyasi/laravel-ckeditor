<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CKEditor Example - {{ $mode }}</title>
    {!! ckeditor_js() !!}
    {!! ckeditor_css() !!}
</head>
<body>
    <textarea id="editor1" cols="10" rows="10">
        &lt;p&gt;This is some sample text. You are using &lt;a href=&quot;http://ckeditor.com&quot;&gt;CKEditor&lt;/a&gt;, an online &lt;abbr title=&quot;What You See Is What You Get&quot;&gt;WYSIWYG&lt;/abbr&gt;&amp;nbsp;editor.&lt;/p&gt;
    </textarea>
    @section('ckeditorExtraScript')
    // 可以继续追加额外的 CKEditor 代码，具体请参考官方文档 https://sdk.ckeditor.com/ 或 https://docs.ckeditor.com/ckeditor4/docs/
    @overwrite
    @include('ckeditor::parts.'.$mode, ['editorId' => 'editor1'])
</body>
</html>