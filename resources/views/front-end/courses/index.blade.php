@extends('layouts.app')

@section('title')
	Courses
@endsection
@if(isset($category))
@section('meta_keywords'){{ $category->meta_keywords }}@endsection
@section('meta_desc'){{ $category->meta_desc }}@endsection
@endif

@include('layouts.image-banner', ['CurrentPage' => 'Courses'])

@section('content')
<div class="section">
    <div style="padding: 50px; margin-top: -100px;">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-8 ml-auto mr-auto text-center">
                <h3 class="title" style="font-weight: bold; color: gray;">
                @if(isset($search) && $search != "")
                    @if($courses->count() != 0)
                        Search Result 
                    @else
                        No results found<br>
                        <small>Try different keywords</small>
                    @endif
                @else
                     Our Courses {{ isset($category) && $category != "" ? ' of ' . $category->category_name : '' }}
                @endif 
                </h3>
                @if(!isset($search) || $search == "")
                    <p class="description" style="font-weight: bold; margin-top: -20px;">Courses to get you started</p>
                @endif
            </div>
         </div>
         <div class="row">
            @foreach($courses as $course) 
            <div class="col-lg-3 col-md-6 col-sm-12">
                @include('front-end.courses.course-card')
            </div>
            @endforeach 
         </div>
         <div class="row">
            <div class="col-md-12">
                {!! $courses->appends(request()->query())->links() !!}
            </div>
         </div>
    </div>
</div> 
@endsection
