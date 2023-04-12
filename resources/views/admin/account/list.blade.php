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
                        <h4 class="card-title col-3">Admin List</h4>
                        <form class="d-none d-lg-flex search col-4 offset-3" action="{{ route('admin#list') }}"
                            method="get">
                            @csrf
                            <input type="text" name="key" class="form-control text-white"
                                placeholder="Search accounts" value="{{ request('key') }}">
                            <button class="btn btn-icon" type="submit"><i class="mdi mdi-magnify icon-md"></i></button>
                        </form>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $account->id }}</td>
                                        <td>
                                            @if ($account->image == null)
                                                <img src="{{ asset('images/default_user.png') }}" class="shadow-sm">
                                            @else
                                                <img src="{{ asset('storage/profile_img/' . $account->image) }}"
                                                    class="shadow-sm" />
                                            @endif
                                        </td>
                                        <td>{{ $account->name }}</td>
                                        <td>{{ $account->email }}</td>
                                        <td>{{ $account->phone }}</td>
                                        <td>{{ $account->address }}</td>
                                        <td>{{ $account->gender }}</td>
                                        <td>
                                            <input type="hidden" name="userId" class="userId" value="{{ $account->id }}">
                                            <select class="form-select bg-dark text-white roleChange" name="" id="">
                                                <option value="admin" selected>Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </td>
                                        <td>
                                            @if (Auth::user()->id != $account->id)
                                                <div>
                                                    <form class="d-inline" action="{{ route('admin#delete', $account->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn" title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.js')
</body>
<script>
    $('.roleChange').change(function() {
        console.log('success');
        $currentRole = $(this).val();
        $parentNode = $(this).parents('tr');
        $userId = $parentNode.find('.userId').val();

        $data = {
            'role': $currentRole,
            'userId': $userId
        };

        $.ajax({
            type: 'get',
            url: 'http://localhost:8000/admin/role/change',
            data: $data,
            dataType: 'json',
        })
        location.reload();
    })
</script>

</html>
