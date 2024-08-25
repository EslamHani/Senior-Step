@extends('layouts.app')

@section('title')
Explorer
@endsection
@section('meta_keywords')
Explorer
@endsection
@section('meta_desc')
Explorer
@endsection


@include('layouts.image-banner', ['CurrentPage' => 'Explorer'])

@section('content')
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p style="font-weight: bold; font-size: 17px;">
                    <i class="fa fa-users" aria-hidden="true"></i> Explorer People
                </p>
            </div>
        </div>
        <div class="disc1">
            <div class="row">
                @foreach($users as $user)
                    @unless(auth()->user()->following($user))
                        <div class="col-md-6" style="margin-bottom: 40px;">
                            <div class="discImg">
                                <div class="showImg">
                                    <a href="{{ $user->path() }}">
                                        <img  src="{{ $user->image }}"  
                                              width="70"
                                              height="70" 
                                              alt="User Image" >
                                    </a>

                                    <span class="showLevel" style="top: 75px; left: 11px;">
                                        Level {{ $user->level }}
                                    </span>
                                </div>
                            </div>
                                
                            <a href="{{ $user->path() }}">
                                <strong class="showName">
                                   {{ $user->name }}
                                </strong>
                            </a>

                            <strong class="discDot">
                              .
                            </strong>
                            @if($user->permission  == 1)
                                <span class="cm-5">( Admin )</span>

                                <strong class="discDot">
                                  .
                                </strong>
                            @endif

                            <span class="discDate">
                              Joined {{ $user->created_at->diffForHumans() }} 
                            </span>   
                        </div>
                    @endunless            
                @endforeach
            </div>
        </div>
    </div>
</div> 
@endsection