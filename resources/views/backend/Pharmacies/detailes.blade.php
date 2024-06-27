@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">

                    <h3><span class="bg-info">Pharmacy Name :</span>{{$pharmacy->name}}</h3>
            </div>
            <div class="row">
                <div class="col">

                    <h3><span class="bg-info">Pharmacy Address :</span>{{$pharmacy->address}}</h3>
            </div>
        </div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <td>Product Title</td>
                <td>Product Description</td>
                <td>Product Quantity</td>
                <td>Product Price</td>
            </thead>
            <tbody>
                @foreach($pharmacy->products as $product)
                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->pivot->quantity}}</td>
                    <td>{{$product->pivot->price}}</td>
                </tr>
                @endforeach
</tbody>
        </table>
      </div>
    </div>
@endsection
@push('js')
    
@endpush
