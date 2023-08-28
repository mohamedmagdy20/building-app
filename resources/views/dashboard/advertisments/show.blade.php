@extends('dashboard.layout.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Advertisment</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Advertisments</a>
                    </li>
                    <li class="breadcrumb-item active">Show Advertisments</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <h4 class="card-title">Show Advertisment</h4>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                    <input class="form-control" type="text" name="name" disabled id="example-text-input"
                        value="{{$data->title}}" required>

                </div>

                <div class="col-md-4">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Publich By</label>
                    <input class="form-control" type="text" id="example-text-input" value="{{$data->user->name }}"
                        disabled>
                </div>


                <div class="col-md-4">
                    <label for="example-tel-input" class="col-sm-2 col-form-label">Area</label>
                    <input class="form-control" type="text" id="example-text-input" value="{{$data->area->name_en }}"
                        disabled>
                </div>

                <div class="col-md-4">
                    <label for="example-tel-input" class="col-sm-2 col-form-label">Price</label>
                    <input class="form-control" type="text" id="example-text-input" value="{{$data->price }}" disabled>
                </div>

                <div class="col-md-4">
                    <label for="example-tel-input" class="col-sm-2 col-form-label">Location</label>
                    <input class="form-control" type="text" id="example-text-input"
                        value="{{optional($data)->location}}" disabled>
                </div>


                <div class="col-md-4">
                    <label for="example-tel-input" class="col-sm-2 col-form-label">Links</label>
                    <input class="form-control" type="text" id="example-text-input" value="{{optional($data)->links}}"
                        disabled>
                </div>


                <div class="col-md-4">
                    <label for="example-tel-input" class="col-sm-2 col-form-label">Space</label>
                    <input class="form-control" type="text" id="example-text-input" value="{{optional($data)->space}}"
                        disabled>
                </div>



                <div class="col-md-4">
                    <label for="example-tel-input" class="col-sm-2 col-form-label"> Block number</label>
                    <input class="form-control" type="text" id="example-text-input" value="{{optional($data)->space}}"
                        disabled>
                </div>


                <div class="col-md-4">
                    <label for="example-tel-input" class="col-sm-2 col-form-label">Type</label>
                    <input class="form-control" type="text" id="example-text-input" value="{{optional($data)->space}}"
                        disabled>
                </div>

                <div class="col-md-4">
                    <label for="example-tel-input" class="col-sm-2 col-form-label">Advertisment Type</label>
                    <input class="form-control" type="text" id="example-text-input"
                        value="{{optional($data)->ads_type}}" disabled>
                </div>


                <!-- end row -->

                <div class="col-md-12">
                    <label for="example-tel-input" class="col-sm-2 col-form-label">Attachment</label>
                    <div class="row">
                        @foreach ($data->adsImage as $item)
                        <div class="col-md-3">

                            <div class="py-2">
                                <a class="my-image-links" data-gall="gallery0{{$item->id}}"
                                    href="{{asset('uploads/ads/'.$item->image)}}"><img class="img-fluid "
                                        src="{{asset('uploads/ads/'.$item->image)}}"></a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.advertisment.index') }}" class="btn btn-light waves-effect"
                    style="margin-top:20px">Back</a>

            </div>
        </div>
    </div>
</div> <!-- end col -->
</div>
<!-- end row -->

@endsection
@section('scripts')
<script>
    new VenoBox({
    selector: '.my-image-links',
    numeration: true,
    infinigall: true,
    share: true,
    spinner: 'rotating-plane'
});
</script>
@endsection