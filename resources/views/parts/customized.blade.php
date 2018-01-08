    <script type="text/javascript">
        CKEDITOR.replace("{{ $editorId }}", {
            @section('ckeditorExtraScript')
            @show{{-- laravel-ckeditor extra script --}}
        });
    </script>