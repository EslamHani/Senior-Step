@extends('layouts.app')

@section('title')
	All Categories
@endsection

@include('layouts.image-banner', ['CurrentPage' => 'Categories'])

@section('content')

<div class="section">
    <div class="container text-center" style="margin-top: -60px;">
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
        <div class="row">
            <div class="col-md-12">
                {!! $categories->links() !!}
            </div>
        </div>
    </div>
</div>
 
@endsection
