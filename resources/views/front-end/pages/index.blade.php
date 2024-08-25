@extends('layouts.app')

@section('title')
	{{ $page->page_name }}
@endsection
@section('meta_keywords'){{ $page->meta_keywords }}@endsection
@section('meta_desc'){{ $page->meta_desc }}@endsection


@include('layouts.image-banner', ['CurrentPage' =>  $page->page_name])


@section('content')
<div class="container" style="margin-top: 70px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-nav-tabs">
                <div class="card-header card-header-warning">
                   <h5 class="card-title card-title1"> {{ $page->page_name }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text card-text1">{{ $page->page_desc }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
