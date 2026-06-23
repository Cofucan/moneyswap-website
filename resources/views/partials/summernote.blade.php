@push('styles')
<link href="{{ asset('lib/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush


@push('scripts')
<script src="{{ asset('lib/summernote/summernote-lite.min.js')}}"></script>
<script>
  $('#textarea, .summernote').summernote({
    tabsize: 2,
    height: 200,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });
</script>
@endpush
