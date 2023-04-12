<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        @if (Route::has('login'))
            @auth
                <form class="" action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn text-dark" type="submit">Log out</button>
                </form>
            @else
                <a href="{{ route('login') }}">
                    <button class="btn text-dark">Log in</button>
                </a>
                <a href="{{ route('register') }}">
                    <button class="btn text-dark">Sign up</button>
                </a>
            @endauth
        @endif
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__text">
        <p>Free shipping, 30-day return or refund guarantee.</p>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p class="mt-2">Free shipping, 30-day return or refund guarantee.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            @if (Route::has('login'))
                                @auth
                                    <div class="row d-flex align-items-center">
                                        <form class="d-inline col-8" action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button class="btn text-white" type="submit">Log out</button>
                                        </form>
                                        <a class="image col-4" href="{{ route('user#info', Auth::user()->id) }}">
                                            @if (Auth::user()->image == null)
                                                <img class="rounded-circle" width="50px"
                                                    src="{{ asset('images/default_user.png') }}" alt="default_user">
                                            @else
                                                <img class="rounded-circle" width="50px"
                                                    src="{{ asset('storage/profile_img/' . Auth::user()->image) }}"
                                                    alt="">
                                            @endif
                                        </a>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}">
                                        <button class="btn text-white">Log in</button>
                                    </a>
                                    <a href="{{ route('register') }}">
                                        <button class="btn text-white">Sign up</button>
                                    </a>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('user/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>

                        @if (Route::has('login'))
                            @auth
                                <li><a href="{{ route('user#shop') }}">Shop</a></li>
                                <li><a href="#">Account</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('user#info', Auth::user()->id) }}">My Account</a></li>
                                        <li><a href="{{ route('user#orderList') }}">My Orders</a></li>
                                        <li><a href="{{ route('user#wishlist', Auth::user()->id) }}">My Wishlist</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('user#contactPage') }}">Contacts</a></li>
                            @else
                                <li><a href="{{ route('warning') }}">Shop</a></li>
                                <li><a href="#">Account</a>
                                    <ul class="dropdown">
                                        <li><a href="#">My Account</a></li>
                                        <li><a href="#">My Orders</a></li>
                                        <li><a href="#">My Wishlist</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Contacts</a></li>
                            @endauth
                        @endif

                    </ul>
                </nav>
            </div>
            @if (Route::has('login'))
                @auth
                    <div class="col-lg-3 col-md-3">
                        <div class="header__nav__option ">
                            <a class="mobile-menu" href="{{ route('cart#list') }}"><img src="{{ asset('user/img/icon/cart.png') }}"
                                    alt="">
                                <span>{{ count($cart) }}</span></a>
                            <div class="price" id="navPrice">$ {{ $totalPrice }}</div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-3 col-md-3">
                        <div class="header__nav__option ">
                            <a class="mobile-menu" href="#"><img src="{{ asset('user/img/icon/cart.png') }}" alt="">
                                <span>0</span></a>
                            <div class="price">$0.00</div>
                        </div>
                    </div>
                @endauth
            @endif
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->
