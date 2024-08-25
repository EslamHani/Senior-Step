@extends('layouts.app')
@section('title')
Login
@endsection

@section('content')
@php $non_footer = "" @endphp
<div class="page-header" style="background-image: url({{ asset('/background-image/a.jpg')  }});">
    <div class="filter"></div>
    <div class="container">
        <div class="row" style="margin-top: 100px;">
            <div class="col-lg-4 ml-auto mr-auto" >
                @if(session('success'))
                <div class="alert alert-success">
                    <p style="color: black; font-family: cursive;">
                    {{ session('success') }}
                    </p>
                </div>
                @endif
                @if(session('warning'))
                <div class="alert alert-danger">
                    <p style="color: black; font-family: cursive;">
                    {{ session('warning') }}
                    </p>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">
                    <p style="color: black; font-family: cursive;">
                    {{ session('error') }}
                    </p>
                </div>
                @endif
                <div class="card card-register" style="background-color: #000000C2">
                    <div class="social-line text-center">
                          <a href="{{ route('falogin') }}" class="btn btn-neutral btn-facebook btn-just-icon">
                            <i class="fa fa-facebook-square"></i>
                          </a>
                          <a href="{{ route('gologin') }}" class="btn btn-neutral btn-google btn-just-icon">
                            <i class="fa fa-google-plus"></i>
                          </a>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="register-form">
                        @csrf
                        <label>Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label>Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input  type="checkbox" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                        <label  for="remember">
                            {{ __('Remember Me') }}
                        </label>
                                                  
                        <button type="submit" class="btn btn-danger btn-block btn-round">
                            {{ __('Login') }}
                        </button>
                    </form>
                    <div class="forgot">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}" style="color: white;">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
