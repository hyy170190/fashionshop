<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Male-Fashion | Template</title>

    @include('user.css')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('user.navbar')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="{{ route('user#shop') }}" method="get">
                                @csrf
                                <input type="text" name="key" placeholder="Search..."
                                    value="{{ request('key') }}">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <li><a href="{{ route('user#shop') }}">All</a></li>
                                                    @foreach ($categories as $category)
                                                        <li><a
                                                                href="{{ route('product#filterByCategory', $category->id) }}">{{ $category->name }}
                                                                ({{ count($category->products) }})
                                                            </a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li><a
                                                            href="{{ route('product#filterByPrice', ['p1' => 0, 'p2' => 50]) }}">$0.00
                                                            - $50.00</a></li>
                                                    <li><a
                                                            href="{{ route('product#filterByPrice', ['p1' => 50, 'p2' => 100]) }}">$50.00
                                                            - $100.00</a></li>
                                                    <li><a
                                                            href="{{ route('product#filterByPrice', ['p1' => 100, 'p2' => 150]) }}">$100.00
                                                            - $150.00</a></li>
                                                    <li><a
                                                            href="{{ route('product#filterByPrice', ['p1' => 150, 'p2' => 200]) }}">$150.00
                                                            - $200.00</a></li>
                                                    <li><a
                                                            href="{{ route('product#filterByPrice', ['p1' => 200, 'p2' => 250]) }}">$200.00
                                                            - $250.00</a></li>
                                                    <li><a
                                                            href="{{ route('product#filterByPrice', ['p1' => 250, 'p2' => 1000]) }}">250.00+</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                <a href="{{ route('product#filterBySize', 'S') }}">
                                                    <label for="sm">
                                                        s
                                                    </label>
                                                </a>

                                                <a href="{{ route('product#filterBySize', 'M') }}">
                                                    <label for="md">
                                                        m
                                                    </label>
                                                </a>

                                                <a href="{{ route('product#filterBySize', 'L') }}">
                                                    <label for="l">
                                                        l
                                                    </label>
                                                </a>

                                                <a href="{{ route('product#filterBySize', 'XL') }}">
                                                    <label for="xl">
                                                        xl
                                                    </label>
                                                </a>

                                                <a href="{{ route('product#filterBySize', '2XL') }}">
                                                    <label for="2xl">
                                                        2xl
                                                    </label>
                                                </a>

                                                <a href="{{ route('product#filterBySize', '3XL') }}">
                                                    <label for="3xl">
                                                        3xl
                                                    </label>
                                                </a>

                                                <a href="{{ route('product#filterBySize', '4XL') }}">
                                                    <label for="4xl">
                                                        4xl
                                                    </label>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                    </div>
                                    <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__tags">
                                                <a href="#">Product</a>
                                                <a href="#">Bags</a>
                                                <a href="#">Shoes</a>
                                                <a href="#">Fashio</a>
                                                <a href="#">Clothing</a>
                                                <a href="#">Hats</a>
                                                <a href="#">Accessories</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing 1–{{ count($products) }} of all products</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select name="sorting" id="sortingOption" onchange="location = this.value">
                                        @if (isset($para))
                                            <option value="{{ route('product#sort', 'asc') }}"
                                                @if ($para == 'asc') selected @endif>Low To High</option>
                                            <option value="{{ route('product#sort', 'desc') }}"
                                                @if ($para == 'desc') selected @endif>High to Low</option>
                                        @else
                                            <option value="{{ route('product#sort', 'asc') }}">Low To High</option>
                                            <option value="{{ route('product#sort', 'desc') }}">High to Low</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="productList">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg"
                                        data-setbg="{{ asset('storage/product_img/' . $product->image) }}">
                                        <input type="hidden" value="{{ Auth::user()->id }}" id="userId">
                                        <input type="hidden" value="{{ $product->id }}" id="productId">
                                        <ul class="product__hover">
                                            <li>
                                                <a href="#" class="addToWishlist"><img
                                                        src="{{ asset('user/img/icon/heart.png') }}"
                                                        alt=""></a>
                                            <li><a href="{{ route('product#details', $product->id) }}"><img
                                                        src="{{ asset('user/img/icon/search.png') }}"
                                                        alt=""></a>
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
                    </div>
                    <div class="">
                        {{ $products->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

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

    @include('user.js')
</body>
<script>
    $(document).ready(function() {
        $('.add-cart').click(function() {
            $parentNode = $(this).parents('.product__item');
            $data = {
                'count': 1,
                'userId': $parentNode.find('#userId').val(),
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
                }
            })
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
                    Swal.fire({
                        icon: 'warning',
                        title: 'Already in Wishlist',
                        timer: 1800,
                        showConfirmButton: false,
                        text: 'This product is already in your wishlist.'
                    });
                }
            });
        });
    })
</script>

</html>
