@extends('layouts.app')

@section('title')
	{{ $user->name }}
@endsection
@push('css')

@endpush

@section('content')

@include('front-end.profile.profile-banner')

<div class="section profile-content">
    <div class="container">
        @include('front-end.profile.user-image')
        <div class="row">
            <div class="col-md-12">
                <h5 class="notification">
                    <i class="fa fa-bell" aria-hidden="true" style="font-size: 16px;"></i> 
                    Notifications
                </h5><br>
            </div>

            <div class="col-md-12">
                <!-- User Notifications -->
                <ul>
                    @forelse($notifications as $notification)
                        {{ $notification->markAsRead() }}

                        @php 
                            $disc = str_replace(' ', '-',  $notification->data['discussion']['title'])  
                        @endphp

                        @if($notification->type === 'App\Notifications\DiscussionReply')
                            <a href="{{ route('discussions.show', $disc) }}" target="_self"> 
                                <li class="list-noty">
                                    <img src="{{ $notification->data['user']['image'] }}"
                                         width="55" 
                                         height="55" 
                                         style="border-radius: 50px;"
                                    >
                                    <span class="disc-notfy">
                                        <strong style="font-weight: bold;">
                                            {{ $notification->data['user']['name'] }}
                                        </strong> 
                                        Wrote a reply on your post
                                    </span>

                                    <p class="date-notfy">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </li>
                            </a>
                        @elseif($notification->type === 'App\Notifications\DiscussionBestReply')
                            <a href="{{ route('discussions.show', $disc) }}" target="_self"> 
                                <li class="list-noty">
                                    <img src="{{ $notification->data['user']['image'] }}"
                                         width="55" 
                                         height="55" 
                                         style="border-radius: 50px;"
                                    >
                                    <span class="disc-notfy">
                                        <strong style="font-weight: bold;">
                                            {{ $notification->data['user']['name'] }}
                                        </strong> 
                                        Choose your reply as the best reply
                                    </span>

                                    <p class="date-notfy">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </li>
                            </a>
                        @elseif($notification->type === 'App\Notifications\DiscussionLike')
                            <a href="{{ route('discussions.show', $disc) }}" target="_self"> 
                                <li class="list-noty">
                                    <img src="{{ $notification->data['user']['image'] }}"
                                         width="55" 
                                         height="55" 
                                         style="border-radius: 50px;"
                                    >
                                    <span class="disc-notfy">
                                        <strong style="font-weight: bold;">
                                            {{ $notification->data['user']['name'] }}
                                        </strong> 
                                        Liked your post
                                    </span>

                                    <p class="date-notfy">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </li>
                            </a>
                        @elseif($notification->type === 'App\Notifications\ReplyLike')
                            <a href="{{ route('discussions.show', $disc) }}" target="_self"> 
                                <li class="list-noty">
                                    <img src="{{ $notification->data['user']['image'] }}"
                                         width="55" 
                                         height="55" 
                                         style="border-radius: 50px;"
                                    >
                                    <span class="disc-notfy">
                                        <strong style="font-weight: bold;">
                                            {{ $notification->data['user']['name'] }}
                                        </strong> 
                                        Liked your Reply
                                    </span>

                                    <p class="date-notfy">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </li>
                            </a>
                        @endif
                    @empty
                        <li>
                            <strong class="msg-notfy">
                                No Notifications Yet...
                            </strong>
                        </li>
                    @endforelse
                </ul>
                <!-- User Notifications -->
            </div>
        </div>
    </div>
</div>
@endsection
