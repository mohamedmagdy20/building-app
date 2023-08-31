@extends('dashboard.layout.app')
@section('title','Plans')
@section('content')
   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Plans List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    </li>
                    <li class="breadcrumb-item active">Plans</li>
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
                <h4 class="card-title">Plans List</h4>
                <div class="text-center mb-3">
                    <a href="#" class="btn btn-primary">Add Plans <i
                            class="fa fa-plus"></i></a>
                </div>
                <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                           <th>Advertisments Count</th>
                           <th>Days Count</th>
                           <th>Price</th>
                           <th>Type</th>

                           <th>Desciption</th>
                           <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($data as $item)
                        <tr>
                            <td>{{$item->num_ads}}</td>
                            <td>{{$item->num_days}}</td>
                            <td>{{$item->price}}</td>
                            <td>
                                @if ($item->is_permium == false)
                                <p class="btn btn-sm btn-primary">Normal</p>
                                @else
                                <p class="btn btn-sm btn-warning">Permium</p>
                                @endif 
                            </td>
                            <td>{{$item->description}}</td>

                            <td>
                                <a href="#" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="#" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>
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