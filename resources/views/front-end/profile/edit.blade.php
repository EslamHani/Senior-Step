@extends('layouts.app')

@section('title')
    {{ $user->name }}
@endsection
@push('css')
    <style type="text/css">
        body{
            font-family: sans-serif;
        }
    </style>
@endpush

@section('content')

@include('front-end.profile.profile-banner')

<div class="section profile-content">
    <div class="container">
        @include('front-end.profile.user-image')
        <div class="row">
            <div class="col-md-12">
                <h5 class="h5-edit">
                <i class="fa fa-user" aria-hidden="true" style="font-size: 16px;"></i> Edit Profile
                </h5>
            </div>
        </div><br>
        <form method="POST" action="{{ route('userProfileUpdate', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('front-end.shared.profile-form')
            <div class="row">
                <div class="col-md-12">
                    @include('front-end.shared.discussion-buttons', ['button' => 'Update'])
                </div>
            </div>
        </form>
    </div>
</div>

@endsection