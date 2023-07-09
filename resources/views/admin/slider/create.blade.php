@extends('admin.layouts.master')
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Sliders</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sliders.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="banner">Banner</label>
                                    <input type="file" name="banner"  class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" name="type" value="{{ old('type') }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="starting_price">Starting Price</label>
                                    <input type="text" name="starting_price" value="{{ old('starting_price') }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="btn_url">Button Url</label>
                                    <input type="text" name="btn_url" value="{{ old('btn_url') }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="serial">Serial</label>
                                    <input type="text" name="serial" value="{{ old('serial') }}" class="form-control" />
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
