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

@component('back-end.shared.edit', ['PageTitle' => $PageTitle, 'PageDescription' => $PageDescription, 'routeName' => $routeName, 'show' => 1])
@slot('slot')
<form action="{{ route($routeName.'.update', ['id' => $row->id]) }}" method="post" enctype="multipart/form-data" >
	@csrf
	@method('put')
	@include('back-end.'.$folderName.'.form')
  <button type="submit" class="btn btn-primary pull-right">Update {{ $ModulName }}</button>
  <div class="clearfix"></div>
</form>
@endslot
@slot('profile_card')
<div class="col-md-4">
	<div class="card card-profile">
	  	<div class="card-body">
	    	<img src="{{ url($row->image) }}" alt="Category image" style="width: 100%; height: 300px;" title="Category Image">
		</div>
	</div>	
</div>
@endslot
@endcomponent

@endsection