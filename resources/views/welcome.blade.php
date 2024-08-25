@extends('layouts.app')

@section('title')
    Home
@endsection

@section('background-image')
<div class="page-header section-dark" style="background-image: url('{!! asset('/frontend/img/gray.jpg') !!}')">
    <div class="filter"></div>
    <div class="content-center">
        <div class="container" style="width: 100%;">
            <div class="title-brand">
                <h1 class="presentation-title">Senior Step</h1>
            </div>
            <h2 class="presentation-subtitle text-center">Get The Best Free Online Courses<br>Learn faster. Stay motivated. Study smarter.</h2>
            <center>
            <div class="col-md-10 offset-md-1">
            @include('front-end.search.form')
            </div>
          </center>
        </div>
    </div>
</div>
@endsection
  
@section('content')
<!-- Category Section -->
<div class="section">
    <div class="container text-center">
        @component('front-end.components.section-header', [
            'header'      => 'Browse our Courses Categories',
            'description' => 'Get The Best Free Online Courses'
        ])
        @endcomponent
        <div class="row">
            @foreach($categories as $category) 
                @include('front-end.categories.category-card')
            @endforeach 
        </div>
        @component('front-end.components.more-button', [
            'route' => 'categories',
            'name'  => 'Categories',
        ])
        @endcomponent
    </div>
</div> 

<!-- Website features -->
<div class="section section-dark section-nucleo-icons">
@include('front-end.shared.features')
</div>

<!-- Courses section -->
<div class="section">
    <div style="padding: 50px;">
          @component('front-end.components.section-header', [
                    'header'      => 'Browse our Courses',
                    'description' => 'Courses to get you started'
                ])
          @endcomponent
         <div class="row">
            @foreach($courses as $course) 
                <div class="col-lg-3 col-md-6 col-sm-12">
                @include('front-end.courses.course-card')
                </div>
            @endforeach 
         </div>
         @component('front-end.components.more-button', [
              'route' => 'courses',
              'name'  => 'Courses',
         ])
         @endcomponent
    </div>
</div>

<!-- Contact Form -->
<div class="section landing-section">
@include('front-end.shared.contact-form')
</div>

@endsection