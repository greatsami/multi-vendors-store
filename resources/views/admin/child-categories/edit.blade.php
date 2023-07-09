@extends('admin.layouts.master')
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Child Categories</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Child Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.child-categories.update', $childCategory->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ old('name', $childCategory->name) }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category" class="form-control main-category">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @selected(old('category',$category->id) == $childCategory->category_id)>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="sub_category">Sub Category</label>
                                    <select name="sub_category" class="form-control sub-category">
                                        @foreach($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}" @selected(old('sub_category', $subCategory->id) == $childCategory->sub_category_id)>{{ $subCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" @selected(old('status', $childCategory->status) == '1')>Active</option>
                                        <option value="0" @selected(old('status', $childCategory->status) == '0')>Inactive</option>
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

@push('scripts')
    <script>
        $(function () {
            $('body').on('change', '.main-category', function (e){
                let id = $(this).val();
                $.ajax({
                    url: '{{ route('admin.child-categories.get-sub-categories') }}',
                    method: 'get',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $('.sub-category').html('<option value="">Select Sub Category</option>');
                        $.each(data, function (i, item) {
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`);
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
