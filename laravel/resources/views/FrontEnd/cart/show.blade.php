@extends('FrontEnd.master')

@section('title')
Cart
@endsection

@section('content')
<div class="">
    <section class="">
        <div class="row justify-content-center " style="position: relative; display: flex;padding-right: 20px;">
            <!-- Center the row -->
            <div style="flex: 2; " >
                <!-- Nội dung của div đầu tiên -->
                <div style="border: solid white 1px; border-radius: 12px; padding: 20px;margin:50px; background: white;">
                    <div class="card">
                        <div class="card-header">
                            <h3>Your Shopping Cart</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Dish Name</th>
                                        <th scope="col">Dish Image</th>
                                        <th scope="col">Dish Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($CartDish as $dish)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$dish->name}}</td>
                                        <td>
                                            <img src="{{ asset('dish_images/' . $dish->options['dish_image']) }}"
                                                style="width: 100px;height: 90px;" class="img-responsive" alt="img">
                                        </td>
                                        <td>{{$dish->price}}</td>
                                        <td>
                                            <div style="display:flex">
                                                <button type="button"
                                                    onclick="updateQuantity('{{ $dish->rowId }}', 'decrease', {{ $dish->price }})"
                                                    class="btn btn-primary">
                                                    <i style="padding-top:5px" class="fa fa-minus"
                                                        aria-hidden="true"></i>
                                                </button>
                                                <span id="qty_{{ $dish->rowId }}"
                                                    style="margin: 0 5px;">{{ $dish->qty }}</span>
                                                <button type="button"
                                                    onclick="updateQuantity('{{ $dish->rowId }}', 'increase', {{ $dish->price }})"
                                                    class="btn btn-primary">
                                                    <i style="padding-top:5px" class="fa fa-plus"
                                                        aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display:flex">
                                                <span id="total_{{ $dish->rowId }}"
                                                    style="margin: 0 5px;">{{$dish->price * $dish->qty}}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a style="margin-left:20px"
                                                href="{{ route('remove-item', ['rowId' => $dish->rowId]) }}"
                                                type="button" class="btn btn-danger">
                                                <span aria-hidden="true">x</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="invoice" style="flex: 1; display: flex; justify-content: center; align-items: center;">
                <!-- Nội dung của div thứ hai -->
                <div class="col-md-8"
                    style="border: solid 1px #ccc; border-radius: 12px; padding: 20px; background: white;">
                    <h3 style="text-align: center;padding-bottom:20px">Invoice</h3>
                    <hr>
                    @php($i = 0)
                    @foreach($CartDish as $dish)
                    <div class="item" style="display: flex; justify-content: space-between;">
                        <span class="name">{{$dish->name}}</span>
                        <span class="quantity">{{$dish->qty}}</span>
                        <span class="total">{{$dish->price * $dish->qty}}</span>
                    </div>
                    @php($i += $dish->price * $dish->qty)
                    @endforeach
                    <hr>
                    <div class="grand-total" style="margin-top: 20px; text-align: right;">
                        <span>Total:</span>
                        <span>{{$i}}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function updateQuantity(rowId, action, price) {
    $.ajax({
        url: '{{ route("update-quantity") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            rowId: rowId,
            action: action
        },
        success: function(data) {
            $('#qty_' + rowId).html(data.qty);

            // Update the total price based on the new quantity
            var totalPrice = data.qty * price;
            $('#total_' + rowId).html(totalPrice);
        }
    });
}
</script>


@endsection