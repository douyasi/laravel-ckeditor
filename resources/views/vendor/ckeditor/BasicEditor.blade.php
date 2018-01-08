<!--using basic CKEditor-->
<script src="{{ _asset(ref('ckeditor.js')) }}"></script>
<script>
  CKEDITOR.editorConfig = function( config ) {
    config.toolbar = [
      { name: 'basicstyles', items: [ 'Bold', 'Italic' ] },
      { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] },
      { name: 'links', items: [ 'Link', 'Unlink' ] },
      { name: 'about', items: [ 'About' ] }
    ];
  };

  CKEDITOR.replace( 'ckeditor', {
    "toolbar" :  [
      { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
      { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ '-' ] },
      { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic' ] },
      { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] },
      { name: 'links', items: [ 'Link', 'Unlink' ] },
      { name: 'others', items: [ '-' ] },
      { name: 'about', items: [ 'About' ] }
    ]
  });
</script>