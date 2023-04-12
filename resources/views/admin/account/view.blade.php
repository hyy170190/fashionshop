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

        <div class="col-8 grid-margin stretch-card mt-5">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center my-4">Admin Account Info</h1>
                    <form action="{{ route('admin#update', $data['id']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" name="name" class="form-control text-white @error('name') is-invalid @enderror" id="exampleInputName1"
                                value="{{ $data['name'] }}">
                            @error('name')
                                <div class=" invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Email address</label>
                            <input type="email" name="email" class="form-control text-white @error('email') is-invalid @enderror" id="exampleInputEmail3"
                                value="{{ $data['email'] }}">
                            @error('email')
                                <div class=" invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">Phone Number</label>
                            <input type="text" name="phone" class="form-control text-white @error('phone') is-invalid @enderror" id="exampleInputPhone4"
                                value="{{ $data['phone'] }}">
                            @error('phone')
                                <div class=" invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectGender">Gender</label>
                            <select class="form-control text-white" name="gender" id="exampleSelectGender">
                                <option value="male" @if ($data['gender'] == 'male') selected @endif>Male</option>
                                <option value="female" @if ($data['gender'] == 'female') selected @endif>Female</option>
                                <option value="other" @if ($data['gender'] == 'other') selected @endif>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity1">Address</label>
                            <input type="text" name="address" class="form-control text-white @error('address') is-invalid @enderror" id="exampleInputCity1"
                                value="{{ $data['address'] }}">
                            @error('address')
                                <div class=" invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <div style='height: 0px;width:0px; overflow:hidden;'><input id="upfile"
                                        type="file" name="image" accept="image/*" value="upload" /></div>
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button"
                                        onclick="getFile()">Upload</button>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4 d-flex justify-content-center align-items-center">
            @if ($data['image'] == null)
                <img src="{{ asset('images/default_user.png') }}" class="img-thumbnail shadow-sm w-full h-25">
            @else
                <img src="{{ asset('storage/profile_img/' . $data['image']) }}" class="img-thumbnail shadow-sm w-full h-25" />
            @endif
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.js')
</body>
<script>
    function getFile() {
        document.getElementById("upfile").click();
    }
</script>

</html>
