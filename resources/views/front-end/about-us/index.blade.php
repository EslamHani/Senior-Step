@extends('layouts.app')

@section('title')
  About-Us
@endsection


@include('layouts.image-banner', ['CurrentPage' =>  'About-Us'])


@section('content')
<div class="container" style="text-align: center;">
    <div class="title" style="text-align: center;">
        <h3 class="aboutUs-header">Senior Step Team</h3>
    </div>
    <div class="row">
        <div class="col-md-12 mr-auto">
            <img src="/uploads/EslamHani.jpg" class="img-thumbnail img-responsive" alt="Rounded Image"  width="200" height="200">
            <p class="text-center aboutUs-pg1">
                Eslam Hany
            </p>
            <small class="text-center aboutUs-pg2">
                Web Developer
            </small>
        </div>
    </div>
</div>
@endsection
