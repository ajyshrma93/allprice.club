@extends('layouts.guest')

@section('content')
<div class="login-main">
    <form method="POST" class="theme-form" action="{{ route('login') }}">
        @csrf
        <h4>Sign in to account</h4>
        <p>Enter your email & password to login</p>
        <div class="form-group">
            <label class="col-form-label">Email Address</label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Test@gmail.com" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="col-form-label">Password</label>
            <input class="form-control  @error('password') is-invalid @enderror" type="password" name="password" placeholder="*********" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group mb-0">
            <div class="checkbox p-0">
                <input id="checkbox1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="text-muted" for="checkbox1">Remember password</label>
            </div><a class="link" href="{{ route('password.request') }}">Forgot password?</a>
            <div class="text-center">
                <button class="btn btn-primary btn-block" type="submit">Sign in</button>
            </div>
        </div>
        <h6 class="text-muted text-center mt-4">Or Sign in with</h6>
        <div class="social mt-4">
            <div class="btn-showcase text-center">
                <a class="btn btn-light" href="{{route('loginById',8)}}">
                    Login as Admin
                </a>
                @foreach (\App\Models\User::limit(5)->get() as $user)
                <a class="btn btn-light" href="{{route('loginById',$user->id)}}">
                    Login as {{$user->name}}
                </a>
                @endforeach
                <a class="btn btn-light" href="{{route('googleLogin')}}">
                    <i class="fa fa-google txt-fb"></i> Google
                </a>
            </div>
        </div>
        <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="{{route('register')}}">Create Account</a></p>
    </form>
</div>
@endsection
