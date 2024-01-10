<?php
/**
 * Created by PhpStorm.
 * User: Dagmar Mpheio
 * Date: 10/27/2020
 * Time: 3:02 PM
 */
?>

@section('style')
    <link rel="stylesheet" href="/backend/plugins/tag-editor/jquery.tag-editor.css">
@endsection

@section('script')
    <script src="/backend/plugins/tag-editor/jquery.caret.min.js"></script>
    <script src="/backend/plugins/tag-editor/jquery.tag-editor.min.js"></script>

    <script type="text/javascript">
        var options = {};
        @if($post->exists)
            options = {
            initialTags: {!! $post->tags_list !!}
        };
        {{-- options = {
            initialTags: {!! json_encode($post->tags->pluck('name')) !!},
        };--}}
        @endif

        $('input[name=post_tags]').tagEditor(options);//tag editor

        $('ul.pagination').addClass('no-margin pagination-sm');

        /*criar o slug automaticamente*/
        $('#title').on('blur', function () {
            var theTitle = this.value.toLowerCase().trim(),
                slugInput = $('#slug'),
                theSlug = theTitle.replace(/&/g, '-and-')
                    .replace(/[^a-z0-9-]+/g, '-')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+|-+$/g, '');

            slugInput.val(theSlug);
        });

        /*activar markdowns no excerpt e body*/
        var simplemde1 = new SimpleMDE({element: $('#excerpt')[0]});
        var simplemde2 = new SimpleMDE({element: $('#body')[0]});

        //bootstrap timepicker
        $('#published_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            showClear: true
        });

        //botao rascunho
        $('#draft-btn').click(function (e) {
            e.preventDefault();
            $('#published_at').val("");
            $('#post-form').submit();
        });

    </script>
@endsection
