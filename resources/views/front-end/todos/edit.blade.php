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
            <form method="POST" action="{{ route('todos.update', $todo->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ isset($todo->name) ? $todo->name : old('name') }}" id="name" autocomplete="off">
                    @error('name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description"  id="description" rows="3">{{ isset($todo->description) ? $todo->description : old('description') }}</textarea>
                    @error('description')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                @livewire('edit-steps', ['steps' => $todo->steps])
                <button type="submit" class="btn btn-danger">Update</button>
                <a href="{{ route('todos.index') }}" class="btn btn-default">
                    Back
                </a>
            </form>
        </div>
    </div>
</div>


@endsection
