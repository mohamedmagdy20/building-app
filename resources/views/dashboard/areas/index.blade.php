@extends('dashboard.layout.app')
@section('title','Areas')
@section('content')
   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Areas List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    </li>
                    <li class="breadcrumb-item active">Areas</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Areas List</h4>
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#firstmodal">Import Excel</button>
                    <a href="{{asset('assets/excel/area_example.xlsx')}}"  target="__blank" class="btn btn-info" >Download Example</a>   
                    <a href="{{ route('admin.areas.create') }}" class="btn btn-primary">Add Area <i
                            class="fa fa-plus"></i>
                    </a>
                </div>

                <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                           <th>Name in English</th>
                           <th>Name in Arabic</th>
                           <th>Price</th>
                           <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($data as $item)
                        <tr>

                            <td>{{$item->name_en}}</td>
                            <td>{{$item->name_ar}}</td>
                            <td>{{$item->price}}</td>
                             <td>
                                <a href="{{route('admin.areas.edit',$item->id)}}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="{{route('admin.areas.delete',$item->id)}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

    <!-- First modal dialog -->
    <div class="modal fade" id="firstmodal" aria-hidden="true" aria-labelledby="..." tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.areas.upload-excel')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="">File</label>
                                <input type="file" name="file" class="form-control">

                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('scripts')
<script>
    $('#datatable-buttons').DataTable();
</script>
@endsection
