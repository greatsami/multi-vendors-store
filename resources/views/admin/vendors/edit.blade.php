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
                            <h4>Edit Vendor</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.vendors.update', $vendor->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Preview</label><br>
                                    <img src="{{ asset('uploads/logos/'.$vendor->logo) }}" width="200" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ old('name', $vendor->name) }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" name="logo" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="status">Is Featured</label>
                                    <select name="is_featured" class="form-control">
                                        <option>Select</option>
                                        <option value="1" @selected(old('is_featured', $vendor->is_featured) == '1')>Yes</option>
                                        <option value="0" @selected(old('is_featured', $vendor->is_featured) == '0')>No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" @selected(old('status', $vendor->status) == '1')>Active</option>
                                        <option value="0" @selected(old('status', $vendor->status) == '0')>Inactive</option>
                                    </select>
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
