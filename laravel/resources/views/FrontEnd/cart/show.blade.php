@extends('FrontEnd.cart_master')

@section('title')
    Cart
@endsection

@section('content')
    <div style="min-height: 50vh;">
        <section class="">
            <div class="row justify-content-center " style="position: relative; display: flex;padding-right: 20px;">
                <div style="flex: 2; ">
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
                                        @if ($CartDish->count() > 0)
                                            @foreach ($CartDish as $dish)
                                                <tr>
                                                    <th scope="row">{{ $i++ }}</th>
                                                    <td>{{ $dish->name }}</td>
                                                    <td>
                                                        <img src="{{ asset('dish_images/' . $dish->options['dish_image']) }}"
                                                            style="width: 100px;height: 90px;" class="img-responsive"
                                                            alt="img">
                                                    </td>
                                                    <td>{{ $dish->price }}</td>
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
                                                                style="margin: 0 5px;">{{ $dish->price * $dish->qty }}</span>
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
                                        @else
                                            <tr>
                                                <td colspan="7" style="text-align: center;">Empty!</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="invoice" style="flex: 1; display: flex; justify-content: center; align-items: center;">
                    <div class="col-md-8"
                        style="border: solid 1px #ccc; border-radius: 12px; padding: 20px; background: white;">
                        <h3 style="text-align: center;padding-bottom:20px">Invoice</h3>
                        <hr>
                        @php($i = 0)
                        @foreach ($CartDish as $dish)
                            <div class="item" style="display: flex; justify-content: space-between;">
                                <span class="name">{{ $dish->name }}</span>
                                <span class="quantity" id="quantity1_{{ $dish->rowId }}">{{ $dish->qty }}</span>
                                <span class="total1"
                                    id="total1_{{ $dish->rowId }}">{{ $dish->price * $dish->qty }}</span>
                            </div>
                            @php($i += $dish->price * $dish->qty)
                        @endforeach
                        <hr>
                        <div style="display: flex; justify-content: space-between;align-item: center;">
                            <div class="grand-total" id="final" style="margin-top: 10px; text-align: left; ">
                                @if (count($CartDish) == 0)
                                @else
                                    @if (Auth::check())
                                        <a type="button" class="btn btn-info" href="{{ route('shipping.show') }}">
                                            <i class="fa fa-shopping-bag"></i> Check Out
                                        </a>
                                    @else
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#payment">
                                            <i class="fa fa-shopping-bag"></i> Check Out
                                        </button>
                                    @endif
                                @endif
                            </div>
                            <div class="grand-total" id="final" style="margin-top: 20px; text-align: right;">
                                <span>Discount:</span>
                                <select name="coupon" id="coupon">
                                    <option data-coupon-value = 0 ></option>
                                    @foreach ($coupons as $coupon)
                                        @if ($coupon->cart_min_value <= $i)
                                            <option value="{{ $coupon->coupon_number }}"
                                                data-coupon-value="{{ $coupon->coupon_value }}"
                                                data-coupon-id="{{ $coupon->coupon_id }}">
                                                {{ $coupon->coupon_code }}-{{ $coupon->coupon_value }}%
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="grand-total" id="final" style="margin-top: 20px; text-align: right;">
                                <span>Total:</span>
                                <span id="totalAmount">{{ $i }}</span>
                                <?php
                                Session::put('sum', $i);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"
                    style="text-align: center; padding: 20px; display: flex; justify-content: center; align-items: center;">
                    <div class="col-md-6" style="margin-right: 20px; position: relative;">
                        <div style="width: 100%; height: 0; padding-bottom: 100%; position: relative;">
                            <img src="https://t3.ftcdn.net/jpg/06/76/45/32/240_F_676453298_oawytYg5O4uT2TDkORl8t5rbGuuwGqf9.jpg"
                                alt=""
                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 70%; height: auto;">
                        </div>
                    </div>
                    <hr
                        style="position: absolute; top: 0; bottom: 0; left: 50%; transform: translateX(-50%); height: 100%; border-left: 1px solid ;">
                    <div class="col-md-6" style="position: relative;">
                        <a type="button" href="{{ route('login.show') }}" class="btn btn-primary"
                            style="margin-bottom: 20px;">Go to login</a>
                        <div style="text-align: center; margin-bottom: 20px;">
                            <hr style="width: 45%; float: left;border: 1px solid ;">
                            <span style="display: inline-block; margin: 0 10px;">Or</span>
                            <hr style="width: 45%; float: right;border: 1px solid ;">
                        </div>
                        <a type="button" href="{{ route('register.show') }}" class="btn btn-primary"
                            style="margin-top: 20px;">Go
                            to
                            register</a>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateQuantity(rowId, action, price) {
            $.ajax({
                url: '{{ route('update-quantity') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    rowId: rowId,
                    action: action
                },
                success: function(data) {
                    $('#qty_' + rowId).html(data.qty);
                    $('#quantity1_' + rowId).html(data.qty);

                    // Update the total price based on the new quantity
                    var totalPrice = data.qty * price;
                    $('#total_' + rowId).html(totalPrice);
                    $('#total1_' + rowId).html(totalPrice);

                    var grandTotal = 0;
                    $('.total1').each(function() {
                        grandTotal += parseFloat($(this).text());
                    });
                    $('#totalAmount').text(grandTotal);
                }
            });
        }

        $(document).ready(function() {
            $('#authTabs a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            $('#coupon').change(function() {
                var couponValue = parseInt(this.options[this.selectedIndex].getAttribute(
                    'data-coupon-value'));
                var couponId = parseInt(this.options[this.selectedIndex].getAttribute(
                    'data-coupon-id'));
                var totalAmount = {{ $i }};
                var discountedAmount = totalAmount - (totalAmount * couponValue / 100);
                $('#totalAmount').text(discountedAmount);

                $.ajax({
                    url: '{{ route('apply_coupon') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        discountedAmount: discountedAmount,
                        couponId: couponId
                    },
                    success: function(response) {
                        console.log('Coupon applied successfully!');
                    }
                });
            });
            $('#coupon').change();
        });
    </script>
@endsection
