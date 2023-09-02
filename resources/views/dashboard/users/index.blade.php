@extends('dashboard.layout.app')
@section('title','Users')
@section('content')
   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">User List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    </li>
                    <li class="breadcrumb-item active">Users</li>
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
                <h4 class="card-title">Users List</h4>
              
                <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                           <th>Image</th>
                           <th>Name</th>
                           <th>Email</th>
                           
                           <th>Phone</th>
                           <th>Account Type</th>

                           <th>Current Plan</th>
                           <th>Points</th>
                           <th>Status</th>

                           <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


@endsection
@section('scripts')
<script>
let DataTable = null
function DataTables() {
    var url = "{{ route('admin.user.data') }}";
    DataTable = $("#datatable-buttons").DataTable({
        processing: true,
        serverSide: true,
        dom: 'Blfrtip',
        lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],
        pageLength: 9,
        buttons: [
           {
                        extend: 'copy',
                        className: 'btn btn-dark'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-dark'
                    },
                    {
                        extend: 'csv',
                        charset: 'UTF-16LE',
                        fieldSeparator: '\t',
                        bom: true ,
                        className: 'btn btn-dark'
                    },
        ],
        sorting: [0, "DESC"],
        ordering: false,
        ajax: url,
        drawCallback: function(settings) {
     
            $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                    
        },
        language: {
            paginate: {
                "previous": "<i class='mdi mdi-chevron-left'>",
                "next": "<i class='mdi mdi-chevron-right'>"
            },
        },
        columns: [{
                data: 'image'
            },
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'phone'
            },
            {
                data: 'account_type'
            },
            {
                data: 'plan_id'
            },
            {
                data: 'points'
            },
            {
                data:'status'
            },
            {
                data: 'action'
            },
          
        ],
    });
}
$(function() {
    DataTables();
});

function updatePoints(id)
{
    points = $(`#points-${id}`).val()
    console.log(points);
    $.ajax({
        type: 'GET',
        url: "{{route('admin.user.update-points')}}",
        data: {id:id,points:points},
        dataType: 'JSON',
        success: function (results) {
            toastr.success('Points Updated', 'success');
            DataTable.ajax.reload()
        },
        error:function(result){
            console.log(result);
            toastr.error('Error Accure', 'Error');  

        }
    });
}

function toggleData(id)
{
    $.ajax({
        type: 'GET',
        url: "{{route('admin.user.delete')}}",
        data: {id:id},
        dataType: 'JSON',
        success: function (results) {
            toastr.success('User Updated', 'success');
            DataTable.ajax.reload()
        },
        error:function(result){
            console.log(result);
            toastr.error('Error Accure', 'Error');  

        }
    });
}

</script>
@endsection