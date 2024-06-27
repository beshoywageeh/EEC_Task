@extends('layout.master')
@section('content')
<div class="bg-primary text-white p-2 text-center rounded-sm">
    <div class="row">
        <div class="col">
            <h3 >All Products</h3>
        </div>
        <div class="col">
            <a href="{{ route('product.create') }}" class="btn btn-success">Create Product</a>
        </div>
    </div>

</div>
    <hr>
    <table id="datatable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
@push('js')
    <script type="text/javascript">
        $(function() {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.datatable') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'image',
                        name: 'proudct image'
                    },
                    {
                        data: 'title',
                        name: 'product title'
                    },
                    {
                        data: 'description',
                        name: 'product description'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });


</script>
@endpush
