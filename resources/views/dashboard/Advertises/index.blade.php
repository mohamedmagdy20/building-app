@extends('dashboard.layout.app')
@section('title','Advertis')
@section('content')
   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Advertis List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    </li>
                    <li class="breadcrumb-item active">Advertis</li>
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
                <h4 class="card-title">Advertis List</h4>
                <div class="text-center mb-3">
                    <a href="{{ route('admin.Advertise.create') }}" class="btn btn-primary">Add Advertis <i
                            class="fa fa-plus"></i>
                    </a>
                </div>
                <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                           <th>Image</th>
                           <th>Url</th>
                           <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($data as $item)
                        <tr>

                            <td><img width="100" height="100" src="{{$item->image}}"  /></td>
                            <td><a href="{{$item->url}}" target="__blank">{{$item->url}}</a> </td>
                             <td>
                                <a href="{{route('admin.Advertise.edit',$item->id)}}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="{{route('admin.Advertise.delete',$item->id)}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


@endsection
@section('scripts')
<script>
    $('#datatable-buttons').DataTable();
</script>
@endsection
