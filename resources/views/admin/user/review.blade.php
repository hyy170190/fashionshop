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
                                                    <th> ID </th>
                                                    <th> Client </th>
                                                    <th> Product </th>
                                                    <th> Review </th>
                                                    <th> Date </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($reviews as $review)
                                                    <tr>
                                                        <td>{{ $review->id }}</td>
                                                        <td>
                                                            @if ($review->user->image == null)
                                                                <img src="{{ asset('images/default_user.png') }}"
                                                                    alt="default_user">
                                                            @else
                                                                <img src="{{ asset('storage/profile_img/' . $review->user->image) }}"
                                                                    alt="user_img">
                                                            @endif
                                                            <span class="ml-2"> {{ $review->user->name }} </span>
                                                        </td>
                                                        <td>
                                                            <img src="{{ asset('/storage/product_img/' . $review->product->image) }}"
                                                                alt="product">
                                                            <span class="ml-2"> {{ $review->product->name }} </span>
                                                        </td>
                                                        <td class="col-4">
                                                            <textarea class="form-control text-white" id="" cols="10" rows="5">{{ $review->review }}</textarea>
                                                        </td>
                                                        <td> {{ $review->created_at->format('j-M-Y') }} </td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-danger btn-rounded btn-icon text-center">
                                                                <i class="mdi mdi-block-helper"></i>
                                                            </button>
                                                        </td>
                                                        <input type="hidden" class="id" name="id" value="{{ $review->id }}">
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mr-3">
                                    {{ $reviews->links() }}
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
<script>
    $(document).ready(function(){
        $('.btn-danger').click(function(){

            $parentNode = $(this).parents('tr');
            $id = $parentNode.find('.id').val();

            $.ajax({
                type : 'get',
                url : '/admin/user/review/delete',
                data : {
                    'id' :any $id
                },
                dataType : 'json',
                success : function(response){
                    if(response.msg == 'success')
                    {
                        location.reload();
                    }
                }
            })
        })
    })
</script>
</html>
