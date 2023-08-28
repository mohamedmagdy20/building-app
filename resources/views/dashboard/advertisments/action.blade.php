@switch($type)
    @case('action')
        <a href="{{route('admin.advertisment.show',$data->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
        @if ($data->abroved == false)
            <a class="btn btn-success" onclick="Abrove({{$data->id}})"><i class="fa fa-check"></i></a>        
        @else
            <a class="btn btn-danger text-bold" onclick="Block({{$data->id}})" >X</a>        
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
    @case('abroved')
        @if($data->abroved == true)
            <span class="btn btn-sm btn-success">Abroved</span>
        @else
            <span class="btn btn-sm btn-secondary">Not Abroved</span>
        @endif
   
    @break
    @default
        
@endswitch