@extends('layouts.auth')
<style>
    .container {
        float:right;
        width: 90%;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-30">
            <div class="card">
                <div class="card-header">{{__('Invoices')}}</div>
                <div class="card-body" id="InvoiceList"></div>
            </div>
        </div>
    </div>
</div>
@endsection