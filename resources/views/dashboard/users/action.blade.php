@switch($type)
    @case('action')
        <a href="{{route('admin.user.show',$data->id)}}" class="btn btn-info"> <i class="fa fa-eye"></i></a>        
        <a href="" class="btn btn-success"> <i class="fa fa-plus"></i></a>        
    
        @break
    @case('status')
    <input type="checkbox" id="switch1" switch="none" checked />
    <label for="switch1" data-on-label="On" data-off-label="Off"></label>

    @break
    @case('image')
        <div class="py-1">
            <img src="{{$data->image != null ? asset('uploads/users/'.$data->image) : asset('assets/images/users/avatar-1.jpg')}}"  class="img-thumbnail w-75  rounded-1" alt="{{$data->name}}">
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