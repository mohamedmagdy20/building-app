@extends('dashboard.layout.app')
@section('content')
   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Calcualtion List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    </li>
                    <li class="breadcrumb-item active">Calcualtion</li>
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
                <h4 class="card-title">Calcualtion List</h4>
                <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                           <th>Name</th>
                           <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($data as $item)
                        <tr>
                            <td>{{$item->key}}</td>
                            <td>
                                <input type="text" onchange="updateCalculation({{$item->id}},event)" class="form-control" name="value" value="{{$item->value}}">
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
    function updateCalculation(id,e)
    {
        const value = e.target.value
        $.ajax({
        type: 'GET',
        url: "{{route('admin.calculation.update')}}",
        data: {id:id,value:value},
        dataType: 'JSON',
        success: function (results) {
            toastr.success('Value Updated', 'success');
        },
        error:function(result){
            console.log(result);
            toastr.error('Error Accure', 'Error');  

        }
    });
    }
    
</script>
@endsection
