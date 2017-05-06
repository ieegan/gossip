@extends('layouts.app')

@section('content')
<div class="box">
    <h1 class="subtitle">Login</h1>
    <form class="form-horizontal is-clearfix" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="field">
            <p class="control">
            <label class="label">Email</label>

                <input id="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                <span class="help is-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </p>
        </div>

        <div class="field">
            <p class="control">
            <label class="label">Password</label>

                <input id="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required>

                @if ($errors->has('password'))
                <span class="help is-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </p>
        </div>

        <div class="field">
            <p class="control">
                <label class="checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                </label>
            </p>
        </div>

        <div class="field">
            <p class="control">
                <button type="submit" class="button is-primary">Login</button>
                <a class="button is-light" href="redirect/facebook">Login with Facebook</a>
                <a class="button is-light" href="redirect/twitter">Login with Twitter</a>
                <a class="button is-pulled-right" href="{{ route('password.request') }}">Forgot Your Password?</a>
            </p>
        </div>

    </form>
</div>
@endsection
