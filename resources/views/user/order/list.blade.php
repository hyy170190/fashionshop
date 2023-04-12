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
                        <h4>Order list</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="{{ route('user#shop') }}">Shop</a>
                            <span>Order list</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <div class="container">
        <div class="table-responsive mt-5" style="height: 500px">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th> Order No </th>
                        <th> Total Cost </th>
                        <th> Payment Method </th>
                        <th> Ordered Date </th>
                        <th> Order Status </th>
                        <th> Order Cancel </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>#</td>
                            <td> <a href="{{ route('user#orderDetails', $order->order_code) }}"
                                    class="text-primary">{{ $order->order_code }}</a> </td>
                            <td> $ {{ $order->total_price }} </td>
                            <td> {{ $order->billingDetails->payment }} </td>
                            <td> {{ $order->created_at->format('j-M-Y') }} </td>
                            <td>
                                @if ($order->status == 0)
                                    <button class="btn btn-outline-warning" disabled>Pending</button>
                                @elseif ($order->status == 1)
                                    <button class="btn btn-outline-success" disabled>Success</button>
                                @elseif ($order->status == 2)
                                    <button class="btn btn-outline-danger" disabled>Reject</button>
                                @else
                                    <button class="btn btn-outline-danger" disabled>Reject</button>
                                @endif
                            </td>
                            <td> <button class="btn cancelOrder"><i class="fa-solid fa-xmark"></i> Cancel</button> </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="">
                {{ $orders->links() }}
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

    @include('user.js')
</body>
<script>
    $(document).ready(function() {
        $('.cancelOrder').click(function() {
            $parentNode = $(this).parents('tr');
            $orderCode = Number($parentNode.find('td a').text());

            $.ajax({
                type: 'get',
                url: '/user/ajax/order/cancel',
                data: {
                    'order_code': $orderCode
                },
                dataType: 'json',
                success: function(response) {
                    if (response.msg == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Cancelled Successfully',
                            text: 'Your order is cancelled successfully.'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                }
            });
        })
    })
</script>

</html>
