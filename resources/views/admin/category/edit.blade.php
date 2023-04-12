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
            <div class="content-wrapper d-flex justify-content-center align-items-center">
                <div class="">
                    <h1 class="mb-5">Edit Category</h1>
                    <form class="row" action="{{ route('category#edit', $data['id']) }}" method="POST">
                        @csrf
                        <div class="col-auto">
                            <input type="text" name="name" class="form-control text-white @error('name') is-invalid @enderror" value="{{ $data['name'] }}">
                        </div>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mt-1">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.js')
</body>

</html>
