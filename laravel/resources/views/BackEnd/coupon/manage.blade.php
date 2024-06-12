@extends('layouts.app-master')

@section('content')
    <div class="content-wrapper">
        <section class="content container">
            <div class="row justify-content-center" style="position: relative">
                <!-- Center the row -->
                <div style=" border:solid white 1px; border-radius:12px; padding: 20px; background: white">
                    <!-- Allocate six columns for the form -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Datatable for Coupon</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Coupon Code</th>
                                        <th scope="col">Coupon Type</th>
                                        <th scope="col">coupon Value</th>
                                        <th scope="col">Cart Min Value</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Number Coupon Left</th>
                                        <th scope="col">Expire On</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $index => $coupon)
                                        <tr style="text-align:center">
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $coupon->coupon_code }}</td>
                                            <td>{{ $coupon->coupon_type == 1 ? 'Percentage' : 'Fixed' }}</td>
                                            <td>{{ $coupon->coupon_value }}</td>
                                            <td>{{ $coupon->cart_min_value }}</td>
                                            <td id="CouponStatus_{{ $coupon->coupon_id }}">
                                                {{ $coupon->coupon_status == 1 ? 'active' : 'inactive' }}</td>
                                            <td>{{ $coupon->coupon_number }}</td>
                                            <td>{{ $coupon->expire_on }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                        style="min-width:100px; padding:8px">
                                                        <div style="text-align: center;">
                                                            <button type="button" class="btn btn-warning"
                                                                style="width: 80%;" data-toggle="modal"
                                                                data-target="#updateCouponModal{{ $coupon->coupon_id }}">
                                                                Edit
                                                            </button>
                                                        </div>
                                                        <div style="text-align: center; margin-top: 10px;">
                                                            <form method="POST"
                                                                action="{{ route('coupon.delete', $coupon->coupon_id) }}">
                                                                @csrf
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <button id="deleteCategoryBtn_{{ $coupon->coupon_id }}"
                                                                    class="btn btn-danger show_confirm" style="width: 80%;"
                                                                    data-toggle="tooltip" title='Delete'>Delete</button>
                                                            </form>
                                                        </div>
                                                        <div style="text-align: center; margin-top: 10px;">
                                                            <div style="text-align: center; margin-top: 10px;">
                                                                <label class="switch">
                                                                    <input type="checkbox" class="status-toggle-coupon"
                                                                        data-id="{{ $coupon->coupon_id }}"
                                                                        data-url="/coupon/change-status/"
                                                                        data-code="CouponStatus_"
                                                                        {{ $coupon->coupon_status == 1 ? 'checked' : '' }}>
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="updateCouponModal{{ $coupon->coupon_id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="updateCouponModalLabel{{ $coupon->coupon_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="updateCouponModalLabel{{ $coupon->coupon_id }}">
                                                            Update Coupon</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="update-coupon-form"
                                                            action="{{ route('coupon.update', $coupon->coupon_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="coupon_code_{{ $coupon->coupon_id }}">Coupon
                                                                    Code</label>
                                                                <input type="text" class="form-control"
                                                                    id="coupon_code_{{ $coupon->coupon_id }}"
                                                                    name="coupon_code" value="{{ $coupon->coupon_code }}"
                                                                    disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="coupon_type_{{ $coupon->coupon_id }}">Coupon
                                                                    Type</label>
                                                                <div class="radio" style="margin-left:20px; display:flex">
                                                                    <div>
                                                                        <input type="radio" name="coupon_type"
                                                                            value="1" id="percentage"
                                                                            {{ $coupon->coupon_type == 1 ? 'checked' : '' }}>
                                                                        <label for="percentage">Percentage</label>
                                                                    </div>
                                                                    <div style="margin-left:50px">
                                                                        <input type="radio" name="coupon_type"
                                                                            value="2" id="fixed"
                                                                            {{ $coupon->coupon_type == 2 ? 'checked' : '' }}>
                                                                        <label for="fixed">Fixed</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="coupon_value_{{ $coupon->coupon_id }}">Coupon
                                                                    Value</label>
                                                                <input type="number" class="form-control"
                                                                    id="coupon_value_{{ $coupon->coupon_id }}"
                                                                    name="coupon_value"
                                                                    value="{{ $coupon->coupon_value }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="coupon_number_{{ $coupon->coupon_id }}">Coupon
                                                                    Left</label>
                                                                <input type="number" class="form-control"
                                                                    id="coupon_number_{{ $coupon->coupon_id }}"
                                                                    name="coupon_number"
                                                                    value="{{ $coupon->coupon_number }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cart_min_value_{{ $coupon->coupon_id }}">Cart
                                                                    Minimum Value</label>
                                                                <input type="number" class="form-control"
                                                                    id="cart_min_value_{{ $coupon->coupon_id }}"
                                                                    name="cart_min_value"
                                                                    value="{{ $coupon->cart_min_value }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="coupon_status_{{ $coupon->coupon_id }}">Coupon
                                                                    Status</label>
                                                                <div class="radio"
                                                                    style="margin-left:20px; display:flex">
                                                                    <div>
                                                                        <input type="radio" name="coupon_status"
                                                                            value="1" id="active"
                                                                            {{ $coupon->coupon_status == 1 ? 'checked' : '' }}>
                                                                        <label for="active">Active</label>
                                                                    </div>
                                                                    <div style="margin-left:50px">
                                                                        <input type="radio" name="coupon_status"
                                                                            value="0" id="inactive"
                                                                            {{ $coupon->coupon_status == 0 ? 'checked' : '' }}>
                                                                        <label for="inactive">Inactive</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="expire_on_{{ $coupon->coupon_id }}">Expire
                                                                    On</label>
                                                                <input type="datetime-local" class="form-control"
                                                                    id="expire_on_{{ $coupon->coupon_id }}"
                                                                    name="expire_on" value="{{ $coupon->expire_on }}">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="confirmDeliveryBoyDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeliveryBoyDeleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <p>Are you sure you want to delete this deliveryBoy?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
