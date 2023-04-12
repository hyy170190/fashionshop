<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
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

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                                strict attention.</p>
                        </div>
                        <ul>
                            <li>
                                <h4>Malaysia</h4>
                                <p>Jalan Sungai Long, Bandar Sungai Long, 43000 Kajang, Selangor <br />+603-90860288</p>
                            </li>
                            <li>
                                <h4>Türkiye</h4>
                                <p>Kuloğlu, İstiklal Cd. No; 123-A, 34433 Beyoğlu/İstanbul <br />+902-122446255</p>
                            </li>
                            <li>
                                <h4>United States</h4>
                                <p>5606 Bay St, Emeryville, CA 94608, United States <br />+1 855-486-4756</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="{{ route('user#contact') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="username" placeholder="Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="message" placeholder="Message" required></textarea>
                                    <button type="submit" class="site-btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

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

</html>
