@switch($type)
    @case('action')
        <a href="{{route('admin.advertisment.show',$data->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
        
        @if ($data->abroved == false && $data->deleted_at == null)
            <a class="btn btn-danger text-bold" onclick="Block({{$data->id}},event)" >X</a>        
            <a class="btn btn-success" onclick="Abrove({{$data->id}},event)"><i class="fa fa-check"></i></a>        
        @endif
        @if($data->deleted_at != null)
            <a href="{{route('admin.advertisment.delete',$data->id)}}" class="delete-confirm btn btn-danger"><i class="fa fa-trash"></i></a>
        @endif
        @break
    @case('image')
    <div class="py-1">
        <img src="{{$data->adsImage[0]->image != null ? asset('uploads/ads/'.$data->adsImage[0]->image) : asset('assets/images/users/avatar-1.jpg')}}"  class="img-thumbnail w-75  rounded-1" alt="{{$data->title}}">
    </div>
    @break

    @case('ads_type')
        @if ($data->ads_type == 'normal')
            <span class="btn btn-sm btn-info">{{$data->ads_type}}</span>
        @elseif ($data->ads_type == 'special')
            <span class="btn btn-sm btn-info">{{$data->ads_type}}</span>
        @elseif ($data->ads_type == 'fixed')
            <span class="btn btn-sm btn-primary">{{$data->ads_type}}</span>
        @else
            <span class="btn btn-sm btn-dark">{{$data->ads_type}}</span>
        @endif
    @break
    @case('user')
        <a href="{{route('admin.user.show',$data->user_id)}}">{{$data->user->name}}</a>
    @break
    @case('abroved')
        @if($data->abroved == true)
            <span class="btn btn-sm btn-success">Abroved</span>
        @elseif ($data->deleted_at != null)
          <span class="btn btn-sm btn-danger">Deleted</span>
        @else
            <span class="btn btn-sm btn-secondary">Not Abroved</span>
        @endif
   
    @break
    @case('is_expire')
        @if ($data->is_expire == 0)
            <span class="btn btn-sm btn-success">Not Expire</span>
        @else
            <span class="btn btn-sm btn-danger">Expire</span>
        @endif
    @break
    @case('edit_type')
    <select name="ads_type" class="form-control"  {{$data->deleted_at != null ? 'disabled' : ''}} onchange="updateType({{$data->id}},event)" id="">
        <option value="normal" {{$data->ads_type == 'normal' ? 'selected' : ''}}>Normal</option>
        <option value="special" {{$data->ads_type == 'special' ? 'selected' : ''}}>Special</option>
        <option value="fixed" {{$data->ads_type == 'fixed' ? 'selected' : ''}}>Fixed</option>
        <option value="draft" {{$data->ads_type == 'draft' ? 'selected' : ''}}>Draft</option>
    
    </select>
    @break
    @default
        
@endswitch