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
                                @foreach($categories as $index => $category)
                                <tr style="text-align:center">
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$category->category_id}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->order_number}}</td>
                                    <td>{{ $category->category_status == 1 ? 'active' : 'inactive' }}</td>
                                    <td>{{$category->added_on}}</td>
                                    <td>{{$category->created_at}}</td>
                                    <td>{{$category->updated_at}}</td>
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
                                                    <button type="button" class="btn btn-warning" style="width: 80%;">
                                                        <a class="dropdown-item"
                                                            style="text-decoration:none;color:black" href="{{ route('category.edit', ['id' => $category->category_id]) }}">Edit</a>
                                                    </button>
                                                </div>
                                                <div style="text-align: center; margin-top: 10px;">
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        style="width: 80%;">
                                                        <a class="dropdown-item"
                                                            style="text-decoration:none;color:white" href="{{ route('category.delete', ['id' => $category->category_id]) }}">Delete</a>
                                                    </button>
                                                </div>
                                                <div style="text-align: center; margin-top: 10px;">
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        style="width: 80%;">
                                                        <a class="dropdown-item"
                                                            style="text-decoration:none;color:white" href="#" data-id="{{ $category->category_id }}">Change Status</a>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
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