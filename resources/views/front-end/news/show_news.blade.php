@extends('layouts.app')

@section('title')
	News 
@endsection
@section('meta_keywords'){{ $topic->meta_keywords }}@endsection
@section('meta_desc'){{ $topic->meta_desc }}@endsection

@include('layouts.image-banner', ['CurrentPage' => 'News'])

@section('content')
@php $date = date('l jS F Y', strtotime($topic->created_at)) @endphp
<div class="section">
<div class="container" style="margin-top: -60px;">
    <div class="row">
        <div class="col-md-12">
             <h3 style="font-family: 'Noto Serif', serif; color: black;">{{ $topic->title }}</h3>
             <small><i class="fa fa-pencil" aria-hidden="true"></i> {{$topic->author }}  &nbsp;/&nbsp;</small>
            <small><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $date }}</small>
        </div>
        <div class="col-md-12" style="margin-top: 10px;">
            <img src="{{ url($topic->image) }}" alt="" class="d-block w-100" style="max-height: 450px;">
        </div>
        <div class="col-md-12" style="margin-top: 20px;">
            {!! $topic->content !!}
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        @foreach($topics as $new)
            @if($loop->first)
                <div class="col-md-12" style="margin-bottom: 20px;">
                    <h4 class="relatedNews">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp; Related News
                    </h4><hr>
                </div>
            @endif
            <div class="col-md-6">
            @include('front-end.news.news-card')
            </div>
        @endforeach
    </div>
</div>
</div>
@endsection
