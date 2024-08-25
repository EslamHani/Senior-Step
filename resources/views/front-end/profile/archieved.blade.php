@extends('layouts.app')

@section('title')
	{{ $user->name }}
@endsection
@push('css')

@endpush

@section('content')

@include('front-end.profile.profile-banner')

<div class="section profile-content">
    <div class="container">
        @include('front-end.profile.user-image')
        <div class="row">
            <div class="col-md-12">
                <h5 class="archiveHead">
                    <i class="fa fa-list" aria-hidden="true" style="font-size: 16px;"></i> My Courses
                </h5><br>
            </div>
            <!-- User Coureses -->
            @forelse($user->courses_user as $course)
                <div class="col-md-4">
                    @include('front-end.courses.course-card')
                </div>
            @empty
                <div class="col-md-12">
                    <center>
                        <h1 class="msg">
                           No Archieved Courses Yet...
                        </h1>
                    </center><br>
                </div>
            @endforelse 
            <!-- User Courses -->
        </div>
    </div>
</div>
@endsection
