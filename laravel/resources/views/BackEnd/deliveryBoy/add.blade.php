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
                            Add Delivery Boy
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/delivery-boy/save') }}" method="post" id="deliveryBoyForm">
                                @csrf
                                <div class="form-group">
                                    <label for="delivery_boy_name">Delivery Boy Name</label>
                                    <input style="border-radius:12px" type="text" class="form-control"
                                        name="delivery_boy_name">
                                </div>

                                <div class="form-group">
                                    <label for="delivery_boy_phone_number">Delivery Boy Phone Number</label>
                                    <input style="border-radius:12px" type="number" class="form-control"
                                        name="delivery_boy_phone_number">
                                </div>

                                <div class="form-group">
                                    <label for="delivery_boy_password"> Delivery Boy Password</label>
                                    <input style="border-radius:12px" type="password" class="form-control"
                                        name="delivery_boy_password">
                                </div>

                                <div class="form-group">
                                    <label for="added_on">Added On</label>
                                    <input style="border-radius:12px" type="date" class="form-control" name="added_on">
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
