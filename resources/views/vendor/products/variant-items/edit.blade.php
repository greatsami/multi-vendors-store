@extends('vendor.layouts.master')
@section('content')

    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Edit Product {{ $productVariantItem->productVariant->product->name }} {{ $productVariantItem->name }} Variant Items</h3>
                        <div class="create_button">
                            <a href="{{ route('vendor.product-variants.index') }}" class="btn btn-primary">Back</a>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                <form action="{{ route('vendor.product-variant-items.update', $productVariantItem->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group wsus__input">
                                        <label for="variant_name">Variant Name</label>
                                        <input type="text" name="variant_name" value="{{ old('variant_name', $productVariantItem->productVariant->name) }}" readonly class="form-control" />
                                        <input type="hidden" name="variant_id" value="{{ old('variant_id', $productVariantItem->productVariant->id) }}" class="form-control" />
                                        <input type="hidden" name="product_id" value="{{ old('product_id', $productVariantItem->productVariant->product->id) }}" class="form-control" />
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="name">Item Name</label>
                                        <input type="text" name="name" value="{{ old('name', $productVariantItem->name) }}" class="form-control" />
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="price">Item Price (<code>Set 0 for make it free</code>)</label>
                                        <input type="number" min="0" name="price" value="{{ old('price', $productVariantItem->price) }}" class="form-control" />
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="is_default">Is Default</label>
                                        <select name="is_default" class="form-control">
                                            <option>Select</option>
                                            <option value="1" @selected(old('is_default', $productVariantItem->is_default) == '1')>Yes</option>
                                            <option value="0" @selected(old('is_default', $productVariantItem->is_default) == '0')>No</option>
                                        </select>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" @selected(old('status', $productVariantItem->status) == '1')>Active</option>
                                            <option value="0" @selected(old('status', $productVariantItem->status) == '0')>Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>

                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

