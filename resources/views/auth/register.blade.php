@extends('layouts.auth')

@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Register</h1>
    </div>
    <form class="user" method="POST" action="{{ route('register') }}">
        @csrf

        <div class=" form-group">
            <input id="name" type="text" class="form-control form-control-user @error('email') is-invalid @enderror"
                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class=" form-group">
            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password" type="password"
                class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required
                autocomplete="current-password" placeholder="Password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation"
                required autocomplete="new-password" placeholder="Confirm Password">
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            Register
        </button>

    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('login') }}">Have an Account?</a>
    </div>
@endsection
