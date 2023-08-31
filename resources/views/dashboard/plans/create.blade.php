@extends('dashboard.layout.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Add plan</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.plans.index') }}">plan</a>
                    </li>
                    <li class="breadcrumb-item active">Add plan</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="card-body" id="myForm" method="post" action="{{ route('admin.plans.store') }}" enctype="multipart/form-data">
                @csrf
                <h4 class="card-title">Add plan</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="example-text-input" class="col-sm-2 col-form-label">number of ads</label>
                        <input class="form-control" type="number" name="num_ads" placeholder="number of ads"
                            id="example-text-input" value="{{ old('num_ads') }}" required>
                        @error('num_ads')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                    <label for="example-text-input" class="col-sm-3 col-form-label">number of days</label>

                        <input class="form-control" type="number" name="num_days" placeholder="number of days"
                            id="example-text-input" value="{{ old('num_days') }}" required>
                        @error('num_days')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="example-text-input" class="col-sm-2 col-form-label">price</label>
                        <input class="form-control" type="number" name="price" placeholder="price $"
                            id="example-text-input" value="{{ old('price') }}" required>
                        @error('price')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                    <label for="example-text-input" class="col-sm-2 col-form-label">description</label>

                        <input class="form-control" type="text" name="description" placeholder="description .."
                            id="example-text-input" value="{{ old('description') }}" required>
                        @error('description')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Type of plan</label>
                         <select name="is_permium" class="form-control" >
                            <option value="">select Type of plan</option>
                            <option value="0">Normal</option>
                            <option value="1">Permium</option>
                         </select>
                        @error('is_permium')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" id="submit" class="btn btn-info waves-effect waves-light"
                    style="margin-top:20px">Save</button>
                <a href="{{ route('admin.plans.index') }}" class="btn btn-light waves-effect"
                    style="margin-top:20px">Cancel</a>
            </form>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->

@endsection
