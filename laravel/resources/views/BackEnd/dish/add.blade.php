@extends('layouts.app-master')
@section('content')
    <div class="content-wrapper">
        <section class="content container">
            <div class="row justify-content-center" style="position: relative">
                <div class="col-md-6"
                    style="position: absolute; transform: translate(50%, 0); border:solid white 1px; border-radius:12px; padding: 20px; background: white">
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
                            Add Product
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/dish/save') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="dish_name">Product Name</label>
                                    <input style="border-radius:12px" type="text" class="form-control" name="dish_name">
                                </div>
                                <div class="form-group">
                                    <label for="dish_detail">Product Detail</label>
                                    <textarea style="border-radius:12px" class="form-control" name="dish_detail" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="number_of_products">Number of Products</label>
                                    <input type="number" style="border-radius:12px" class="form-control"
                                        name="number_of_products" rows="3"></input>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}">
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dish_image">Product Image</label>
                                    <input style="border-radius:12px" type="file" class="form-control-file"
                                        name="dish_image">
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <label for="dish_status">Product Status</label>
                                    <div class="radio" style="margin-left:20px; display:flex">
                                        <div>
                                            <input type="radio" name="dish_status" value="1" id="active" checked>
                                            <label for="active">Active</label>
                                        </div>
                                        <div style="margin-left:50px">
                                            <input type="radio" name="dish_status" value="0" id="inactive">
                                            <label for="inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" title="You can skip this">Product attribute</div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Full price</label>
                                                    <input type="text" class="form-control" name="full_price"
                                                        id="full_price" placeholder="full_price" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
