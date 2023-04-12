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

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="#">Account</a>
                            <span>WishList</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <div class="container" style="height: 800px">
        <div class="card my-3 col-6">
            @if (count($products) == null)
                <h4 class="text-danger p-2">There is no items in your wishlist.</h4>
            @else
                <a href="{{ route('wishlist#allCart') }}">
                    <h4 class="text-primary p-2 text-uppercase">Add all to cart</h4>
                </a>
            @endif
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">WishList</h5>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($products as $product)
                    <li class="list-group-item d-flex align-items-center justify-content-center" id="parent">
                        <div class="col-3">
                            <img height="100px"
                                src="{{ asset('storage/product_img/' . $product['products'][0]['image']) }}"
                                alt="">
                        </div>
                        <div class="col-3 text-center">
                            <p class="">{{ $product['products'][0]['name'] }}</p>
                        </div>
                        <div class="col-2 text-center">
                            <p class="">${{ $product['products'][0]['price'] }}</p>
                        </div>
                        <div class="col-2 text-center">
                            <button type="button" class="btn btn-dark py-2 col-5 addToCart"><i
                                    class="fa-solid fa-cart-plus"></i></button>
                        </div>
                        <div class="col-2 text-center">
                            <button type="button" class="btn btn-dark py-2 col-5 removeBtn"><i
                                    class="fa-solid fa-trash"></i></button>
                        </div>
                        <input type="hidden" id="id" value="{{ $product->id }}">
                        <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                        <input type="hidden" id="productId" value="{{ $product['products'][0]['id'] }}">
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="mt-3">
            {{ $products->links() }}
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
        $('.addToCart').click(function() {
            $parentNode = $(this).parents('#parent');
            $userId = $parentNode.find('#userId').val();
            $productId = $parentNode.find('#productId').val();

            $data = {
                'count': 1,
                'userId': $userId,
                'productId': $productId
            };

            $.ajax({
                type: 'get',
                url: '/user/ajax/wishlist/product/cart',
                data: $data,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Added Successfully',
                            text: 'This item is added to your cart successfully.'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                }
            })
        });

        $('.removeBtn').click(function() {
            $parentNode = $(this).parents('#parent');
            $id = $parentNode.find('#id').val();

            $.ajax({
                type: 'get',
                url: '/user/ajax/wishlist/delete',
                data: {
                    'id': $id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.msg == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Removed Successfully',
                            text: 'This item is removed from your wishlist.'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                }
            })
        })
    })
</script>

</html>
