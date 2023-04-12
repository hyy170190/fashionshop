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
                        <h4 class="card-title col-6">Category List</h4>
                        <a href="{{ route('category#createPage') }}" class="col-2 offset-4"><button
                                class="btn btn-outline-linkedin">+ Add Category</button></a>
                    </div>
                    </p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category['id'] }}</td>
                                        <td>{{ $category['name'] }}</td>
                                        <td>{{ $category->created_at->format('j-M-Y') }}</td>
                                        <td>{{ $category->updated_at->format('j-M-Y') }}</td>
                                        <td>
                                            <div>
                                                <a href="{{ route('category#editPage', $category['id']) }}">
                                                    <button class="btn" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <form class="d-inline" action="{{ route('category#delete', $category['id']) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn" title="Delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mr-3">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.js')
</body>

</html>
