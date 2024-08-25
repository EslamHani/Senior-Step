@extends('layouts.app')
@section('title')
Reset
@endsection

@section('content')
@php $non_footer = "" @endphp
<div class="page-header" style="background-image: url({{ asset('/background-image/a.jpg')  }});">
    <div class="filter"></div>
    <div class="container">
        <div class="row" style="margin-top: 100px;">
            <div class="col-lg-4 ml-auto mr-auto" >
                <div class="card card-register" style="background-color: #000000C2">
                    <div class="social-line text-center">
                          <h3>{{ __('Reset Password') }}</h3>
                    </div>
                    <form method="POST" action="{{ route('password.update') }}" class="register-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <label>{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label>{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label>{{ __('Confirm Password') }}</label>  
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">                  
                        <button type="submit" class="btn btn-danger btn-block btn-round">
                            {{ __('Reset Password') }}
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


