@extends('layouts.app')

@section('title')
Register
@endsection

@section('content')
@php $non_footer = "" @endphp
<div class="page-header" style="background-image: url({{ asset('/background-image/a.jpg')  }});">
    <div class="filter"></div>
    <div class="container">
        <div class="row" style="margin-top: 96px;">
            <div class="col-lg-4 ml-auto mr-auto">
                <div class="card card-register"  style="background-color: #000000C2">
                    <div class="social-line text-center">
                          <a href="{{ route('falogin') }}" class="btn btn-neutral btn-facebook btn-just-icon">
                            <i class="fa fa-facebook-square"></i>
                          </a>
                          <a href="{{ route('gologin') }}" class="btn btn-neutral btn-google btn-just-icon">
                            <i class="fa fa-google-plus"></i>
                          </a>
                    </div>
                    <form method="POST" action="{{ route('register') }}" class="register-form">
                        @csrf
                        <label>Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label>Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label>Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                        <label>Confirm Password</label>  
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">                 
                        <button type="submit" class="btn btn-danger btn-block btn-round">
                            {{ __('Register') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
