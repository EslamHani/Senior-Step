@extends('layouts.app')

@section('title')
	{{ $user->name }}
@endsection
@push('css')
<style type="text/css">
    body{
        font-family: sans-serif;
        color: black;
    }
</style>
<script src="https://cdn.tiny.cloud/1/s75hit7ybx0ssacci8e1p28qmpspejkhrjf6md7ukc0tinpp/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#body',
        height: 400,
        menubar: false,
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
        content_style: 'body { font-family:sans-serif; font-size:17px }',
    });
</script>
@endpush

@section('content')

@include('front-end.profile.profile-banner')

<div class="section profile-content">
  <div class="container">
        @include('front-end.profile.user-image')
        <div class="row">
            <!-- User Info && profile setting -->
            <div class="col-md-3">
                @include('front-end.shared.user-info')
                @include('front-end.shared.user-settings')
            </div>
            <!-- User Info && profile setting -->

            <!-- User edit Discussions -->
            <div class="col-md-9">
                <h3 style="font-weight: bold; font-family: sans-serif; margin-bottom: 10px;">Edit Discussion</h3>
                <form method="POST" action="{{ route('discussions.update', $discussion) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @include('front-end.shared.discussion-form')
                    @include('front-end.shared.discussion-buttons', ['button' => 'Update'])
                </form>
            </div>
            <!-- User edit Discussions -->

        </div>
    </div>
</div>
@endsection




