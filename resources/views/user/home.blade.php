<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashion_Shop">
    <meta name="keywords" content="Fashion_Shop, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chic Fashion</title>

    {{-- CSS --}}
    @include('user.css')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('user.navbar')

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="{{ asset('user/img/hero/hero-1.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Summer Collection</h6>
                                <h2>Spring - Summer Collections 2023</h2>
                                <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                    commitment to exceptional quality.</p>
                                <a href="" class="shopNow primary-btn">Shop now <span
                                        class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                    <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="{{ asset('user/img/hero/hero-2.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Summer Collection</h6>
                                <h2>Spring - Summer Collections 2023</h2>
                                <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                    commitment to exceptional quality.</p>
                                <a href="" class="shopNow primary-btn">Shop now <span
                                        class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                                    <a href="https://twitter.com/"><i class="fa-brands fa-twitter"></i></a>
                                    <a href="https://www.pinterest.com/"><i class="fa-brands fa-pinterest"></i></a>
                                    <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="{{ asset('user/img/banner/banner-1.jpg') }}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Trendsetters 2023</h2>
                            <a href="" class="shopNow">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="{{ asset('user/img/banner/banner-2.jpg') }}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Accessories</h2>
                            <a href="" class="shopNow">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="{{ asset('user/img/banner/banner-3.jpg') }}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Shoes Spring 2023</h2>
                            <a href="" class="shopNow">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->


    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container" id="product-sec">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li id="best-sellers" class="active" data-filter=".best-sellers">Best Sellers</li>
                        <li id="new-arrivals" data-filter=".new-arrivals">New Arrivals</li>
                        <li id="hot-sales" data-filter=".hot-sales">Hot Sales</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
            @foreach ($bestSellers as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix best-sellers">
                    <div class="product__item">
                        <div class="product__item__pic set-bg"
                            data-setbg="{{ asset('storage/product_img/' . $product->image) }}">
                            <input type="hidden" value="{{ $product->id }}" id="productId">
                            <ul class="product__hover">
                                <li><a href="#" class="addToWishlist"><img
                                            src="{{ asset('user/img/icon/heart.png') }}" alt=""></a></li>
                                <li><a href="{{ route('product#details', $product->id) }}"><img
                                            src="{{ asset('user/img/icon/search.png') }}" alt=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{ $product->name }}</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <h5>${{ $product->price }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
            @if(isset($newArrivals))
                @foreach ($newArrivals as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals" style="display: none">
            <div class="product__item sale">
                <div class="product__item__pic set-bg"
                    data-setbg="{{ asset('storage/product_img/' . $product->image) }}">
                    <input type="hidden" value="{{ $product->id }}" id="productId">
                    <span class="label">New</span>
                    <ul class="product__hover">
                        <li><a href="#" class="addToWishlist"><img
                                    src="{{ asset('user/img/icon/heart.png') }}" alt=""></a></li>
                        <li><a href="#"><img src="{{ asset('user/img/icon/compare.png') }}"
                                    alt="">
                                <span>Compare</span></a></li>
                        <li><a href="{{ route('product#details', $product->id) }}"><img
                                    src="{{ asset('user/img/icon/search.pn') }}g" alt=""></a>
                        </li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6>{{ $product->name }}</h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>
                    <h5>${{ $product->price }}</h5>
                </div>
            </div>
        </div>
    @endforeach
            @endif
                @if (!empty($hotSales[0]->products))
                    @foreach ($hotSales as $product)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales" style="display: none">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ asset('storage/product_img/' . $product->products['image']) }}">
                                    <input type="hidden" value="{{ $product->products->id }}" id="productId">
                                    <span class="label">Sale</span>
                                    <ul class="product__hover">
                                        <li><a href="#" class="addToWishlist"><img
                                                    src="{{ asset('user/img/icon/heart.png') }}" alt=""></a>
                                        </li>
                                        <li><a href="{{ route('product#details', $product->id) }}"><img
                                                    src="{{ asset('user/img/icon/search.png') }}" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $product->products['name'] }}</h6>
                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                    <h5>${{ $product->products['price'] }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="{{ asset('user/img/product-sale.png') }}" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5>$29.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Week</span>
                        <h2>Levi Multi-pocket Bag</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="{{ route('user#shop') }}" class="primary-btn">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad" style="margin-bottom: 150px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg"
                            data-setbg="{{ asset('user/img/instagram/instagram-1.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg"
                            data-setbg="{{ asset('user/img/instagram/instagram-2.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg"
                            data-setbg="{{ asset('user/img/instagram/instagram-3.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg"
                            data-setbg="{{ asset('user/img/instagram/instagram-4.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg"
                            data-setbg="{{ asset('user/img/instagram/instagram-5.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg"
                            data-setbg="{{ asset('user/img/instagram/instagram-6.jpg') }}"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>Post instagram on your support to Chic Fashion and Stand a chance to win exclusive prizes.</p>
                        <h3>#Fashion4All</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Button trigger modal -->
    <button type="button" id="modelBtn" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#exampleModal" style="display: none">
        Model
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Unauthorized process</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You need to login first!
                </div>
                <div class="modal-footer">
                    <a href="{{ route('login') }}"><button type="button"
                            class="btn btn-secondary">Login</button></a>
                    <a href="{{ route('register') }}"><button type="button" class="btn btn-primary">Sign
                            up</button></a>
                </div>
            </div>
        </div>
    </div>

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
        $('#new-arrivals').click(function() {
            event.preventDefault();
            $('.product__filter .new-arrivals').show();
        });

        $('#hot-sales').click(function() {
            event.preventDefault();
            $('.product__filter .hot-sales').show();
        });

        $('#best-sellers').click(function() {
            event.preventDefault();
            $('.product__filter .new-arrivals').hide();
            $('.product__filter .hot-sales').hide();
        });

        $('.addToWishlist').click(function() {
            event.preventDefault();
            $parentNode = $(this).parents('.product__item__pic');
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
                        timer: 1800,
                        showConfirmButton: false,
                        text: 'This product is added to the your wishlist successfully.'
                    });
                },
                error: function(response) {
                    if (response.responseJSON.msg == 'unlogin') {
                        $("#modelBtn").click();
                    } else if (response.responseJSON.error == 'already') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Already in Wishlist',
                            timer: 1800,
                            showConfirmButton: false,
                            text: 'This product is already in your wishlist.'
                        });
                    }
                }
            });
        });

        $('.btn-close').click(function() {
            event.preventDefault();
            $('.alert-warning #msg').text("");
            $('.alert-warning').hide();
        });

        $('.add-cart').click(function() {
            event.preventDefault();
            $parentNode = $(this).parents('.product__item');
            $data = {
                'count': 1,
                'productId': $parentNode.find('#productId').val()
            };

            $.ajax({
                type: 'get',
                url: '/user/ajax/shop/product/cart',
                data: $data,
                datatype: 'json',
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added Successfully',
                        timer: 2000,
                        text: 'This product is added to the cart successfully.'
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(response) {
                    $(window).scrollTop(0);
                    $("#modelBtn").click();
                }
            })
        });

        $('.shopNow').click(function() {
            event.preventDefault();
            $.ajax({
                type: 'get',
                url: '/user/ajax/shop',
                success: function(response) {
                    window.location.href = '/user/products/shop';
                },
                error: function(response) {
                    $("#modelBtn").click();
                }
            })
        })
    })
</script>

</html>
