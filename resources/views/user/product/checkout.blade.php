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
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="{{ route('user#shop') }}">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a
                                    href="#">Click
                                    here</a> to enter your code</h6>
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input class="first_name text-dark" name="first_name" type="text"
                                            value="{{ old('first_name') }}">
                                        <span class="text-danger" id="firstNameErrorMessage"></span>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input class="last_name text-dark" name="last_name" type="text"
                                            value="{{ old('last_name') }}">
                                        <span class="text-danger" id="lastNameErrorMessage"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input class="country text-dark" name="country" type="text"
                                    value="{{ old('country') }}">
                                <span class="text-danger" id="countryErrorMessage"></span>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input class="address1 text-dark" type="text" name="address1"
                                    value="{{ old('address1') }}" placeholder="Street Address"
                                    class="checkout__input__add">
                                <span class="text-danger" id="address1ErrorMessage"></span>
                                <input class="address2 text-dark" type="text" name="address2"
                                    value="{{ old('address2') }}" placeholder="Apartment, suite, unite ect (optinal)">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input class="city text-dark" value="{{ old('city') }}" type="text">
                                <span class="text-danger" id="cityErrorMessage"></span>
                            </div>
                            <div class="checkout__input">
                                <p>State<span>*</span></p>
                                <input class="state text-dark" name="state" value="{{ old('state') }}"
                                    type="text">
                                <span class="text-danger" id="stateErrorMessage"></span>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input class="phone text-dark" name="phone" value="{{ old('phone') }}"
                                            type="text">
                                        <span class="text-danger" id="phoneErrorMessage"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input class="email text-dark" name="email" value="{{ old('email') }}"
                                            type="email">
                                        <span class="text-danger" id="emailErrorMessage"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input class="password text-dark" type="password" name="password">
                                <span class="text-danger" id="passwordErrorMessage"></span>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Note about your order, e.g, special note for delivery
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input class="notes text-dark" type="text" name="notestext-dark "
                                    value="{{ old('note') }}"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                                <span class="text-danger" id="notesErrorMessage"></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    @foreach ($cart as $c)
                                        <li> {{ $c->products[0]->name }} <span class="total">$
                                                {{ $c->products[0]->price * $c->quantity }}</span>
                                            <input type="hidden" class="productId" value="{{ $c->product_id }}">
                                            <input type="hidden" class="quantity" value="{{ $c->quantity }}">
                                            <input type="hidden" class="userId" value="{{ Auth::user()->id }}">
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>$ {{ $totalPrice }}</span></li>
                                    <li>Total <span id="totalPrice">$ {{ $totalPrice }}</span></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                {{-- <div class="my-3">
                                    <a href="{{ route('user#payment') }}" class="text-info">Payment with Visa/Master
                                        Card</a>
                                </div> --}}
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

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
        $('.site-btn').click(function() {
            event.preventDefault();
            $parentNode = $(this).parents('.checkout__form');

            $firstName = $parentNode.find('.first_name').val();
            $lastName = $parentNode.find('.last_name').val();
            $country = $parentNode.find('.country').val();
            $address1 = $parentNode.find('.address1').val();
            $address2 = $parentNode.find('.address2').val();
            $city = $parentNode.find('.city').val();
            $state = $parentNode.find('.state').val();
            $phone = $parentNode.find('.phone').val();
            $email = $parentNode.find('.email').val();
            $notes = $parentNode.find('.notes').val();
            $password = $parentNode.find('.password').val();
            $orderList = [];

            $('.checkout__total__products li').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('.userId').val(),
                    'product_id': $(row).find('.productId').val(),
                    'quantity': Number($(row).find('.quantity').val()),
                    'total': Number($(row).find('.total').text().replace('$', ''))
                });
            });

            $data = {
                "_token": "{{ csrf_token() }}",
                'first_name': $firstName,
                'last_name': $lastName,
                'country': $country,
                'address1': $address1,
                'address2': $address2,
                'city': $city,
                'state': $state,
                'phone': $phone,
                'email': $email,
                'notes': $notes,
                'password': $password,
                'order_list': $orderList
            };

            var spans = $('.text-danger');
            spans.text('');
            price = Number($parentNode.find('#totalPrice').text().replace('$',''));

            $.ajax({
                type: 'POST',
                url: '/user/ajax/products/order',
                data: $data,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Ordered Successfully',
                            confirmButtonText: 'Visa',
                            text: 'You can complete the payment with visa card.'
                        }).then((result) => {
                            window.location.href = '/user/order/payment/' + price;
                        });
                    }
                },
                error: function(response) {

                    $('#firstNameErrorMessage').text(response.responseJSON.errors.first_name);
                    $('#lastNameErrorMessage').text(response.responseJSON.errors.last_name);
                    $('#countryErrorMessage').text(response.responseJSON.errors.country);
                    $('#address1ErrorMessage').text(response.responseJSON.errors.address1);
                    $('#cityErrorMessage').text(response.responseJSON.errors.city);
                    $('#stateErrorMessage').text(response.responseJSON.errors.state);
                    $('#phoneErrorMessage').text(response.responseJSON.errors.phone);
                    $('#emailErrorMessage').text(response.responseJSON.errors.email);
                    $('#passwordErrorMessage').text(response.responseJSON.errors.password);
                },
            })
        });
    })
</script>

</html>
