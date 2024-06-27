@extends('FrontEnd.master')
@section('title')
    Dish
@endsection

@section('content')
    <div class="products">
        <div class="">
            <div class="col-md-2 rsidebar">
                <div class="rsidebar-top">
                    <div class="slider-left">
                        <h4>CHOOSE BY CATEGORY</h4>
                        <div class="row row1 scroll-pane">
                            @foreach ($categories as $category)
                                <label class="checkbox">
                                    <a href="{{ route('dish_show', ['category_id' => $category->category_id]) }}">
                                        {{ $category->category_name }}
                                    </a>
                                </label>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-10 product-w3ls-right">
                <div class="product-top">
                    <h4>Product Collection</h4>
                    <div class="clearfix"> </div>
                </div>
                @if (isset($categoryDish))
                    <div class="products-row">
                        @foreach ($categoryDish as $dish)
                            <div class="col-xs-6 col-sm-2 product-grids" style="margin-left: 100px">
                                <div class="flip-container">
                                    <div class="flipper agile-products">
                                        <div class="front">
                                            <img src="{{ asset('dish_images/' . $dish->dish_image) }}"
                                                style="width: 277px;height: 182px;" class="img-responsive" alt="img">
                                            @if ($dish->number_of_products == 0)
                                                <img class="sold-out-img"
                                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); height: 50px; width: 150px;"
                                                    src="{{ asset('sold-out-png-19953.png') }}" title="Sold Out"
                                                    alt="Sold Out" />
                                            @endif
                                            <div class="agile-product-text">
                                                <h5>{{ $dish->dish_name }}</h5>
                                            </div>
                                        </div>
                                        <div class="back">
                                            <h4>{{ $dish->dish_name }}</h4>
                                            <p>{{ $dish->dish_detail }}</p>
                                            <h6>{{ $dish->full_price }}<sup>$</sup></h6>
                                            <form action="#" method="post">
                                                <input type="hidden" name="cmd" value="_cart">
                                                <input type="hidden" name="add" value="1">
                                                <input type="hidden" name="w3ls_item" value="{{ $dish->dish_name }}">
                                                <input type="hidden" name="amount" value="{{ $dish->full_price }}">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#myModal1{{ $dish->dish_id }}">More</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal -->
                            <div class="modal video-modal fade" id="myModal1{{ $dish->dish_id }}" tabindex="-1"
                                role="dialog" aria-labelledby="myModal1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <section>
                                            <div class="modal-body">
                                                <div class="col-md-5 modal_body_left">
                                                    <img src="{{ asset('dish_images/' . $dish->dish_image) }}"
                                                        alt=" " class="img-responsive">
                                                </div>
                                                <div class="col-md-7 modal_body_right single-top-right">
                                                    <h3 class="item_name">{{ $dish->dish_name }}</h3>
                                                    <p>{{ $dish->dish_detail }}</p>
                                                    <div class="single-price">
                                                        <ul>
                                                            <li>{{ $dish->full_price }}</li>
                                                            <li>Ends on : Dec,5th</li>
                                                            <li><a href="#"><i class="fa fa-gift"
                                                                        aria-hidden="true"></i>
                                                                    Coupon</a></li>
                                                        </ul>
                                                    </div>
                                                    <p class="single-price-text">{{ $dish->dish_detail }}</p>
                                                    @if ($dish->number_of_products !== 0)
                                                        <form action="{{ route('add_to_cart') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="dish_id"
                                                                value="{{ $dish->dish_id }}" />
                                                            <div style="display: flex;">
                                                                <input type="number" min="1" name="qty"
                                                                    value="1" class="form-control"
                                                                    style="flex: 1; margin-right: 5px;">
                                                                <button type="submit" class="w3ls-cart"><i
                                                                        class="fa fa-cart-plus" aria-hidden="true"></i> Add
                                                                    to
                                                                    cart</button>
                                                            </div>
                                                            <span class="w3-agile-line"></span>
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#myModal1{{ $dish->dish_id }}"></a>
                                                        </form>
                                                    @else
                                                        <div style="display: flex;">
                                                            <input type="number" min="1" name="qty"
                                                                value="1" class="form-control"
                                                                style="flex: 1; margin-right: 5px;" disabled>
                                                            <button type="submit" class="w3ls-cart"><i
                                                                    class="fa fa-cart-plus" aria-hidden="true"
                                                                    disabled></i>
                                                                Add to cart</button>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="clearfix"> </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="clearfix"> </div>
                    </div>
                @else
                    <h1>No dish found</h1>
                @endif

            </div>
            <div class="clearfix"> </div>
        </div>
    </div>

@endsection
