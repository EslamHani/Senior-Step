@extends('back-end.layout.app')

<!-- Meta Title -->
@section('title')
	{{ $PageTitle }}
@endsection

@push('css')
<script src="https://cdn.tiny.cloud/1/s75hit7ybx0ssacci8e1p28qmpspejkhrjf6md7ukc0tinpp/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	tinymce.init({
		selector: 'textarea',
		height: 400,
		menubar: true,
		plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
		powerpaste_allow_local_images: true,
		powerpaste_word_import: 'prompt',
		powerpaste_html_import: 'prompt',
		content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
	});
</script>
@endpush

@section('content')
<!-- NavBar -->
@component('back-end.layout.header', ['nav' => $PageTitle])
@endcomponent
<!-- End NavBar -->
@component('back-end.shared.create', ['PageTitle' => $PageTitle, 'PageDescription' => $PageDescription, 'routeName' => $routeName])
@slot('slot')
<form action="{{ route($routeName.'.store') }}" method="post" enctype="multipart/form-data">
  @csrf
  @include('back-end.'.$folderName.'.form')
  <button type="submit" class="btn btn-primary pull-right">Add {{ $ModulName }}</button>
  <div class="clearfix"></div>
</form>
@endslot
@endcomponent



@endsection