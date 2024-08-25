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
<form action="{{ route($routeName.'.store') }}" method="post">
  @csrf
  @include('back-end.'.$folderName.'.form')
  <button type="submit" class="btn btn-primary pull-right">Add {{ $ModulName }}</button>
  <div class="clearfix"></div>
</form>
@endslot
@endcomponent



@endsection