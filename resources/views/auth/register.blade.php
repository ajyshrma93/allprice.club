@extends('layouts.guest')

@section('content')
<div class="login-main">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h4>Create your account</h4>
        <p>Enter your personal details to create account</p>
        <div class="form-group">
            <label class="col-form-label pt-0">Your Name</label>
            <div class="row g-2">
                <div class="col-12">
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full name">
                </div>

            </div>
        </div>
        <div class="form-group">
            <label class="col-form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email address">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="col-form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter your password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="col-form-label">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Enter your confirm password">
        </div>
        <div class="form-group mb-0">
            <div class="checkbox p-0">
                <input id="checkbox1" type="checkbox">
                <label class="text-muted" for="checkbox1">Agree with<a class="ms-2" href="#">Privacy Policy</a></label>
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-block" type="submit">Create Account</button>
            </div>
        </div>
        <h6 class="text-muted text-center mt-4 or">Or signup with</h6>
        <div class="social mt-4">
            <div class="btn-showcase text-center">
                <!-- <a class="btn btn-light" href="https://www.linkedin.com/login" target="_blank"><i class="txt-linkedin" data-feather="linkedin"></i> LinkedIn </a><a class="btn btn-light" href="https://twitter.com/login?lang=en" target="_blank"><i class="txt-twitter" data-feather="twitter"></i>twitter</a><a class="btn btn-light" href="https://www.facebook.com/" target="_blank"><i class="txt-fb" data-feather="facebook"></i>facebook</a> -->
                <a class="btn btn-light" href="{{route('googleLogin')}}" target="_blank">
                    <i class="fa fa-google txt-fb"></i> Google
                </a>
            </div>
        </div>
        <p class="mt-4 mb-0 text-center">Already have an account?<a class="ms-2" href="{{route('login')}}">Sign in</a></p>
    </form>
</div>
@endsection
