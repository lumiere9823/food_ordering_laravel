@extends('FrontEnd.master')
@section('title')
Dish
@endsection

@section('content')
<div class="products">
    <div class="container">
        <div class="col-md-9 product-w3ls-right">
            <div class="product-top">
                <h4>Food Collection</h4>
                <div class="clearfix"> </div>
            </div>
            <div class="products-row">
                @foreach ($categoryDish as $dish)
                <div class="col-xs-6 col-sm-4 product-grids">
                    <div class="flip-container">
                        <div class="flipper agile-products">
                            <div class="front">
                                <img src="{{ asset('dish_images/' . $dish->dish_image) }}"
                                    style="width: 277px;height: 182px;" class="img-responsive" alt="img">
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
                                    <input type="hidden" name="w3ls_item" value="Fish salad">
                                    <input type="hidden" name="amount" value="3.00">
                                    <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus"
                                            aria-hidden="true"></i> Add to cart</button>
                                    <span class="w3-agile-line"> </span>
                                    <a href="#" data-toggle="modal" data-target="#myModal1{{ $dish->dish_id }}">More</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                <div class="modal video-modal fade" id="myModal1{{ $dish->dish_id }}" tabindex="-1" role="dialog"
                    aria-labelledby="myModal1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <section>
                                <div class="modal-body">
                                    <div class="col-md-5 modal_body_left">
                                        <img src="{{ asset('dish_images/' . $dish->dish_image) }}" alt=" "
                                            class="img-responsive">
                                    </div>
                                    <div class="col-md-7 modal_body_right single-top-right">
                                        <h3 class="item_name">{{ $dish->dish_name }}</h3>
                                        <p>{{ $dish->dish_detail }}</p>
                                        <div class="single-rating">
                                            <ul>
                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                <li class="w3act"><i class="fa fa-star-o" aria-hidden="true"></i>
                                                </li>
                                                <li class="rating">20 reviews</li>
                                                <li><a href="#">Add your review</a></li>
                                            </ul>
                                        </div>
                                        <div class="single-price">
                                            <ul>
                                                <li>{{ $dish->full_price }}</li>
                                                @if ($dish->half_price == null)
                                                @else
                                                <li>Half {{ $dish->half_price }}</li>
                                                <input type="checkbox" name="half_price">
                                                @endif
                                                <li>Ends on : Dec,5th</li>
                                                <li><a href="#"><i class="fa fa-gift" aria-hidden="true"></i>
                                                        Coupon</a></li>
                                            </ul>
                                        </div>
                                        <p class="single-price-text">{{ $dish->dish_detail }}</p>
                                        <form action="{{route('add_to_cart')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="dish_id" value="{{$dish->dish_id}}" />
                                            <input type="number" min="1" name="qty" value="1" />
                                            <input type="hidden" name="half_price_value" value="false" />
                                            <button type="submit" class="w3ls-cart"><i class="fa fa-cart-plus"
                                                    aria-hidden="true"></i> Add to cart</button>
                                            <span class="w3-agile-line"></span>
                                            <a href="#" data-toggle="modal"
                                                data-target="#myModal1{{ $dish->dish_id }}"></a>
                                        </form>
                                        <a href="#" class="w3ls-cart w3ls-cart-like"><i class="fa fa-heart-o"
                                                aria-hidden="true"></i> Add to Wishlist</a>
                                        <div class="single-page-icons social-icons">
                                            <ul>
                                                <li>
                                                    <h4>Share on</h4>
                                                </li>
                                                <li><a href="#" class="fa fa-facebook icon facebook"> </a>
                                                </li>
                                                <li><a href="#" class="fa fa-twitter icon twitter"> </a>
                                                </li>
                                                <li><a href="#" class="fa fa-google-plus icon googleplus">
                                                    </a></li>
                                                <li><a href="#" class="fa fa-dribbble icon dribbble"> </a>
                                                </li>
                                                <li><a href="#" class="fa fa-rss icon rss"> </a></li>
                                            </ul>
                                        </div>
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
        </div>
        <div class="col-md-3 rsidebar">
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
        <div class="clearfix"> </div>
    </div>
</div>
<!-- //products -->
<div class="container">
    <div class="w3agile-deals prds-w3text">
        <h5>for a better food experience</h5>
    </div>
</div>
<script>
    // Function to update hidden input value when half_price checkbox changes
    function updateHalfPriceValue() {
        // Get the checkbox element
        var checkbox = document.querySelector('input[name="half_price"]');
        // Get the hidden input element for half_price
        var halfPriceInput = document.querySelector('input[name="half_price_value"]');

        // Set the value of the hidden input based on checkbox state
        halfPriceInput.value = checkbox.checked ? 'true' : 'false';
    }
</script>
@endsection