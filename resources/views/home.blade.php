@extends(Auth::user()->can('isAdmin') ? 'layouts.auth' : 'layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::user()->can('isAdmin'))
                        <h3>{{ __('Admin Dashboard') }}</h3>
                        <p>{{ __('Welcome back, Admin!') }}</p>
                        <p>{{ __('You can manage products, orders, and users from here.') }}</p>
                        <a href="{{ route('admin.invoicelist') }}" class="btn btn-primary">{{ __('Manage Orders') }}</a>
                        <a href="{{ route('admin.list') }}" class="btn btn-primary">{{ __('Manage Products') }}</a>
                    @else
                        <h3>{{ __('User Dashboard') }}</h3>
                        <p>{{ __('Welcome back,') }} {{ Auth::user()->name }}!</p>
                        <p>{{ __('Check out our latest products and discounts.') }}</p>
                        <a href="{{ route('product') }}" class="btn btn-primary">{{ __('View Products') }}</a>
                        <a href="{{ route('product.order') }}" class="btn btn-primary">{{ __('View Orders') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection