@extends('back-end.layout.app')

<!-- Meta Title -->
@section('title')
	{{ $PageTitle }}
@endsection

@push('css')
<script src="https://cdn.tiny.cloud/1/s75hit7ybx0ssacci8e1p28qmpspejkhrjf6md7ukc0tinpp/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#question',
        height: 400,
        menubar: false,
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
        content_style: 'body { font-family:sans-serif; font-size:17px }',
    });
</script>
@endpush

@section('content')
<!-- NavBar -->
@component('back-end.layout.header', ['nav' => $PageTitle])
@endcomponent
<!-- End NavBar -->

@component('back-end.shared.edit', ['PageTitle' => $PageTitle, 'PageDescription' => $PageDescription, 'routeName' => $routeName, 'show' => 0])
@slot('slot')
<form action="{{ route($routeName.'.update', ['id' => $row->id]) }}" method="post" enctype="multipart/form-data" >
	@csrf
	@method('put')
	@include('back-end.'.$folderName.'.form')
  <button type="submit" class="btn btn-primary pull-right">Update {{ $ModulName }}</button>
  <div class="clearfix"></div>
</form>
@endslot
@endcomponent

@endsection