@extends('vendor.layouts.master')
@section('content')

    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Shop profile</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                <form action="{{ route('vendor.shop-profile.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group wsus__input">
                                        <label>Preview</label><br>
                                        <img src="{{ asset('uploads/'.$profile->banner) }}" width="100">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="banner">Banner</label>
                                        <input type="file" name="banner" class="form-control" />
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="shop_name">Shop Name</label>
                                        <input type="text" name="shop_name" value="{{ old('phone', $profile->shop_name) }}" class="form-control" />
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="form-control" />
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" value="{{ old('email', $profile->email) }}" class="form-control" />
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" value="{{ old('address', $profile->address) }}" class="form-control" />
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control summernote">{!! old('description', $profile->description) !!}</textarea>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" name="facebook" value="{{ old('facebook', $profile->facebook_link) }}" class="form-control" />
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" name="twitter" value="{{ old('twitter', $profile->twitter_link) }}" class="form-control" />
                                    </div>

                                    <div class="form-group wsus__input">
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
        </div>
    </section>

@endsection
