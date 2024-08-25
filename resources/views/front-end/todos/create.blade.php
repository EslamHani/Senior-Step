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
            <p style="font-size: 17px;">Add something to list</p>
            <hr>
            <form method="POST" action="{{ route('todos.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" autocomplete="off">
                    @error('name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description"  id="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                @livewire('step-counter')
                <button type="submit" class="btn btn-danger">Submit</button>
                <a href="{{ route('todos.index') }}" class="btn btn-default">
                    Back
                </a>
            </form>
        </div>
    </div>
</div>


@endsection
