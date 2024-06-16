@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('login.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <img class="mb-4" src="https://t3.ftcdn.net/jpg/06/76/45/32/240_F_676453298_oawytYg5O4uT2TDkORl8t5rbGuuwGqf9.jpg"
            alt="" width="72" height="72">

        <h1 class="h3 mb-3 fw-normal">Login</h1>

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
            <label for="floatingName">Email or Username</label>
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username"
                required="required" autofocus>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <label for="floatingPassword">Password</label>
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password"
                required="required">
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

        @include('auth.partials.copy')
    </form>
    <div class="text-center my-4">
        <hr class="my-2">
        <span class="text-canter font-bold">Or</span>
        <div class="text-w-3/5 mx-auto mt-4">
            <a href="{{ route('google-auth') }}">
                <span>
                    Continue with Google
                </span>
            </a>
        </div>
    </div>
    <div>
        <a href="{{ route('register.show') }}">Create an account</a>
    </div>
@endsection
