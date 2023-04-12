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
                        <h4 class="card-title col-3">User Reviews</h4>
                        <form class="d-none d-lg-flex search col-4 offset-3" action="#" method="get">
                            @csrf
                            <input type="text" name="key" class="form-control text-white"
                                placeholder="Search reviews" value="{{ request('key') }}">
                            <button class="btn btn-icon" type="submit"><i class="mdi mdi-magnify icon-md"></i></button>
                        </form>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Reviews</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th> Client Name </th>
                                                    <th> Email </th>
                                                    <th> Message </th>
                                                    <th> Reply </th>
                                                    <th> Date </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($contacts as $contact)
                                                    <tr>
                                                        <td> {{ $contact->name }} </td>
                                                        <td> {{ $contact->email }} </td>
                                                        <td class="col-4">
                                                            <textarea class="form-control bg-dark text-white" id="" cols="10" rows="5" disabled>{{ $contact->message }}</textarea>
                                                        </td>
                                                        <td><a href="{{ route('contact#emailPage',$contact->id) }}">Click</a></td>
                                                        <td> {{ $contact->created_at->format('j-M-Y') }} </td>
                                                        <td>
                                                            <form class="d-inline"
                                                                action="{{ route('contact#delete', $contact->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn" title="Delete">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mr-3">
                                    {{ $contacts->links() }}
                                </div>
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
