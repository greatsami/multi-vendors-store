@extends('admin.layouts.master')
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Products</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="banner">Image</label>
                                    <input type="file" name="image"  class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" />
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select name="category" class="form-control main-category">
                                                <option value="">Select</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" @selected(old('category') == $category->id)>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_category">Sub Category</label>
                                            <select name="sub_category" class="form-control sub-category">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="child_category">Child Category</label>
                                            <select name="child_category" class="form-control child-category">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <select name="brand" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" @selected(old('brand') == $brand->id)>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="sku">SKU</label>
                                    <input type="text" name="sku" value="{{ old('sku') }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" value="{{ old('price') }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="offer_price">Offer Price</label>
                                    <input type="text" name="offer_price" value="{{ old('offer_price') }}" class="form-control" />
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="offer_start_date">Offer Start Date</label>
                                            <input type="text" name="offer_start_date" value="{{ old('offer_start_date') }}" class="form-control datepicker" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="offer_end_date">Offer End Date</label>
                                            <input type="text" name="offer_end_date" value="{{ old('offer_end_date') }}" class="form-control datepicker" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="qty">Stock Quantity</label>
                                    <input type="number" name="qty" min="0" value="{{ old('qty') }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="video_link">Video Link</label>
                                    <input type="text" name="video_link" value="{{ old('video_link') }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <textarea name="short_description" class="form-control">{!! old('short_description') !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="long_description">Full Description</label>
                                    <textarea name="long_description" class="form-control summernote">{!! old('long_description') !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="product_type">Product Type</label>
                                    <select name="product_type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="new_arrival" @selected(old('product_type') == 'new_arrival')>New Arrival</option>
                                        <option value="featured_product" @selected(old('product_type') == 'featured_product')>Featured</option>
                                        <option value="top_product" @selected(old('roduct_type') == 'top_product')>Top Product</option>
                                        <option value="best_product" @selected(old('product_type') == 'best_product')>Best Product</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="seo_title">SEO Title</label>
                                    <input type="text" name="seo_title" value="{{ old('seo_title') }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="seo_description">SEO Description</label>
                                    <textarea name="seo_description" class="form-control">{!! old('seo_description') !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" @selected(old('status') == '1')>Active</option>
                                        <option value="0" @selected(old('status') == '0')>Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        $(function () {
            $('body').on('change', '.main-category', function (e){
                let id = $(this).val();
                $.ajax({
                    url: '{{ route('admin.products.get-sub-categories') }}',
                    method: 'get',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $('.sub-category').html('<option value="">Select Sub Category</option>');
                        $('.child-category').html('<option value="">Select Child Category</option>');
                        $.each(data, function (i, item) {
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`);
                        })
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                })
            })

            $('body').on('change', '.sub-category', function (e){
                let id = $(this).val();
                $.ajax({
                    url: '{{ route('admin.products.get-child-categories') }}',
                    method: 'get',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $('.child-category').html('<option value="">Select Child Category</option>');
                        $.each(data, function (i, item) {
                            $('.child-category').append(`<option value="${item.id}">${item.name}</option>`);
                        })
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                })
            })
        })
    </script>
@endpush
