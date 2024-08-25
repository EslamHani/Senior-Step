<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Verification email</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="title">Study</h1>
			</div>
			<div class="col-md-12">
				<h3>Hello {{ $user['name'] }}</h3>
				<p>Please klik link below for verification your email <span style="color: lightblue">{{ $user['email'] }}</span></p>
				<a href="{{ route('email.verification', $user->verification->token) }}" class="btn btn-primary">Verify Email</a>
			</div>
		</div>
	</div>
</body>
</html>