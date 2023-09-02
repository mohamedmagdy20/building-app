@switch($type)
    @case('action')
        @if ($data->deleted_at == null)
        <a href="{{route('admin.user.show',$data->id)}}" class="btn btn-info"> <i class="fa fa-eye"></i></a>                    
        @else
        <a href="{{route('admin.user.force.delete',$data->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
        @endif
    
        @break
    @case('status')
    <input type="checkbox" id="switch1" switch="none" onchange="toggleData({{$data->id}})" {{$data->deleted_at == null ? 'checked' : '' }}  />
    <label for="switch1"></label>

    @break
    @case('image')
        <div class="py-1">
            <img src="{{$data->image != null ? asset('uploads/users/'.$data->image) : asset('assets/images/users/avatar-1.jpg')}}"  class="img-thumbnail w-75  rounded-1" alt="{{$data->name}}">
        </div>
    @break
    @case('points')
    <div class="w-50">
        <input type="text" name="points" onchange="updatePoints({{$data->id}})" {{$data->deleted_at !=null ? 'readonly' : ''}}  disable value="{{$data->points}}" id="points-{{$data->id}}" class="form-control">
    </div>
    @break
    @case('account_type')
        @if ($data->account == 'normal')
            <p class="btn btn-sm btn-info">{{$data->account_type}}</p>        
        @else
            <p class="btn btn-sm btn-warning text-white">{{$data->account_type}}</p>        
        @endif
    @break
    @default
        
@endswitch