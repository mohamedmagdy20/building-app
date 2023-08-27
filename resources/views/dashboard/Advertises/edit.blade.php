@extends('dashboard.layout.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit Advertise</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.Advertise.index') }}">Advertise</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Advertise</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="card-body" id="myForm" method="post" action="{{ route('admin.Advertise.update',$Advertise->id) }}" enctype="multipart/form-data">
                @csrf
                <h4 class="card-title">Edit Advertise</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                        <input class="form-control" type="file" name="image"
                            id="example-text-input" value="{{ old('image',$Advertise->image) }}" required>
                        @error('image')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Url</label>

                        <input class="form-control" type="url" name="url" placeholder="Ex: example@example.com"
                            id="example-text-input" value="{{ old('url',$Advertise->url) }}" required>
                        @error('url')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" id="submit" class="btn btn-info waves-effect waves-light"
                    style="margin-top:20px">Save</button>
                <a href="{{ route('admin.Advertise.index') }}" class="btn btn-light waves-effect"
                    style="margin-top:20px">Cancel</a>
            </form>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->

@endsection
