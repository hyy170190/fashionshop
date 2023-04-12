<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Male-Fashion | Template</title>

    {{-- CSS --}}
    @include('user.css')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('user.navbar')

    {{-- Message session --}}
    <div class="col-4 offset-4 alert alert-warning alert-dismissible fade show mt-5" role="alert"
        style="display: none">
        <span id="msg"></span> <a href="{{ route('user#wishlist', Auth::user()->id) }}" class="alert-link">Check
            here!</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    {{-- Message Section end --}}

    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="{{ route('user#shop') }}">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-9 offset-3">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ asset('storage/product_img/' . $product->image) }}"
                                        alt="{{ $product->name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product->name }}</h4>
                            <h3>${{ $product->price }}</h3>
                            <p>{{ $product->description }}</p>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" id="orderCount">
                                    </div>
                                </div>
                                <a href="#" class="addToCart primary-btn" type="button">add to cart</a>
                            </div>
                            <div class="product__details__btns__option">
                                <a href="#" id="addToWishlist"><i class="fa fa-heart"></i> add to wishlist</a>
                                <input type="hidden" name="productId" id="productId" value="{{ $product->id }}">
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="{{ asset('user/img/shop-details/details-payment.png') }}" alt="">
                                <ul>
                                    <a href="" class="reviewBtn primary-btn" type="button">review this
                                        product</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mt-2" id="review" style="display: none">
                    <form action="{{ route('product#review') }}" class="px-5 py-3" method="'get">
                        <input type="hidden" name="productId" value="{{ $product->id }}">
                        <textarea class="form-control" name="review" cols="30" rows="10"></textarea>
                        <button class="btn btn-dark mt-2" type="submit">Submit</button>
                        <div class="btn btn-dark mt-2 ms-2" id="hideReview">Cancel</div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Customer
                                        Reviews({{ count($reviews) }})</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                        information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    @foreach ($reviews as $review)
                                        <div class="product__details__tab__content">
                                            <div class="px-5 py-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p class="fs-5"><i
                                                                class="fa-solid fa-star mr-3"></i>Reviewed by
                                                            {{ $review->user->name }}</p>
                                                    </div>
                                                    <div class="col-2 offset-4">
                                                        {{ $review->created_at->format('j M Y') }}
                                                    </div>
                                                </div>
                                                <p class="col-7 text-break">{{ $review->review }}</p>
                                            </div>
                                            <hr class=" opacity-75 text-dark">
                                        </div>
                                    @endforeach
                                    <div class="">
                                        {{ $reviews->links() }}
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla
                                            deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                            pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <input type="hidden" value="{{ Auth::user()->id }}" id="userId">
            <div class="row">
                @if (count($relatedProducts) >= 4)
                    @for ($i = 0; $i < 4; $i++)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ asset('storage/product_img/' . $relatedProducts[$i]->image) }}">
                                    <input type="hidden" value="{{ $relatedProducts[$i]->id }}" id="productId">
                                    <ul class="product__hover">
                                        <li><a href="#" class="addToWishlist2"><img src="{{ asset('user/img/icon/heart.png') }}"
                                                    alt=""></a></li>
                                        <li><a href="{{ route('product#details', $relatedProducts[$i]->id) }}"><img
                                                    src="{{ asset('user/img/icon/search.png') }}" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $relatedProducts[$i]->name }}</h6>
                                    <a href="#" class="add-cart addToCart2">+ Add To Cart</a>
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>${{ $relatedProducts[$i]->price }}</h5>
                                </div>
                            </div>
                        </div>
                    @endfor
                @else
                    @for ($i = 0; $i < count($relatedProducts); $i++)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ asset('storage/product_img/' . $relatedProducts[$i]->image) }}">
                                    <input type="hidden" value="{{ $relatedProducts[$i]->id }}" id="productId">
                                    <ul class="product__hover">
                                        <li><a href="#" class="addToWishlist2"><img src="{{ asset('user/img/icon/heart.png') }}"
                                                    alt=""></a></li>
                                        <li><a href="{{ route('product#details', $relatedProducts[$i]->id) }}"><img
                                                    src="{{ asset('user/img/icon/search.png') }}" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $relatedProducts[$i]->name }}</h6>
                                    <a href="#" class="add-cart addToCart2">+ Add To Cart</a>
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>${{ $relatedProducts[$i]->price }}</h5>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>
    <!-- Related Section End -->

    @include('user.footer')

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    @include('user.js')
</body>
<script>
    $(document).ready(function() {
        $('.addToCart').click(function() {
            $data = {
                'count': $('#orderCount').val(),
                'userId': $('#userId').val(),
                'productId': $('#productId').val()
            };

            $.ajax({
                type: 'get',
                url: '/user/ajax/product/cart',
                data: $data,
                datatype: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Added Successfully',
                            text: 'This product is added to the cart successfully.'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                }
            })
        });

        $('.addToCart2').click(function() {
            $parentNode = $(this).parents('.container');
            $userId = $parentNode.find('#userId').val();
            $productId = $parentNode.find('#productId').val();

            $data = {
                'count': 1,
                'userId': $userId,
                'productId': $productId
            };

            $.ajax({
                type: 'get',
                url: '/user/ajax/product/cart',
                data: $data,
                datatype: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Added Successfully',
                            text: 'This product is added to the cart successfully.'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                }
            })
        });

        $('#addToWishlist').click(function() {
            event.preventDefault();
            $parentNode = $(this).parents('.product__details__btns__option');
            $productId = $parentNode.find('#productId').val();

            $.ajax({
                type: 'get',
                url: '/user/ajax/product/wishlist/add',
                data: {
                    'product_id': $productId
                },
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added Successfully',
                        text: 'This product is added to the your wishlist successfully.'
                    });
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Already in Wishlist',
                        text: 'This product is already in your wishlist.'
                    });
                }
            });
        });

        $('.addToWishlist2').click(function() {
            event.preventDefault();
            $parentNode = $(this).parents('.product__item__pic');
            $productId = $parentNode.find('#productId').val();
            console.log($productId);

            $.ajax({
                type: 'get',
                url: '/user/ajax/product/wishlist/add',
                data: {
                    'product_id': $productId
                },
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added Successfully',
                        text: 'This product is added to the your wishlist successfully.'
                    });
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Already in Wishlist',
                        text: 'This product is already in your wishlist.'
                    });
                }
            });
        });

        $('.reviewBtn').click(function() {
            event.preventDefault();
            $('#review').show();
        });

        $('#hideReview').click(function() {
            event.preventDefault();
            $('#review').hide();
        })
    })
</script>

</html>
