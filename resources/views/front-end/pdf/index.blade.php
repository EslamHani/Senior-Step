@extends('layouts.app')

@section('title')
	{{ $course->course_name }}
@endsection

@include('layouts.image-banner', ['CurrentPage' => 'References'])

@section('content')
<div class="section">
    <div class="container" style="margin-top: -70px;">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12">
                <h3 class="title" style="font-family: 'Noticia Text', serif;">
                    {{ $course->course_name }} : References
                </h3>
                <hr>
            </div>
        </div>
        
        @guest
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @include('front-end.shared.login-register-redirect', ['disc' => 'To Get References'])
            </div>
        </div>
        @else
            @if($files->count() == 0)
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 50px;">
                        <center>
                            <h5 class="card-text p">No PDF Files Yet...</h5>
                        </center>
                    </div>
                </div>
            @else
                @foreach($files as $file)
                    <div class="row">
                        <div class="col-md-4">
                            <img class="card-img-top fileImage" 
                                 src="{{ url($file->image) }}" 
                                 alt="File image" 
                            >
                        </div><hr>

                        <div class="col-md-8" style="margin-top: 5px;">
                            <h5 class="card-title p">
                                {{ $file->title }}
                            </h5>
                            <p class="card-text p">
                                {{ $file->description }}
                            </p><hr>
                            <p class="card-text p">
                                <strong>
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                    Author : {{ $file->author }}
                                </strong><br>
                                <strong>
                                    <i class="fa fa-download" aria-hidden="true"></i> 
                                    Total download : {{ $file->download }}
                                </strong>
                            </p>
                            <div style="margin-top: 35px;">

                                <a href="{{ route('downloadpdf', ['id' => $file->id]) }}"  
                                   class="btn btn-success btn-sm">
                                    <i class="fa fa-download" aria-hidden="true"></i> Download
                                </a>
                                <a href="{{ route('viewpdf', ['id' => $file->id]) }}" 
                                   class="btn btn-danger btn-sm">
                                    <i class="fa fa-eye" aria-hidden="true"></i> Show
                                </a>
                            </div> 
                        </div>

                    </div><br>
                    @continue($loop->last)
                    <hr>
                @endforeach
            @endif
        @endguest
    </div>
</div>
@endsection

