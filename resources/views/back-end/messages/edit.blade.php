@extends('back-end.layout.app')

<!-- Meta Title -->
@section('title')
	Replay Message
@endsection

@section('content')
<!-- NavBar -->
@component('back-end.layout.header', ['nav' => "Replay Message"])
@endcomponent
<!-- End NavBar -->

@component('back-end.shared.edit', ['PageTitle' => "Replay Message", 'PageDescription' => "Here You Can Send Mail", 'routeName' => $routeName, 'show' => 0])

@slot('slot')
<form action="{{ route($routeName.'.store') }}" method="post" enctype="multipart/form-data">
@csrf
@include('back-end.'.$folderName.'.form')
<input type="hidden" name="id" value="{{ $row->id }}">
<button class="btn btn-primary pull-right" type="submit">Send Mail
<i class="material-icons right">send</i>
</button>
<div class="clearfix"></div>
</form>
@endslot

@endcomponent


@endsection