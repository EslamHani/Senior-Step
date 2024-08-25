@extends('back-end.layout.app')

<!-- Meta Title -->
@section('title')
	{{ $PageTitle }}
@endsection

@section('content')
<!-- NavBar -->
@component('back-end.layout.header', ['nav' => $PageTitle])
@endcomponent
<!-- End NavBar -->

@component('back-end.shared.edit', ['PageTitle' => $PageTitle, 'PageDescription' => $PageDescription, 'routeName' => $routeName, 'show' => 0])
@slot('slot')
<form action="{{ route($routeName.'.update', ['id' => $row->id]) }}" method="post">
	@csrf
	@method('put')
	@include('back-end.'.$folderName.'.form')
  <button type="submit" class="btn btn-primary pull-right">Update {{ $ModulName }}</button>
  <div class="clearfix"></div>
</form>
@endslot
@endcomponent


@endsection