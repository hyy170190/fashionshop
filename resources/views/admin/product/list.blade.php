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
                        <h4 class="card-title col-3">Product List</h4>
                        <form class="d-none d-lg-flex search col-4 offset-3" action="{{ route('product#list') }}" method="get">
                            @csrf
                            <input type="text" name="key" class="form-control text-white" placeholder="Search products" value="{{ request('key') }}">
                            <button class="btn btn-icon" type="submit"><i class="mdi mdi-magnify icon-md"></i></button>
                        </form>
                        <a href="{{ route('product#createPage') }}" class="col-2"><button
                                class="btn btn-outline-linkedin">+ Add Product</button></a>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price($)</th>
                                    <th>Size</th>
                                    <th>Category</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product['id'] }}</td>
                                        <td>{{ $product['name'] }}</td>
                                        <td>{{ $product['price'] }}</td>
                                        <td>{{ $product['size'] }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->created_at->format('j-M-Y') }}</td>
                                        <td>{{ $product->updated_at->format('j-M-Y') }}</td>
                                        <td>
                                            <div>
                                                <a href="{{ route('product#editPage', $product->id) }}">
                                                    <button class="btn" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <form class="d-inline" action="{{ route('product#delete',$product->id) }}" method="POST">
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
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.js')
</body>

</html>
