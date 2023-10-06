@extends('dashboard.layout.app')
@section('title','Advertisment Points')
@section('content')
   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Admin List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    </li>
                    <li class="breadcrumb-item active">Advertisment Type</li>
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
                <h4 class="card-title">Point List</h4>
             
                <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                           <th>Name</th>
                           <th>Point</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($data as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>
                                <input type="text" value="{{$item->point}}" class="form-control w-25" onchange="updatePoint({{$item->id}},event)">
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
<script>
function updatePoint(id,e)
{
    point = e.target.value;
    $.ajax({
        type: 'GET',
        url: "{{route('admin.ads_type.update-point')}}",
        data: {id:id,point:point},
        dataType: 'JSON',
        success: function (results) {
            toastr.success('Point Updated', 'success');
            // DataTable.ajax.reload()
        },
        error:function(result){
            console.log(result);
            toastr.error('Error Accure', 'Error');  
        
        }
    });
}
</script>
@endsection