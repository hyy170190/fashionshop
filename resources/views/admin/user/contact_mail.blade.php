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

        <div class="container d-flex justify-content-center">
            <div class="col-md-8 grid-margin stretch-card" style="margin-top: 110px">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Send email to <span class="text-primary text-lowercase">{{ $contact->email }}</span></h4>
                        <form class="forms-sample mt-5" action="{{ route('contact_email_send',$contact->id) }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email Greeding</label>
                                <div class="col-sm-9">
                                    <input type="text" name="greeting" class="form-control text-white my-2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email FirstLine</label>
                                <div class="col-sm-9">
                                    <input type="text" name="firstline" class="form-control text-white my-2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email Body</label>
                                <div class="col-sm-9">
                                    <input type="text" name="body" class="form-control text-white my-2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email Button Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="button" class="form-control text-white my-2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email Url</label>
                                <div class="col-sm-9">
                                    <input type="text" name="url" class="form-control text-white my-2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email LastLine</label>
                                <div class="col-sm-9">
                                    <input type="text" name="lastline" class="form-control text-white my-2">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Send</button>
                            <a href="{{ route('admin#userContact') }}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- plugins:js -->
        @include('admin.js')
</body>

</html>
