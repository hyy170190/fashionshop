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
                        <h4>Order Details</h4>
                        <div class="breadcrumb__links">
                            <a href="#">Account</a>
                            <a href="{{ route('user#orderList') }}">My Order</a>
                            <span>Order Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <div class="container">
        <div class="badge text-bg-dark rounded-pill p-3 my-4">
            <h4 class="text-white">Order No - {{ $code }}</h4>
        </div>
        <div class="table-responsive mt-3" style="min-height: 500px">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th> Product Name </th>
                        <th> Quantity </th>
                        <th> Total Cost </th>
                        <th> Ordered Date </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                <img height="100px" src="{{ asset('storage/product_img/'. $order->products->image) }}"
                                alt="product">
                            </td>
                            <td> <div class="mt-4"> {{ $order->products->name }} </div> </td>
                            <td> <div class="mt-4"> {{ $order->quantity }} </div> </td>
                            <td> <div class="mt-4"> $ {{ $order->total }} </div> </td>
                            <td> <div class="mt-4"> {{ $order->created_at->format('j-M-Y') }} </div>    </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="">
                {{ $orders->links() }}
            </div> --}}
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

    @include('user.js')
</body>
</html>
