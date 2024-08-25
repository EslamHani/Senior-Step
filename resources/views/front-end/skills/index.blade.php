@extends('layouts.app')

@section('title')
	{{ $skill->skill_name }}
@endsection
@section('meta_keywords')
    {{ $skill->meta_keywords }}
@endsection
@section('meta_desc')
    {{ $skill->meta_desc }}
@endsection

@include('layouts.image-banner', ['CurrentPage' => $skill->skill_name])

@section('content')
<div class="section">
    <div style="padding: 50px; margin-top: -100px;">
        @component('front-end.components.section-header', [
            'header' => 'Our Courses of ' .  $skill->skill_name ,
            'description' => 'Get The Best Free Online Courses',
        ])
        @endcomponent
         <div class="row">
            @foreach($courses as $course) 
                <div class="col-md-3">
                @include('front-end.courses.course-card')
                </div>
            @endforeach 
         </div>
         <div class="row">
            <div class="col-md-12">
                {!! $courses->links() !!}
            </div>
         </div>
    </div>
</div> 
@endsection
