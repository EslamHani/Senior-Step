@extends('layouts.app')

@section('title')
Discussions
@endsection
@section('meta_keywords')
All Discussions
@endsection
@section('meta_desc')
All Discussions
@endsection


@include('layouts.image-banner', ['CurrentPage' => 'Discussions'])

@section('content')
<div class="section">
    <div class="container">

        <div class="row">
            <!-- Discussion Filter -->

            <div class="col-lg-3 col-md-12 col-sm-12" style="margin-bottom: 10px;">
                @auth
                    @component('front-end.components.explorer-button')  
                    @endcomponent
                @endauth

                @include('front-end.discussions.filter')
            </div>
            <!-- Discussion Filter -->

            <!-- show Discussions & show discusssion replies -->
            <div class="col-lg-9 col-md-12 col-sm-12">
            @include('front-end.shared.discussions')
            </div>
            <!-- User Discussions -->

        </div>
    </div>
</div> 
@endsection
