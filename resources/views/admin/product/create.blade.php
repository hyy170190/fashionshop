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
        <div class="col-md-6 offset-3 grid-margin stretch-card d-flex align-items-center">
            <div class="card mt-4">
                <div class="card-body">
                    <h1 class="card-title text-center">Add Product</h1>
                    <form class="forms-sample" action="{{ route('product#create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="productName" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control text-white @error('name') is-invalid @enderror" id="productName"
                                    placeholder="Name">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="productDescription" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <input type="text" name="description" class="form-control text-white @error('description') is-invalid @enderror" id="productDescription"
                                    placeholder="Description">
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="productPrice" class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input type="number" step=".01" name="price" class="form-control text-white @error('price') is-invalid @enderror" id="productPrice"
                                    placeholder="Price">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="productSize" class="col-sm-3 col-form-label">Size</label>
                            <div class="col-sm-9">
                                <input type="text" name="size" class="form-control text-white @error('size') is-invalid @enderror" id="productSize"
                                    placeholder="Size">
                                    @error('size')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9    ">
                                <select class="form-control text-white @error('category') is-invalid @enderror" name="category" id="category">
                                    <option value="">Choose category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="productImage" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror" id="productImage"
                                    placeholder="Price">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Add</button>
                        <a href="{{ route('product#list') }}" class="btn btn-dark mr-2">Back</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.js')
</body>

</html>
