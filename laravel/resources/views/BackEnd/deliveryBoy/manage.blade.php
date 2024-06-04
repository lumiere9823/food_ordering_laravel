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
                            <h3>Datatable for deliveryBoy</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Order Number</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Added On</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Updated At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deliveryBoies as $index => $deliveryBoy)
                                        <tr style="text-align:center">
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $deliveryBoy->delivery_boy_id }}</td>
                                            <td>{{ $deliveryBoy->delivery_boy_name }}</td>
                                            <td>{{ $deliveryBoy->delivery_boy_phone_number }}</td>
                                            <td id="deliveryBoyStatus_{{ $deliveryBoy->delivery_boy_id }}">
                                                {{ $deliveryBoy->delivery_boy_status == 1 ? 'active' : 'inactive' }}</td>
                                            <td>{{ $deliveryBoy->added_on }}</td>
                                            <td>{{ $deliveryBoy->created_at }}</td>
                                            <td>{{ $deliveryBoy->updated_at }}</td>
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
                                                                data-target="#updatedeliveryBoyModal{{ $deliveryBoy->delivery_boy_id }}">
                                                                Edit
                                                            </button>
                                                        </div>
                                                        <div style="text-align: center; margin-top: 10px;">
                                                            <input type="hidden" id="deliveryBoyIdToDelete"
                                                                name="deliveryBoy_id" value="">
                                                            <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                                data-toggle="modal"
                                                                data-target="#confirmDeliveryBoyDeleteModal"
                                                                data-deliveryBoy-id="{{ $deliveryBoy->delivery_boy_id }}">Delete</button>
                                                        </div>
                                                        <div style="text-align: center; margin-top: 10px;">
                                                            <div style="text-align: center; margin-top: 10px;">
                                                                <label class="switch">
                                                                    <input type="checkbox" class="status-toggle-deli"
                                                                        data-id="{{ $deliveryBoy->delivery_boy_id }}"
                                                                        {{ $deliveryBoy->delivery_boy_status == 1 ? 'checked' : '' }}>
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade"
                                            id="updatedeliveryBoyModal{{ $deliveryBoy->delivery_boy_id }}" tabindex="-1"
                                            role="dialog"
                                            aria-labelledby="updatedeliveryBoyModalLabel{{ $deliveryBoy->delivery_boy_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="updatedeliveryBoyModalLabel{{ $deliveryBoy->delivery_boy_id }}">
                                                            Update deliveryBoy</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('delivery_boy.update', $deliveryBoy->delivery_boy_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="deliveryBoyName">Delivery Boy Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="delivery_boy_name" name="delivery_boy_name"
                                                                    value="{{ $deliveryBoy->delivery_boy_name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="delivery_boy_phone_number">Phone Number</label>
                                                                <input type="text" class="form-control"
                                                                    id="delivery_boy_phone_number"
                                                                    name="delivery_boy_phone_number"
                                                                    value="{{ $deliveryBoy->delivery_boy_phone_number }}">
                                                            </div>
                                                            <!-- Add other fields as needed -->

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
