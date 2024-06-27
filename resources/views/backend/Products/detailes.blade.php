@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">

                    <h3><span class="bg-info">Product Name :</span>{{$product->title}}</h3>
            </div>
            <div class="row">
                <div class="col">

                    <h3><span class="bg-info">Product Description :</span>{{$product->description}}</h3>
            </div>
        </div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <td>Pharmacy Name</td>
                <td>Pharmacy Address</td>
                <td>Product Quantity</td>
                <td>Product Price</td>
            </thead>
            <tbody>
                @foreach($product->pharmacies as $pharmacy)
                <tr>
                    <td>{{$pharmacy->name}}</td>
                    <td>{{$pharmacy->address}}</td>
                    <td>{{$pharmacy->pivot->quantity}}</td>
                    <td>{{$pharmacy->pivot->price}}</td>
                </tr>
                @endforeach
</tbody>
        </table>
      </div>
    </div>
@endsection
@push('js')
    
@endpush
