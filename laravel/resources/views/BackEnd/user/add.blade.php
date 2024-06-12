@extends('layouts.app-master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content container">
        <div class="row justify-content-center" style="position: relative">
            <!-- Center the row -->
            <div class="col-md-6"
                style="position: absolute; transform: translate(50%, 0); border:solid white 1px; border-radius:12px; padding: 20px; background: white">
                <!-- Allocate six columns for the form -->
                @if (Session::get('sms'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('sms') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header text-center">
                        Add User
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/user/save') }}" method="post" id="deliveryBoyForm">
                            @csrf
                            <div class="form-group form-floating mb-3">
                                <label for="floatingEmail">Email address</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    placeholder="name@example.com" required="required" autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group form-floating mb-3">
                                <label for="floatingName">Username</label>
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                                    placeholder="Username Using To Login" required="required" autofocus>
                                @if ($errors->has('username'))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                                @endif
                            </div>

                            <div class="form-group form-floating mb-3">
                                <label for="floatingName">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    placeholder="Your Name Here" required="required" autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group form-floating mb-3">
                                <label for="floatingName">Phone</label>
                                <input type="number" class="form-control" name="phone" value="{{ old('phone') }}"
                                    placeholder="Your phone number Here" required="required" autofocus>
                                @if ($errors->has('phone'))
                                <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                    <label for="category_id">Select role</label>
                                    <select class="form-control" id="role" name="role">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            <div class="form-group form-floating mb-3">
                                <label for="floatingPassword">Password</label>
                                <input type="password" class="form-control" name="password"
                                    value="{{ old('password') }}" placeholder="Password" required="required">
                                @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-group form-floating mb-3">
                                <label for="floatingConfirmPassword">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}" placeholder="Confirm Password"
                                    required="required">
                                @if ($errors->has('password_confirmation'))
                                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>

                            <button type="submit" name="btn" class="btn btn-success">Add</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection