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
                            Role
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/role/save') }}" method="post" id="roleForm">
                                @csrf
                                <div class="form-group">
                                    <label for="role_name">Role Name</label>
                                    <input style="border-radius:12px" type="text" class="form-control"
                                        name="name">
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
