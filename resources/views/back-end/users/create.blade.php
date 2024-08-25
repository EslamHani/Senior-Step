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
@component('back-end.shared.create', ['PageTitle' => $PageTitle, 'PageDescription' => $PageDescription, 'routeName' => $routeName])
@slot('slot')
<form action="{{ route($routeName.'.store') }}" method="post" enctype="multipart/form-data">
  @csrf
  @include('back-end.users.form')
  <button type="submit" class="btn btn-primary pull-right">Add User</button>
  <div class="clearfix"></div>
</form>
@endslot
@endcomponent

@endsection