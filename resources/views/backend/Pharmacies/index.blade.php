@extends('layout.master')
@section('content')
<div class="row bg-primary text-white p-2 text-center rounded-sm">
    <div class="col">

        <h3 class="">All Pharmacies</h3>
    </div>
    <div class="col">
        <a href="{{route('pharmacy.create')}}" class="btn btn-success">Create Pharmacy</a>
    </div>
</div>    
    <hr>
    <table id="datatable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
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
                ajax: "{{ route('pharmacies.datatable') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'pharmacy name'
                    },
                    {
                        data: 'address',
                        name: 'pharmacy address'
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
