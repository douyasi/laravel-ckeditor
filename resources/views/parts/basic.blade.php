    <script type="text/javascript">
        CKEDITOR.replace("{{ $editorId }}", {
            toolbar : [
                { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
                { name: 'basicstyles', items: [ 'Bold', 'Italic' ] },
                { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] },
                { name: 'links', items: [ 'Link', 'Unlink' ] },
                { name: 'about', items: [ 'About' ] }
            ],
            @section('ckeditorExtraScript')
            @show{{-- laravel-ckeditor extra script --}}
        });
    </script>