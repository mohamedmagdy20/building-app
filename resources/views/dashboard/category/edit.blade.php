@extends('dashboard.layout.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit Categroy</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Category</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Category</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="card-body" id="myForm" method="post" action="{{ route('admin.category.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                <h4 class="card-title">Edit Categroy</h4>
                <div class="row mb-3">
                 
                    <div class="col-md-12">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Category In English</label>

                        <input class="form-control" type="text" name="name_en" placeholder="Category Name in English"
                            id="example-text-input" value="{{ old('name_en',$data->name_en) }}" required>
                        @error('name_en')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Category In Arabic</label>
    
                            <input class="form-control" type="text" name="name_ar" placeholder="Category Name in Arabic"
                                id="example-text-input" value="{{ old('name_ar',$data->name_ar) }}" required>
                            @error('name_ar')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        
                    <div class="col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Type</label>
                        <select name="type" class="form-control" id="">
                            <option value="{{old('residential')}}">Residential</option>
                            <option value="{{old('commercial_units')}}">Commercial Units</option>
                            <option value="{{old('commercial')}}">Commercial</option>
                            <option value="{{old('investment')}}">Investment</option>
                            <option value="{{old('industrial')}}">Industrial</option>
                            <option value="{{old('chalet')}}">Chalet</option>
                            <option value="{{old('farm')}}">Farm</option>
                            <option value="{{old('break')}}">Break</option>
                            <option value="{{old('lands')}}">Lands</option>
                        </select>
                            @error('type')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                <!-- end row -->
                </div>
                <button type="submit" id="submit" class="btn btn-info waves-effect waves-light"
                    style="margin-top:20px">Save</button>
                <a href="{{ route('admin.category.index') }}" class="btn btn-light waves-effect"
                    style="margin-top:20px">Cancel</a>
            </form>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->

@endsection
