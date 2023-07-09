@extends('admin.layouts.master')
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Product {{ $productVariant->product->name }} Variant</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create {{ $productVariant->product->name }} Variant</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product-variants.update', $productVariant->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ old('name', $productVariant->name) }}" class="form-control" />
                                    <input type="hidden" name="product_id" value="{{ old('product_id', request('product', $productVariant->id)) }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" @selected(old('status', $productVariant->status) == '1')>Active</option>
                                        <option value="0" @selected(old('status', $productVariant->status) == '0')>Inactive</option>
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
