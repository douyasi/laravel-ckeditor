    <script type="text/javascript">
        CKEDITOR.replace("{{ $editorId }}", {
            toolbar : [
                { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                { name: 'editing', items: [ 'Scayt' ] },
                { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
                { name: 'tools', items: [ 'Maximize' ] },
                { name: 'document', items: [ 'Source' ] },
                '/',
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
                { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                { name: 'styles', items: [ 'Styles', 'Format' ] },
                { name: 'about', items: [ 'About' ] }
            ],
            @section('ckeditorExtraScript')
            @show{{-- laravel-ckeditor extra script --}}
        });
    </script>