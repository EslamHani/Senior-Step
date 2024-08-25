@extends('layouts.app')

@section('title')
	Todos
@endsection
@section('meta_keywords')
    Todos
@endsection
@section('meta_desc')
    Todos
@endsection

@include('layouts.image-banner', ['CurrentPage' => 'Todos'])

@section('content')
<div class="container" style="margin-top: 50px; color: black; font-family: sans-serif;">
    <div class="row">
        <div class="col-md-6 offset-md-3 border" style="padding: 20px;">
            <p style="font-size: 17px;">{{ $todo->name }}</p>
            <hr>
            <p style="font-size: 17px;">{{ $todo->description }}</p>
            @if($todo->steps)
            <p>Steps</p>
            <ul>
                @foreach($todo->steps as $step)
                <li>{{ $step->name }}</li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>


@endsection
