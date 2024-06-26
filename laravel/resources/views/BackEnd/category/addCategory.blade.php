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
                            Category
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/category/save') }}" method="post" id="categoryForm">
                                @csrf
                                <div class="form-group">
                                    <label for="category_name">Category Name</label>
                                    <input style="border-radius:12px" type="text" class="form-control"
                                        name="category_name">
                                </div>

                                <div class="form-group">
                                    <label for="order_number">Order Number</label>
                                    <input style="border-radius:12px" type="number" class="form-control"
                                        name="order_number">
                                </div>

                                <div class="form-group">
                                    <label for="added_on">Added On</label>
                                    <input style="border-radius:12px" type="date" class="form-control" name="added_on">
                                </div>

                                <div class="form-group d-flex justify-content-center">
                                    <label for="category_status">Category Status</label>
                                    <div class="radio" style="margin-left:20px; display:flex">
                                        <div>
                                            <input type="radio" name="status" value="1" id="active">
                                            <label for="active">Active</label>
                                        </div>
                                        <div style="margin-left:50px">
                                            <input type="radio" name="status" value="0" id="inactive">
                                            <label for="inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="btn" class="btn btn-success">Category Add</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
