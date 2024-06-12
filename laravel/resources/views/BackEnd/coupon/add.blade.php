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
                            Add coupon
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/coupon/save') }}" method="post" id="CouponForm">
                                @csrf
                                <div class="form-group">
                                    <label for="coupon_value">Coupon Value</label>
                                    <input style="border-radius:12px" type="number" class="form-control"
                                        name="coupon_value">
                                </div>

                                <div class="form-group">
                                    <label for="coupon_number">Number Of Coupon</label>
                                    <input style="border-radius:12px" type="number" class="form-control"
                                        name="coupon_number" value="1">
                                </div>

                                <div class="form-group">
                                    <label for="coupon_type">Coupon Type</label>
                                    <select class="form-control" id="coupon_type" name="coupon_type"
                                        style="border-radius:12px">
                                        <option value="1">Percentage
                                        </option>
                                        <option value="2">Fixed
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="cart_min_value">Cart Min Value</label>
                                    <input style="border-radius:12px" type="number" class="form-control"
                                        name="cart_min_value">
                                </div>

                                <div class="form-group d-flex justify-content-center">
                                    <label for="coupon_status">Coupon Status</label>
                                    <div class="radio" style="margin-left:20px; display:flex">
                                        <div>
                                            <input type="radio" name="coupon_status" value="1" id="active">
                                            <label for="active">Active</label>
                                        </div>
                                        <div style="margin-left:50px">
                                            <input type="radio" name="coupon_status" value="0" id="inactive">
                                            <label for="inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="added_on">Added On</label>
                                    <input style="border-radius:12px" type="date" class="form-control" name="added_on">
                                </div>

                                <div class="form-group">
                                    <label for="expire_on">Expire On</label>
                                    <input style="border-radius:12px" type="date" class="form-control" name="expire_on">
                                </div>

                                <button type="submit" class="btn btn-success">Add</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
