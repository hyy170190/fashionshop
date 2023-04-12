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
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="{{ route('user#shop') }}">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table id="cartTable">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $c)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img height="100px"
                                                    src="{{ asset('storage/product_img/' . $c->products[0]->image) }}"
                                                    alt="">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6>{{ $c->products[0]->name }}</h6>
                                                <h5 id="productPrice">${{ $c->products[0]->price }}</h5>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="pro-qty-2">
                                                    <input type="text" value="{{ $c->quantity }}" id="qty">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart__price" id="price">
                                            ${{ $c->products[0]->price * $c->quantity }}</td>
                                        <td class="cart__close">
                                            <i class="fa fa-close"></i>
                                            <input type="hidden" id="productId" value="{{ $c->product_id }}">
                                            <input type="hidden" id="orderId" value="{{ $c->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($totalPrice == null)
                                    <tr>
                                        <td><span class="text-danger">There is no product in your cart.</span></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('user#shop') }}">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            @if ($totalPrice == null)
                                <div class="continue__btn update__btn">
                                    <a href="javascript::void(0)"><i class="fa-solid fa-trash-can"></i> Clear cart</a>
                                </div>
                            @else
                                <div class="continue__btn update__btn">
                                    <a href="{{ route('cart#clear') }}"><i class="fa-solid fa-trash-can"></i> Clear cart</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span id="subTotalPrice">$ {{ $totalPrice }}</span></li>
                            <li>Total <span id="totalPrice">$ {{ $totalPrice }}</span></li>
                        </ul>
                        @if ($totalPrice == null)
                            <a href="javascript:void(0)" class="primary-btn">Proceed to checkout</a>
                        @else
                            <a href="{{ route('order#checkout') }}" class="primary-btn">Proceed to checkout</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

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
        $('.fa-angle-left').click(function() {

            $parentNode = $(this).parents('tr');

            $price = Number($parentNode.find('#productPrice').html().replace('$', ''));
            $quantity = Number($parentNode.find('#qty').val()) - 1;
            $total = $price * $quantity;

            if ($quantity >= 0) {
                $parentNode.find('#price').html('$' + $total.toFixed(2));

                totalPriceCalculation();
            }

        })

        $('.fa-angle-right').click(function() {
            $parentNode = $(this).parents('tr');
            $price = Number($parentNode.find('#productPrice').html().replace('$', ''));
            $quantity = Number($parentNode.find('#qty').val()) + 1;

            $total = $price * $quantity;

            $parentNode.find('#price').html('$' + $total.toFixed(2));

            totalPriceCalculation();
        })

        $('.fa-close').click(function() {

            $parentNode = $(this).parents('tr');
            $productId = $parentNode.find('#productId').val();
            $orderId = $parentNode.find('#orderId').val();

            $.ajax({
                type: 'get',
                url: '/user/ajax/cart/product/delete',
                data: {
                    'productId': $productId,
                    'orderId': $orderId
                },
                dataType: 'json'
            })

            $parentNode.remove();

            totalPriceCalculation();

            if ($totalPrice === 0){
                $('.primary-btn').attr('href','javascript:void(0)');
            }
        })

        $('.primary-btn').click(function(){

            $list = [];

            $('.row #cartTable tbody tr').each(function(index,row){
                $list.push({
                    'product_id' : $(row).find('#productId').val(),
                    'quantity' : Number($(row).find('#qty').val()),
                    'total' : Number($(row).find('#price').html().replace('$',''))
                });
            });

            $.ajax({
                type : 'get',
                url : '/user/ajax/order/checkout',
                data : Object.assign({},$list),
                dataType : 'json'
            })
        })

        function totalPriceCalculation() {
            $totalPrice = 0;
            $('#cartTable tbody tr').each(function(index, row) {
                $totalPrice += Number($(row).find('#price').text().replace('$', ''));
            })

            $('#subTotalPrice').html('$' + $totalPrice.toFixed(2));
            $('#totalPrice').html('$' + $totalPrice.toFixed(2));
            $('#navPrice').html('$' + $totalPrice.toFixed(2))
        }
    })
</script>

</html>
