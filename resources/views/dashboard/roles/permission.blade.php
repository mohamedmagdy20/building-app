@extends('dashboard.layout.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Permissions</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.role.index')}}">Roles</a></li>
                            
                            <li class="breadcrumb-item active">Permissions</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
    
                <h4 class="card-title">Edit Permissions for {{$role->name}}</h4>
                

                <form method="post" action="{{ route('admin.permission.update',$role->id) }}"  class="needs-validation"  novalidate >
                    @csrf
    
                <div class="row mb-3">
                    <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll" value="" name="">
                            <label class="form-check-label" for="selectAll">
                               Select All
                            </label>
                        </div>
                    </div>
                    @foreach ($permissions as $permission)
                    <div class="col-md-3 bg-white">
                        <div class="">
                            <div class="checkbox checkbox-primary mb-2">
                                <input id="{{ $permission->id }}" type="checkbox"
                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                    value="{{ $permission->id }}" name="permissions[]" class="form-check-input" >
                                <label for="{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        </div>
                    </div> <!-- end col-->
                @endforeach
                </div>
    
                
                <!-- end row -->
                <input type="submit" class="btn btn-info waves-effect waves-light validate" value="Save">
                <a href="{{route('admin.role.index')}}" class="btn btn-secoundary waves-effect waves-light validate">Cencel</a>   
            </form>
                 
               
               
            </div>
        </div>
    </div> <!-- end col -->
    </div>
     
    
    
    </div>
    </div>
    
@endsection

@section('scripts')
<script>
      $("#selectAll").click(function(){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
    
        });
</script>
@endsection