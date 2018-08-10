<!-- CKeditor -->
<div @include('crud.inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud.inc.field_translatable_icon')
    <div
        id="editormd-{{ $field['name'] }}"
        @include('crud.inc.field_attributes', ['default_class' => 'form-control'])
        ><textarea name="{{ $field['name'] }}" style="display:none;">### Hello Editor.md !</textarea></div>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <script src="/fadmin/editormd/editormd.js"></script>
        <link rel="stylesheet" href="/fadmin/editormd/css/editormd.css" />
    @endpush

@endif

{{-- FIELD JS - will be loaded in the after_scripts section --}}
@push('crud_fields_scripts')
<script>
    var testEditor = editormd("editormd-{{ $field['name'] }}",{
        width :"100%",
        height :640,
        path :"/fadmin/editormd/lib/",
        watch : false,
        saveHTMLToTextarea :true
    });
    testEditor.getHTML();// 获取 Textarea 保存的 HTML 源码
</script>
@endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
