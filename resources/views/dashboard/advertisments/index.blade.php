@extends('dashboard.layout.app')
@section('title','Advertisments')
@section('content')
   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Advertisments List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">DashBoard</a></li>
                    </li>
                    <li class="breadcrumb-item active">Advertisments</li>
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
                <h4 class="card-title">Advertisments List</h4>
              
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
    var url = "{{ route('admin.advertisment.data') }}";
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
                data: 'title'
            },
            {
                data: 'category.name_en'
            },
            {
                data: 'area.name_ar'
            },
            {
                data: 'type'
            },
            {
                data: 'ads_type'
            },
            {
                data: 'location'
            },
            {
                data: 'abroved'
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

function Abrove(id)
{
    $.ajax({
        type: 'GET',
        url: "{{route('admin.advertisment.accept')}}",
        data: {id:id},
        dataType: 'JSON',
        success: function (results) {
            toastr.success('Advertisment Abroved', 'success');
            DataTable.ajax.reload()
        },
        error:function(result){
            console.log(result);
            toastr.error('Error Accure', 'Error');  

        }
    });
}

function Block(id)
{
    $.ajax({
        type: 'GET',
        url: "{{route('admin.advertisment.block')}}",
        data: {id:id},
        dataType: 'JSON',
        success: function (results) {
            toastr.success('Advertisment Blocked', 'success');
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