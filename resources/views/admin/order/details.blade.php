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
                        <h4 class="card-title col-3">Billing Details</h4>
                        @if ($id == 'null')
                            <form class="d-none d-lg-flex search col-4 offset-3" action="#" method="get">
                                @csrf
                                <input type="text" name="key" class="form-control text-white"
                                    placeholder="Search" value="{{ request('key') }}">
                                <button class="btn btn-icon" type="submit"><i
                                        class="mdi mdi-magnify icon-md"></i></button>
                            </form>
                        @endif
                    </div>
                    <div class="col-lg-12 grid-margin stretch-card mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        @if (count($details) == null)
                                            <tr>
                                                <h3 class="text-danger">There is no data</h3>
                                            </tr>
                                        @else
                                            <h4 class="card-title">Order billing details</h4>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        @if ($id !== 'null')
                                            <a href="{{ route('order#list') }}"><button
                                                    class="btn-sm btn-dark col-2 offset-10">Back</button></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-primary"> ID </th>
                                                <th class="text-primary"> Order Code </th>
                                                <th class="text-primary"> Full name </th>
                                                <th class="text-primary"> Phone </th>
                                                <th class="text-primary"> Email </th>
                                                <th class="text-primary"> Address </th>
                                                <th class="text-primary"> City </th>
                                                <th class="text-primary"> State </th>
                                                <th class="text-primary"> Country </th>
                                                <th class="text-primary"> Notes </th>
                                                <th class="text-primary"> Start Date </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($details as $d)
                                                <tr>
                                                    <td> {{ $d->id }} </td>
                                                    <td> {{ $d->order_code }} </td>
                                                    <td> {{ $d->first_name . ' ' . $d->last_name }} </td>
                                                    <td> {{ $d->phone }} </td>
                                                    <td> {{ $d->email }} </td>
                                                    <td> {{ $d->address1 . ', ' . $d->address2 }} </td>
                                                    <td> {{ $d->city }} </td>
                                                    <td> {{ $d->state }} </td>
                                                    <td> {{ $d->country }} </td>
                                                    <td> {{ $d->notes }} </td>
                                                    <td> {{ $d->created_at->format('j-M-Y') }} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mr-3">
                                {{ $details->links() }}
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

</html>
