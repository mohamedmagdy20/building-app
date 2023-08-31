@extends('dashboard.layout.app')
@section('content')
<div class="row justify-content-center align-items-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mx-5 ">
                    <img class="d-flex me-3 rounded-circle img-thumbnail avatar-lg" src="{{$data->image != null ? asset('uploads/users/'.$data->image) : asset('assets/images/users/person.jpg') }}" alt="{{$data->name}}">
                    <div class="flex-grow-1">
                        <h5 class="mt-0 font-size-18 mb-1">{{$data->name}}</h5>
                        <p class="text-muted font-size-14">{{$data->account_type}} User</p>
                    </div>
                </div>
            </div>
        </div> 
    </div>
   </div>

   <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Users List</h4>
              
                <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Area</th>
                            <th>Type</th>
                            <th>Advertisment Type</th>
                            <th>Location</th>
                            <th>Status</th>
                           <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->advertisment as $item)
                            <tr>
                                <td>
                                    <div class="py-1">
                                        <img src="{{$item->adsImage[0]->image != null ? asset('uploads/ads/'.$item->adsImage[0]->image) : asset('assets/images/users/avatar-1.jpg')}}"  class="img-thumbnail img-fluid rounded-1" width="80px" alt="{{$item->title}}">
                                    </div>
                                </td>
                                <td>{{$item->title}}</td>
                                <td>{{optional($item->category)->name_en}}</td>
                                <td>{{optional($item->area)->name_en}}</td>
                                <td>{{$item->type}}</td>
                                <td>
                                    @if ($item->ads_type == 'normal')
                                        <span class="btn btn-sm btn-info">{{$item->ads_type}}</span>
                                    @elseif ($item->ads_type == 'special')
                                        <span class="btn btn-sm btn-info">{{$item->ads_type}}</span>
                                    @elseif ($item->ads_type == 'fixed')
                                        <span class="btn btn-sm btn-primary">{{$item->ads_type}}</span>
                                    @else
                                        <span class="btn btn-sm btn-dark">{{$item->ads_type}}</span>
                                    @endif
                                </td>
                                <td>{{$item->location}}</td>
                                <td>
                                    @if($item->abroved == true)
                                    <span class="btn btn-sm btn-success">Abroved</span>
                                    @else
                                        <span class="btn btn-sm btn-secondary">Not Abroved</span>
                                    @endif
                           
                                </td>
                                <td>
                                    <a href="{{route('admin.advertisment.show',$item->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
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