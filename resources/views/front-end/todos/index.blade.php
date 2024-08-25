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
<div class="container" style="margin-top: 50px; color: black;">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <ul class="list-group">
                <li class="list-group-item" aria-disabled="true" style="background: lightblue;">
                    What do you need to do
                    <a href="{{ route('todos.create') }}" title="Add New" style="float: right; color: black; cursor: pointer;">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </li>
                @forelse($todos as $todo)
                    <li class="list-group-item">
                        @if($todo->completed)
                        <i class="fa fa-check" aria-hidden="true" style="color: green; cursor: pointer;"
                        onclick="event.preventDefault();document.getElementById('form-complete-{{$todo->id}}').submit()"></i>
                        <a href="{{ route('todos.show', $todo->id) }}" style="color: black">
                        <span style="text-decoration: line-through">{{ $todo->name }}</span>
                        </a>
                        @else
                        <i class="fa fa-check" aria-hidden="true" style="color: gray; cursor: pointer;"  onclick="event.preventDefault();document.getElementById('form-complete-{{$todo->id}}').submit()"></i>
                        <a href="{{ route('todos.show', $todo->id) }}"  style="color: black">
                        <span >{{ $todo->name }}</span>
                        </a>
                        @endif      
                        <span style="color: red; float: right; cursor: pointer;" onclick="event.preventDefault();document.getElementById('form-delete-{{ $todo->id }}').submit()" title="Delete">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </span>
                        <a href="{{ route('todos.edit', $todo->id) }}" title="Edit" style="float: right; color: black; margin: 0px 5px; cursor: pointer;">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>

                        <form method="POST" id="form-delete-{{ $todo->id }}" action="{{ route('todos.destroy', $todo->id) }}" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                        <form method="post" id="form-complete-{{$todo->id}}" action="{{ route('todos.completed', $todo->id) }}" style="display: none;">
                            @csrf
                            @method('PATCH')
                        </form>
                        
                    </li>
                @empty
                    <li class="list-group-item">
                        <span>No Todo list...</span>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>


@endsection
