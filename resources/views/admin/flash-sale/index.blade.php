@extends('admin.layouts.master')
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Flash Sale</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Flash Sale End date</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.update') }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="offer_start_date">Offer Start Date</label>
                                        <input type="text" name="end_date" value="{{ old('end_date', @$flashSale->end_date) }}" class="form-control datepicker" />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Flash Sale Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.add-products') }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="offer_start_date">Add Flash Sale Products</label>
                                    <select name="product" class="form-control select2">
                                        <option value="">Select</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1" @selected(old('status') == '1')>Active</option>
                                                <option value="0" @selected(old('status') == '0')>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="show_at_home">Show at home?</label>
                                            <select name="show_at_home" class="form-control">
                                                <option value="1" @selected(old('show_at_home') == '1')>Yes</option>
                                                <option value="0" @selected(old('show_at_home') == '0')>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Flash Sale</h4>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(function () {
            $('body').on('click', '.change-status', function () {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: '{{ route('admin.flash-sale.status-change') }}',
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id,
                    },
                    success: function (data) {
                        toastr.success(data.message);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            });

            $('body').on('click', '.change-show-at-home', function () {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: '{{ route('admin.flash-sale.show-at-home.status-change') }}',
                    method: 'PUT',
                    data: {
                        show_at_home: isChecked,
                        id: id,
                    },
                    success: function (data) {
                        toastr.success(data.message);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            });

        })
    </script>
@endpush
