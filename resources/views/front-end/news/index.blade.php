@extends('layouts.app')

@section('title')
	News
@endsection

@include('layouts.image-banner', ['CurrentPage' => 'News'])


@section('content')
<div class="section">
    <div class="container" style="margin-top: -60px;">
        @component('front-end.components.section-header', [
            'header' => 'Our News',
            'description' => 'Get The latest News Around The World About Education',
        ])
        @endcomponent
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                @foreach($news as $new)
                    @include('front-end.news.news-card')
                @endforeach 
            </div>

            @include('front-end.shared.popular-categories-tags')  
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $news->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
