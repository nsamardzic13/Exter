@extends('layouts.app')

@section('content')
    @if(session()->has('login-error'))
        <div class="alert login-alert alert-danger" role="alert" style="border-width: 1px; border-color: #E32743">
            <strong>Failed login </strong> {{  session()->get('login-error') }}
        </div>
    @endif

    <div class="reg-form">
        <div class="signup-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h2>Login</h2>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg sign-button mb-1">Sign in</button>

                    <div style="text-align: center">Or</div>
                        <a href="{{ url('/auth/redirect/google') }}" class="btn btn-primary btn-block btn-lg sign-button mt-1" style><i class="fab fa-google"></i>
                            &nbsp&nbsp&nbsp Sign in with <b>Google</b></a>
                </div>
            </form>
        </div>
    </div>
@endsection
