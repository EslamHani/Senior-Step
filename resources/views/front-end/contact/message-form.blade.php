@extends('layouts.app')

@section('title')
	Contact
@endsection


@include('layouts.image-banner', ['CurrentPage' => 'Contact-Us'])


@section('content')

<div class="section landing-section">
@include('front-end.shared.contact-form')
</div>

@endsection
