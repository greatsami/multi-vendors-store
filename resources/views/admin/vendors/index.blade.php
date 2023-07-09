@extends('admin.layouts.master')
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Vendors</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Vendor</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.vendors.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Preview</label><br>
                                    <img src="{{ asset('uploads/'.$profile->banner) }}" width="100">
                                </div>

                                <div class="form-group">
                                    <label for="banner">Banner</label>
                                    <input type="file" name="banner" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="shop_name">Shop Name</label>
                                    <input type="text" name="shop_name" value="{{ old('shop_name', $profile->shop_name) }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="{{ old('email', $profile->email) }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" value="{{ old('address', $profile->address) }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control summernote">{!! old('description', $profile->description) !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" name="facebook" value="{{ old('facebook', $profile->facebook_link) }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" name="twitter" value="{{ old('twitter', $profile->twitter_link) }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" name="instagram" value="{{ old('instagram', $profile->instagram_link) }}" class="form-control" />
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
