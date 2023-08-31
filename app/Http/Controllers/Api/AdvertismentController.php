<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertismentRequest;
use App\Http\Resources\AdvertismentResource;
use App\Http\Resources\ArchitectureResource;
use App\Http\Resources\CommercialResource;
use App\Http\Resources\LandResource;
use App\Http\Resources\ResidentialResource;
use App\Models\AdsFavorite;
use App\Models\Advertisment;
use App\Models\AdvertismentImage;
use App\Models\Draft;
use App\Traits\FilesTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertismentController extends Controller
{
    //
    use FilesTrait;
    protected $model;
    protected $modelImage;
    protected $adsFavorite;
    public function __construct(Advertisment $model , AdvertismentImage $modelImage, AdsFavorite $adsFavorite)
    {
        $this->model = $model;
        $this->adsFavorite=  $adsFavorite;
        $this->modelImage =$modelImage;
    }
    public function store(AdvertismentRequest $request)
    {
        $data = $request->validated();
        try{
            DB::beginTransaction();

            $ads =$this->model->create(array_merge($data,['user_id'=>$this->auth($request->access_token)->id]));
            
            if($request->hasFile('image_1'))
            {
                $imageName = $this->saveFile($request->file('image_1'),config('filepath.ADS_PATH'));
                $this->modelImage->create(['advertisment_id'=>$ads->id,'image'=>$imageName]);
            }

            if($request->hasFile('image_2'))
            {
                $imageName = $this->saveFile($request->file('image_2'),config('filepath.ADS_PATH'));
                $this->modelImage->create(['advertisment_id'=>$ads->id,'image'=>$imageName]);
            }

            if($request->hasFile('image_3'))
            {
                $imageName = $this->saveFile($request->file('image_3'),config('filepath.ADS_PATH'));
                $this->modelImage->create(['advertisment_id'=>$ads->id,'image'=>$imageName]);
            }     
            if($request->hasFile('image_4'))
            {
                $imageName = $this->saveFile($request->file('image_4'),config('filepath.ADS_PATH'));
                $this->modelImage->create(['advertisment_id'=>$ads->id,'image'=>$imageName]);
            }

            if($request->hasFile('image_5'))
            {
                $imageName = $this->saveFile($request->file('image_5'),config('filepath.ADS_PATH'));
                $this->modelImage->create(['advertisment_id'=>$ads->id,'image'=>$imageName]);
            }

            DB::commit();
            return response()->json([
                'status'=>200,
                'message'=>'Advertisment Added',
                'data'=> new AdvertismentResource($ads)
            ]);
        }catch(Exception $e)
        {
            DB::rollBack();
            return response()->json([
                'status' => 400,
                'message'=> $e->getMessage(),
                'data'=>null
            ]);
        }
    }

    public function show(Request $request)
    {
        $data = $this->model->with('category')->find($request->get('id'));
        if($data)
        {
            switch ($data->category->type) {
                case 'lands':
                    $resources = new LandResource($data);   
                break;
                case 'break':
                     $resources = new LandResource($data);   
                break;
                case 'farm':
                    $resources = new LandResource($data);   
                break;
                case 'industrial':
                    $resources = new LandResource($data);   
                break;
                case 'commercial_units':
                    $resources = new LandResource($data);   
                break;                
                case 'commercial':
                    $resources = new LandResource($data);   
                break;

                case 'chalet':
                    $resources = new ResidentialResource($data);   
                break;

                case 'residential':
                    $resources = new ResidentialResource($data);   
                break;
            }
            if($data->category->name_en == 'Apartments' && $data->category->name_ar == 'شقق')
            {
                $resources = new ResidentialResource($data);   
            }
            if($data->category->name_en == 'Architecture' && $data->category->name_ar == 'عماير')
            {
                $resources = new ArchitectureResource($data);   
            }

            
            return response()->json(
                [
                    'status'=>200,
                    'message'=>'Success',
                    'data'=> $resources
                ]
            );
        }else{
            return response()->json(
                [
                    'status'=>404,
                    'message'=>'Not Found',
                    'data'=> null
                ]
            ,404);
        }
        
    }

    public function specialAds(Request $request)
    {
        return response()->json([
            'status'=>200,
            'message'=>'Success',
            'data'=>AdvertismentResource::collection($this->model->special()->where('abroved',true)->latest()->get())
        ], 200);
    }

    public function index(Request $request)
    {
        $data = $this->model->orderByRaw("FIELD(ads_type, 'fixed', 'normal')")->filter($request->all())->where('abroved',true)->latest()->simplePaginate(7);
        return response()->json([
            'status'=>200,
            'message'=>'Success',
            'data'=>AdvertismentResource::collection($data)
        ], 200);
    }

    public function update(AdvertismentRequest $request,$id)
    {
        $data = $request->validated();
        $ads = $this->model->findOrFail($id)->update($data);
        if($request->hasFile('image_1'))
        {
            $data['image_1'] = $this->updateFile($request->file('image_1'),$ads->adsImage[0]->image,config('filepath.ADS_PATH'));
            $this->modelImage->where('image',$ads->adsImage[0]->image)->update(['image'=>$data['image_1']]);
        }
        if($request->hasFile('image_2'))
        {
            $data['image_2'] = $this->updateFile($request->file('image_2'),$ads->adsImage[1]->image,config('filepath.ADS_PATH'));
            $this->modelImage->where('image',$ads->adsImage[1]->image)->update(['image'=>$data['image_2']]);
        }
        if($request->hasFile('image_3'))
        {
            $data['image_3'] = $this->updateFile($request->file('image_3'),$ads->adsImage[2]->image,config('filepath.ADS_PATH'));
            $this->modelImage->where('image',$ads->adsImage[2]->image)->update(['image'=>$data['image_3']]);
        }
        if($request->hasFile('image_4'))
        {
            $data['image_4'] = $this->updateFile($request->file('image_4'),$ads->adsImage[3]->image,config('filepath.ADS_PATH'));
            $this->modelImage->where('image',$ads->adsImage[3]->image)->update(['image'=>$data['image_4']]);
        }
        if($request->hasFile('image_5'))
        {
            $data['image_5'] = $this->updateFile($request->file('image_5'),$ads->adsImage[4]->image,config('filepath.ADS_PATH'));
            $this->modelImage->where('image',$ads->adsImage[4]->image)->update(['image'=>$data['image_5']]);
        }
        return response()->json([
            'status'=>200,
            'message'=>'Advertisment Updated',
            'data'=>null
        ]);
    
    }



    public function addFavorate(Request $request)
    {
        $ads = $this->adsFavorite->create(['user_id'=>$this->auth($request->access_token)->id,'advertisment_id'=>$request->id]);
        return response()->json([
            'status'=>200,
            'message'=>'Success',
            'data'=>null
        ], 200);
    }

    public function favoriteAds(Request $request)
    {
        $IDs = $this->adsFavorite->where('user_id',$this->auth($request->access_token))->pluck('advertisment_id');
        $data =  $this->model->whereIn('id',$IDs)->simplePaginate(7);
        return response()->json([
            'status'=>200,
            'message'=>'Success',
            'data'=>AdvertismentResource::collection($data)
        ], 200);
    }

    // private function AdsImageLinks($images)
    // {
    //     $arrLink = [];
    //     foreach($images as $index => $image)
    //     {
    //         $arrLink[$index] = asset('uploads/ads/'.$image->image);
    //     }
    //     return $arrLink;
    // }
    
}
