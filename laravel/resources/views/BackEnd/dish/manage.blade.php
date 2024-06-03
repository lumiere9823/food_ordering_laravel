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
                            <h3>Datatable for dish</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Detail</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Updated at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dishes as $index => $dish)
                                        <tr style="text-align:center">
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $dish->dish_id }}</td>
                                            <td>{{ $dish->dish_name }}</td>
                                            <td>{{ $dish->dish_detail }}</td>
                                            <td id="dishStatus_{{ $dish->dish_status }}">
                                                {{ $dish->dish_status == 1 ? 'active' : 'inactive' }}</td>
                                            <td><img src="{{ asset('dish_images/' . $dish->dish_image) }}" alt="Dish Image"
                                                    style="max-width: 200px">
                                            </td>
                                            <td>{{ $dish->created_at }}</td>
                                            <td>{{ $dish->updated_at }}</td>
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
                                                                data-target="#updatedishModal{{ $dish->dish_id }}">
                                                                Edit
                                                            </button>
                                                        </div>
                                                        <div style="text-align: center; margin-top: 10px;">
                                                            <input type="hidden" id="dishToDelete" name="dish_id"
                                                                value="">
                                                            <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                                data-toggle="modal" data-target="#confirmdishDeleteModal"
                                                                data-dish-id="{{ $dish->dish_id }}">Delete</button>
                                                        </div>
                                                        <div style="text-align: center; margin-top: 10px;">
                                                            <div style="text-align: center; margin-top: 10px;">
                                                                <label class="switch">
                                                                    <input type="checkbox" class="status-toggle-dish"
                                                                        data-id="{{ $dish->dish_id }}"
                                                                        {{ $dish->dish_status == 1 ? 'checked' : '' }}>
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="updatedishModal{{ $dish->dish_id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="updatedishModalLabel{{ $dish->dish_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="updatedishModalLabel{{ $dish->dish_id }}">Update dish
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('update_dish', $dish->dish_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="dishName">Dish Name</label>
                                                                <input type="text" class="form-control" id="dishName"
                                                                    name="dish_name" value="{{ $dish->dish_name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="dishDetail">Dish Detail</label>
                                                                <textarea class="form-control" id="dishDetail" name="dish_detail" rows="3">{{ $dish->dish_detail }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="dish_image">Dish Image</label>
                                                                <input type="file" class="form-control-file"
                                                                    id="dish_image" name="dish_image">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="dishStatus">Dish Status</label>
                                                                <select class="form-control" id="dishStatus"
                                                                    name="dish_status">
                                                                    <option value="1"
                                                                        {{ $dish->dish_status == 1 ? 'selected' : '' }}>
                                                                        Active</option>
                                                                    <option value="0"
                                                                        {{ $dish->dish_status == 0 ? 'selected' : '' }}>
                                                                        Inactive</option>
                                                                </select>
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
    <div class="modal fade" id="confirmdishDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmdishDeleteModal" aria-hidden="true">
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
                    <p>Are you sure you want to delete this dish?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
