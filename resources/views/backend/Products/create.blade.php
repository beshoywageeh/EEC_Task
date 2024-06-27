@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3>Create Product</h3>

            </div>

        </div>
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title"
                                placeholder="Enter Title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="pharmacy">Pharmacy</label>
                            <select class="form-control select2" name="pharmacy" id="pharmacy">

                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control" id="price"
                                placeholder="Enter Price" value="{{ old('price') }}">
                        </div>

                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="quantity">quantity</label>
                            <input type="text" name="quantity" class="form-control" id="quantity"
                                placeholder="Enter quantity" value="{{ old('quantity') }}">
                        </div>

                    </div>
                </div>

                <div class="row my-4">
                    <div class="col">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="hidden" name="old_image" value="">
                        <input type="file" name="image" id="" accept="image/*" class="form-control-file">
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
