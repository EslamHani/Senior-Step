@extends('layouts.app')

@section('title')
	{{ $course->course_name }}
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<style type="text/css">
    .list-group-videos{
        max-height:100%;
        overflow:scroll;
        -webkit-overflow-scrolling: touch;
    }
</style>
@endpush

@section('meta_keywords'){{ $course->meta_keywords }}@endsection
@section('meta_desc'){{ $course->meta_desc }}@endsection

@include('layouts.image-banner', ['CurrentPage' =>  $course->course_name])
    
@section('content')
<div class="section">
    <div class="container" style="margin-top: -70px;">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-9">
                <h3 class="title video-title">
                    {{ $course->course_name }}
                </h3>
                <p class="p" style="margin-top: -20px;">
                    {{ $course->course_desc }}.
                </p>
            </div>
        </div>

        @include('front-end.videos.course-buttons')

        <div class="row" id="watch">
            <div class="col-lg-8 col-md-12 col-sm-12">
                @include('front-end.videos.video_show')
            </div>
			<div class="col-lg-4 col-md-12 col-sm-12">
    		    @include('front-end.videos.list_videos')
                @include('front-end.videos.skills_tags')
			</div> 
        </div><br>

        <div class="row">
            <div class="col-md-8">
                @include('front-end.comments.index')
            </div>

        
            <div class="col-md-4">
                @auth
        	       @include('front-end.comments.create')
                @endauth
            </div>
        </div><br><br>

        <div class="row">
            @if($related_courses->count() > 0)
                <div class="col-md-12" style="margin-bottom: 20px;">
                    <h5 class="rel-courses">
                        <i class="fa fa-th-list" aria-hidden="true"></i> 
                        Related Courses
                    </h5><hr>
                </div>
            @endif

            @foreach($related_courses as $course)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    @include('front-end.courses.course-card')
                </div>
            @endforeach
        </div>

        <div id="transcript" style="margin-bottom: 80px"></div>

        <div class="row">
            <div class="col-md-8" style="margin-bottom: 20px;">
                <h5 class="video-title">
                    <i class="fa fa-pencil-square" aria-hidden="true"></i> 
                    Lesson Transcript
                </h5><hr>
            </div>

            <div class="col-md-8">
                {!!  $watch->transcript !!}
            </div>
            @include('front-end.shared.popular-categories-tags') 
        </div>    
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
       
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function archiveCourse(course_id)
        {
             toastr.options = {
                  defaultTimeout: 1000,
                  "closeButton": true,
                  "newestOnTop": true,
                  "positionClass": "toast-top-right",
                };

            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/archive/'+course_id,
                success: function(response){
                    $('#archiveCourse').prop('hidden', true);
                    $('#unarchiveCourse').prop('hidden', false);
                    toastr.success(response.success);
                }
            });
        }

        function likeVideo(videoId)
        {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/videos/'+videoId+'/like',
                success: function(response)
                {
                    $('#count2').text(response.count);
                    if(response.isLiked == true)
                    {
                        $('#likeButton').addClass('liked');
                    }
                    else
                    {
                        $('#likeButton').removeClass('liked');                       
                    }
                }
            })
        }


        function unarchiveCourse(course_id)
        {
            toastr.options = {
                  defaultTimeout: 1000,
                  "closeButton": true,
                  "newestOnTop": true,
                  "positionClass": "toast-top-right",
                };

            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/unarchive/'+course_id,
                success: function(response){
                    $('#archiveCourse').prop('hidden', false);
                    $('#unarchiveCourse').prop('hidden', true);
                    toastr.success(response.success);                    
                }
            });
        }
    </script>
@endpush
