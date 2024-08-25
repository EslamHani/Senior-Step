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
<form action="{{ route($routeName.'.update', ['id' => $row->id]) }}" method="post" enctype="multipart/form-data">
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
	  	<div class="card-avatar">
			<img class="img" src="{{ url($row->image) }}" alt="Profile Pic">
		</div>
		<div class="card-body">
		  	<h4 class="card-title">{{$row->name}}</h4>
		    <h6 class="card-category text-gray">Country : {{$row->country}} <br>Adderss : {{ $row->address }}</h6>
		    <p class="card-description">Bio : {{$row->bio}}</p>
		    <a href="{{ route('userprofile', ['id' => $row->id]) }}" class="btn btn-primary btn-round">View Profile</a>
		</div>
	</div>	
</div>
@endslot
@endcomponent
@endsection