@extends('layouts.app')

@section('title')
Discussion
@endsection
@section('meta_keywords'){{ $discussion->category->category_name }}@endsection
@section('meta_desc'){{ $discussion->title }}@endsection

@push('css')
<script src="https://cdn.tiny.cloud/1/s75hit7ybx0ssacci8e1p28qmpspejkhrjf6md7ukc0tinpp/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#discussion_reply',
        height: 300,
        menubar: false,
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
        content_style: 'body { font-family:sans-serif; font-size:17px }',
    });
</script>
@endpush

@include('layouts.image-banner', ['CurrentPage' => 'Discussions'])

@section('content')
<div class="section">
    <div class="container">
        
        <div class="row">
            <!-- Discussion Filter && Follow button -->
            <div class="col-lg-3 col-md-4 col-sm-12" style="margin-bottom: 10px;">
                @auth
                    @component('front-end.components.follow-button', ['user' => $discussion->user])  
                    @endcomponent
                @endauth
                @include('front-end.discussions.filter')
            </div>
            <!-- Discussion Filter -->

            <!-- show Discussions & show discusssion replies -->
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="showdisc"> 
                    <div class="reply">
                        <div class="showImg">
                            <a href="{{ route('userprofile', $discussion->user) }}">
                                <img src="{{ url($discussion->user->image) }}"  
                                     width="50" 
                                     height="50" 
                                     alt="User Image" 
                                     style="border-radius: 50px;"
                                >
                            </a>

                            <span class="showLevel">
                                Level {{ $discussion->user->level }}
                            </span><br>
                        </div>
                        
                        <a href="{{ route('userprofile', $discussion->user) }}">                       
                            <strong class="showName">
                               {{ $discussion->user->name }}
                            </strong>
                        </a>
                        
                        <strong class="showDot">
                          .
                        </strong>

                        <span class="showDate">
                          {{ $discussion->created_at->diffForHumans() }}
                        </span>

                        <a href="{{ route('discussions.index', ['cat' => $discussion->category->category_name]) }}" class="btn btn-outline-danger btn-round btn-sm showCat">
                            {{ $discussion->category->category_name }}
                        </a>

                        <span class="showView">
                            <i class="fa fa-eye" aria-hidden="true"></i> {{ $discussion->views }}
                        </span>

                        <span class="showReplyCount">
                            <i class="fa fa-comments" aria-hidden="true"></i> {{ $discussion->discussionreplies->count() }}
                        </span>

                        <div class="alert alert-primary showTitle">
                            <p class="titledisc">
                                {{ $discussion->title }}
                            </p>
                        </div>

                        <div class="showBody">
                            <p class="bodydisc">
                                {!! $discussion->body !!}
                            </p>
                        </div>

                        @if(!is_null($discussion->image))
                            <div class="showImgDisc">
                                <img src="{{ url($discussion->image) }}" class="imgBody">
                            </div>
                        @endif

                        <!-- Like Discussion -->
                        @component('front-end.components.like-discussion-reply', [
                            'model'     => $discussion,
                            'routeName' => 'discussions'
                        ])@endcomponent
                        <!-- Like Discussion -->

                    </div>

                    @foreach($discussion->discussionreplies as $reply)
                        <div class="{{ $discussion->best_reply_id == $reply->id ? 'best-reply' : 'reply' }}">
                            <div class="showImg">
                                <a href="{{ route('userprofile', $reply->user) }}">
                                    <img src="{{ url($reply->user->image) }}"  
                                         width="50" 
                                         height="50" 
                                         alt="User Image" 
                                         style="border-radius: 50px;"
                                    >
                                    </a>
                                <span class="showLevel">
                                    Level {{ $reply->user->level }}
                                </span>
                            </div>
                           
                            <strong class="showName">
                               {{ $reply->user->name }}
                            </strong>
                            
                            <strong class="showDot">
                              .
                            </strong>

                            <span class="showDate">
                              {{ $reply->created_at->diffForHumans() }}
                            </span>

                            <!-- Best Reply -->
                            @component('front-end.components.best-reply-button', [
                                'discussion' => $discussion,
                                'reply'      => $reply,
                            ])
                            @endcomponent
                            <!-- Best Reply -->

                            <div class="discReply2">
                                <p class="showdiscReply">
                                    {!! $reply->discussion_reply !!}
                                </p>
                            </div>

                            @if(!is_null($reply->image))
                                <div class="showImgDisc">
                                    <img src="{{ url($reply->image) }}" class="imgBody">
                                </div>
                            @endif
                            
                            <div style="margin-left: 60px; margin-top: 5px;"> 
                                @can('reply-permissions', $reply->user)
                                    @include('front-end.shared.Delete-Edit-discussion', [
                                        'routeName' => 'reply',
                                        'parameter' => $reply->id,
                                    ])
                                @endcan
                            </div>

                            <!-- Like Reply -->
                            @component('front-end.components.like-discussion-reply', [
                                'model'     => $reply,
                                'routeName' => 'replies',
                            ])@endcomponent
                            <!-- Like Reply -->

                        </div>
                    @endforeach
                </div>
                @auth
                <div class="createReply">
                        <form method="POST" action="{{ route('reply.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('front-end.shared.reply-form')
                            <button type="submit" class="btn btn-primary btn-round" style="float: right;">
                                Publish Reply <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            </button>
                        </form>
                </div>
                @else
                @include('front-end.shared.login-register-redirect', ['disc' => 'To Add Reply'])
                @endauth
            </div>
            <!-- User Discussions -->
        </div>
    </div>
</div> 
@endsection
