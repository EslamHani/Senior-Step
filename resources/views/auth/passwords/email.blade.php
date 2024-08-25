@extends('layouts.app')
@section('title')
Email
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
                    <form method="POST" action="{{ route('password.email') }}" class="register-form">
                        @csrf
                        <label>{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                        <button type="submit" class="btn btn-danger btn-block btn-round">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


