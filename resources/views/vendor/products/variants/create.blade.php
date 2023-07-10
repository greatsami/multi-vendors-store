@extends('vendor.layouts.master')
@section('content')

    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Products</h3>
                        <div class="create_button">
                            <a href="{{ route('vendor.product-variants.index') }}" class="btn btn-primary">Back</a>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.product-variants.store') }}" method="post">
                                    @csrf
                                    <div class="form-group wsus__input">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" />
                                        <input type="hidden" name="product_id" value="{{ old('product_id', request('product')) }}" class="form-control" />
                                    </div>

                                    <div class="form-group wsus__input">
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
        </div>
    </section>

@endsection

