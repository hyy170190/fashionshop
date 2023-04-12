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

        <div class="col-md-6 offset-md-3 grid-margin stretch-card d-flex align-items-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center mb-5">Change Account Password</h1>
                    <form class="forms-sample" action="{{ route('admin#changePassword') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputOldPassword2" class="col-sm-4 col-form-label">Old Password</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <input type="password" name="oldPassword"
                                    class="form-control @error('oldPassword') is-invalid @enderror"
                                    id="exampleInputOldPassword2">
                                @error('oldPassword')
                                    <div class=" invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @if (session('notMatch'))
                                    <span class="text-danger text-small">{{ session('notMatch') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                                <input type="password" name="newPassword"
                                    class="form-control @error('newPassword') is-invalid @enderror"
                                    id="exampleInputPassword2">
                                @error('newPassword')
                                    <div class=" invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-4 col-form-label">Confirm
                                Password</label>
                            <div class="col-sm-8">
                                <input type="password" name="confirmPassword"
                                    class="form-control @error('confirmPassword') is-invalid @enderror"
                                    id="exampleInputConfirmPassword2">
                                @error('confirmPassword')
                                    <div class=" invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2 mt-3">Confirm</button>
                        <a href="{{ route('admin#dashboard') }}" class="btn btn-dark mt-3">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.js')
</body>

</html>
