<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Male-Fashion | Template</title>

    {{-- CSS --}}
    @include('user.css')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            @if (Route::has('login'))
                @auth
                    <form class="" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn text-dark" type="submit">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">
                        <button class="btn text-dark">Log in</button>
                    </a>
                    <a href="{{ route('register') }}">
                        <button class="btn text-dark">Sign up</button>
                    </a>
                @endauth
            @endif
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="{{ asset('user/img/icon/search.png') }}"
                    alt=""></a>
            <a href="#"><img src="{{ asset('img/icon/heart.png') }}" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p class="mt-2">Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                @if (Route::has('login'))
                                    @auth
                                        <form class="d-inline" action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button class="btn text-white" type="submit">Log out</button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}">
                                            <button class="btn text-white">Log in</button>
                                        </a>
                                        <a href="{{ route('register') }}">
                                            <button class="btn text-white">Sign up</button>
                                        </a>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form class="forms-sample" action="{{ route('user#update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-3 mt-5 ml-5">
                    <a href="{{ route('home') }}" class="btn btn-dark"><i class="fa-solid fa-arrow-left mr-2"></i>Back</a>
                </div>
                @if (session('notMatch'))
                    <div class="col-5  mt-5">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-triangle-exclamation"></i> {{ session('notMatch') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
            <div class="container d-flex align-items-center" style="height: 700px">
                <div class="col-3">
                    @if (Auth::user()->image == null)
                        <img class=" img-thumbnail rounded-sm" src="{{ asset('images/default_user.png') }}"
                            alt="default_user">
                    @else
                        <img class=" img-thumbnail rounded-sm"
                            src="{{ asset('storage/profile_img/' . Auth::user()->image) }}" alt="">
                    @endif
                    <div class="mt-3">
                        <input type="file" name="image" accept="image/*" class="form-control">
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title text-center mb-4">User Information</h2>
                            <div class="form-group row">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="exampleInputUsername2" value="{{ old('name', $data->name) }}">
                                    @error('name')
                                        <div class=" invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="exampleInputEmail2" value="{{ old('email', $data->email) }}">
                                    @error('email')
                                        <div class=" invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        id="exampleInputMobile" value="{{ old('phone', $data->phone) }}">
                                    @error('phone')
                                        <div class=" invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputAddress2" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        id="exampleInputAddress2" value="{{ old('address', $data->address) }}">
                                    @error('address')
                                        <div class=" invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputConfirmGender2" class="col-sm-3 col-form-label">Gender</label>
                                <div class="col-sm-9">
                                    <select name="gender"
                                        class="form-control w-100 @error('gender') is-invalid @enderror">
                                        <option value="" disabled>Choose</option>
                                        <option value="male" @if ($data->gender == 'male') selected @endif>Male
                                        </option>
                                        <option value="female" @if ($data->gender == 'female') selected @endif>Female
                                        </option>
                                        <option value="other" @if ($data->gender == 'other') selected @endif>Other
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class=" invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 mt-3">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="container">
            <div class="col-lg-6 offset-lg-3 mb-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-5">Change Account Password</h3>
                        <form class="forms-sample" action="{{ route('user#changePassword') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="exampleInputOldPassword2" class="col-sm-4 col-form-label">Old
                                    Password</label>
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
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-4 col-form-label">New
                                    Password</label>
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
                            <button type="submit" class="btn btn-primary mr-2 mt-3" id="pwChangeBtn">Change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @include('user.footer')

        <!-- Js Plugins -->
        @include('user.js')

</body>

</html>
