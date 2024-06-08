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
                            <h3>Datatable for category</h3>
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
                                    @foreach ($categories as $index => $category)
                                        <tr style="text-align:center">
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $category->category_id }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->order_number }}</td>
                                            <td id="categoryStatus_{{ $category->category_id }}">
                                                {{ $category->category_status == 1 ? 'active' : 'inactive' }}</td>
                                            <td>{{ $category->added_on }}</td>
                                            <td>{{ $category->created_at }}</td>
                                            <td>{{ $category->updated_at }}</td>
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
                                                                data-target="#updateCategoryModal{{ $category->category_id }}">
                                                                Edit
                                                            </button>
                                                        </div>
                                                        <div style="text-align: center; margin-top: 10px;">
                                                            <form method="POST"
                                                                action="{{ route('category.delete', $category->category_id) }}">
                                                                @csrf
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <button id="deleteCategoryBtn_{{ $category->category_id }}"
                                                                    class="btn btn-danger show_confirm" style="width: 80%;"
                                                                    data-toggle="tooltip" title='Delete'>Delete</button>
                                                            </form>
                                                        </div>
                                                        <div style="text-align: center; margin-top: 10px;">
                                                            <div style="text-align: center; margin-top: 10px;">
                                                                <label class="switch">
                                                                    <input type="checkbox" class="status-toggle-cate"
                                                                        data-id="{{ $category->category_id }}"
                                                                        data-url="/category/change-status/"
                                                                        data-code="categoryStatus_"
                                                                        {{ $category->category_status == 1 ? 'checked' : '' }}>
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="updateCategoryModal{{ $category->category_id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="updateCategoryModalLabel{{ $category->category_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="updateCategoryModalLabel{{ $category->category_id }}">
                                                            Update Category</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="update-category-form"
                                                            action="{{ route('category.update', $category->category_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="categoryName">Category Name</label>
                                                                <input type="text" class="form-control" id="categoryName"
                                                                    name="category_name"
                                                                    value="{{ $category->category_name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="orderNumber">Order Number</label>
                                                                <input type="number" class="form-control" id="orderNumber"
                                                                    name="order_number"
                                                                    value="{{ $category->order_number }}">
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
@endsection
