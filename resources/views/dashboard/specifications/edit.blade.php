@extends('dashboard.layout.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit Location Specification</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.specifications.index') }}">Location Specifications</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Location Specification </li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="card-body" id="myForm" method="post" action="{{ route('admin.specifications.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                <h4 class="card-title">Edit Location Specifications</h4>
                <div class="row mb-3">
                 
                    <div class="col-md-12">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Name In English</label>

                        <input class="form-control" type="text" name="name_en" placeholder="Name in English"
                            id="example-text-input" value="{{ old('name_en') }}" required>
                        @error('name_en')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Name In Arabic</label>
    
                            <input class="form-control" type="text" name="name_ar" placeholder="Name in Arabic"
                                id="example-text-input" value="{{ old('name_ar') }}" required>
                            @error('name_ar')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                    </div>

                    
                    <div class="col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Price</label>
    
                            <input class="form-control" type="number" name="price" placeholder="Enter Price"
                                id="example-text-input" value="{{ old('price') }}" required>
                            @error('price')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                    </div>

                <!-- end row -->
                </div>
                <button type="submit" id="submit" class="btn btn-info waves-effect waves-light"
                    style="margin-top:20px">Save</button>
                <a href="{{ route('admin.specifications.index') }}" class="btn btn-light waves-effect"
                    style="margin-top:20px">Cancel</a>
            </form>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->

@endsection
