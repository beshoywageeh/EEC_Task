@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3>Create Pharmacy</h3>
            </div>
        </div>
        <form action="{{ route('pharmacy.store') }}" method="post">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" name="name" class="form-control" id="title"
                                placeholder="Enter Name" value="{{ old('title') }}">
                        </div>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col">
                        <div class="form-group">
                            <label for="address">address</label>
                            <textarea name="address" id="" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#pharmacy').select2({
                ajax: {
                    url: '{{ route('pharm_search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term // search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for an item',
                minimumInputLength: 1,
            });
        });
    </script>
@endpush
