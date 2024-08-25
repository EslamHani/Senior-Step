@extends('layouts.app')

@section('title')
	{{ $user->name }}
@endsection

@section('content')

@include('front-end.profile.profile-banner')

<div class="section profile-content">
    <div class="container-fluid">
        @include('front-end.profile.user-image')
        <div class="row">
            <!-- User Info && profile setting -->
            <div class="col-lg-3 col-md-12 col-sm-12">
                @auth
                    @component('front-end.components.follow-button',['user' => $user])
                    @endcomponent
                @endauth
                @include('front-end.shared.user-info')
                @include('front-end.shared.user-settings')
            </div>
            <!-- User Info && profile setting -->

            <!-- User Discussions -->
            <div class="col-lg-6 col-md-12 col-sm-12">
              @include('front-end.shared.discussions')
            </div>
            <!-- User Discussions -->
            <!-- Followers -->
            <div class="col-lg-3 col-md-12 col-sm-12">
                @include('front-end.shared.friends')
            </div>
            <!-- Followers -->
        </div>
    </div>
</div>
@endsection




