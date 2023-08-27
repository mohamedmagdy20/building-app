@extends('dashboard.layout.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Settings</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.setting.index') }}">Settings</a>
                    </li>
                    <li class="breadcrumb-item active">Settings</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="card-body" id="myForm" method="post" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
                @csrf
                <h4 class="card-title">Update Settings</h4>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Logo</label>
                        <input class="form-control" type="file" name="logo" 
                            id="example-text-input" value="{{ old('logo') }}">
                    </div>

                    <div class="col-md-6">
                        <div class="py-2">
                            <img src="{{ asset('uploads/logo/'.$data[0]['value']) }}" alt="" class="img-fluid w-50">
                        </div>
                    </div>


                    <div class="col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Splach Screen</label>
                        <input class="form-control" type="file" name="splach" 
                            id="example-text-input" value="{{ old('splach') }}">
                    </div>

                    <div class="col-md-6">
                        <div class="py-2">
                            <img src="{{ asset('uploads/splach/'.$data[1]['value']) }}" alt="" class="img-fluid w-50">
                        </div>
                    </div>

            

                <!-- end row -->
                </div>
                <button type="submit" id="submit" class="btn btn-info waves-effect waves-light"
                    style="margin-top:20px">Save</button>
                <a href="{{ route('admin.home') }}" class="btn btn-light waves-effect"
                    style="margin-top:20px">Cancel</a>
            </form>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->

@endsection