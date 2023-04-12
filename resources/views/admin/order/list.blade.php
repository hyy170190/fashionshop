<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.navbar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card-body">
                    <div class="row">
                        <h4 class="card-title col-3">Order List</h4>
                        <form class="d-none d-lg-flex search col-4 offset-3" action="#" method="get">
                            @csrf
                            <input type="text" name="key" class="form-control text-white"
                                placeholder="Search orders" value="">
                            <button class="btn btn-icon" type="submit"><i class="mdi mdi-magnify icon-md"></i></button>
                        </form>
                    </div>

                </div>
                <div class="row ">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Order Status</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> Deliever </th>
                                                <th> Client Name </th>
                                                <th> Order No </th>
                                                <th> Product Cost </th>
                                                <th> Billing Details </th>
                                                <th> Start Date </th>
                                                <th> StatusChange </th>
                                                <th> Order Status </th>
                                                <th> Send Email </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-muted m-0">
                                                            <label class="form-check-label">
                                                                @if ($order->deliever == 0)
                                                                <input type="checkbox" class="form-check-input deliever_checkbox">
                                                                @else
                                                                <input type="checkbox" class="form-check-input deliever_checkbox" checked>
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($order->user->image == null)
                                                            <img src="{{ asset('images/default_user.png') }}"
                                                                alt="image" />
                                                        @else
                                                            <img src="{{ asset('storage/profile_img/' . $order->user->image) }}"
                                                                alt="image" />
                                                        @endif
                                                        <span class="pl-2">{{ $order->user->name }}</span>
                                                    </td>
                                                    <td> {{ $order->order_code }} </td>
                                                    <td> $ {{ $order->total_price }} </td>
                                                    <td> <a
                                                            href="{{ route('order#details', $order->order_code) }}">Click</a>
                                                    </td>
                                                    <td> {{ $order->created_at->format('j-M-Y') }} </td>
                                                    <td>
                                                        <select class="form-control h-25 col-7 text-white statusChange">
                                                            <option value="0"
                                                                @if ($order->status == 0) selected @endif>P
                                                            </option>
                                                            <option value="1"
                                                                @if ($order->status == 1) selected @endif>A
                                                            </option>
                                                            <option value="2"
                                                                @if ($order->status == 2) selected @endif>R
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <input type="hidden" id="orderId" value="{{ $order->id }}">
                                                    <td>
                                                        @if ($order->status == 0)
                                                            <div class="badge badge-outline-warning">Pending</div>
                                                        @elseif ($order->status == 1)
                                                            <div class="badge badge-outline-success">Approved</div>
                                                        @elseif ($order->status == 2)
                                                            <div class="badge badge-outline-danger">Rejected</div>
                                                        @else
                                                            <div class="badge badge-outline-danger">Rejected</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin#email', $order->id) }}"
                                                            class="btn btn-info">Send Email</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mr-3">
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.js')
</body>
<script>
    $(document).ready(function() {
        $('.statusChange').change(function() {
            $currentStatus = $(this).val();
            $parentNode = $(this).parents('tr');
            $orderId = $parentNode.find('#orderId').val();

            $data = {
                'status': $currentStatus,
                'orderId': $orderId
            };

            $.ajax({
                type: 'get',
                url: '/admin/order/status/change',
                data: $data,
                dataType: 'json',
                success: function(response) {
                    if (response.msg == 'success') {
                        location.reload();
                    }
                }
            })
        });

        $('.deliever_checkbox').click(function(){
            event.preventDefault();
            $parentNode = $(this).parents('tr');
            $orderId = $parentNode.find('#orderId').val();

            if (this.checked)
            {
                $.ajax({
                    type : 'get',
                    url : '/admin/ajax/order/deliever',
                    data : {
                        'status' : 1,
                        'orderId' : $orderId
                    },
                    dataType : 'json',
                    success : function(response){
                        if (response.msg == 'success'){
                            location.reload();
                        }
                    }
                })
            }
            else
            {
                $.ajax({
                    type : 'get',
                    url : '/admin/ajax/order/deliever',
                    data : {
                        'status' : 0,
                        'orderId' : $orderId
                    },
                    dataType : 'json',
                    success : function(response){
                        if (response.msg == 'success'){
                            location.reload();
                        }
                    }
                })
            }
        })
    })
</script>

</html>
