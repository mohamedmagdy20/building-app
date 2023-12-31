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
use App\Models\SearchLogs;
use App\Traits\FilesTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Shetabit\Visitor\Traits\Visitable;
use Illuminate\Support\Facades\Auth;
use App\Events\StartChatEvent;
use App\Events\NotificationEvent;
use App\Http\Requests\AdvertismentWebRequest;
use Illuminate\Support\Facades\Validator;

class AdvertismentController extends Controller
{
    //
    use FilesTrait;
    protected $model;
    protected $modelImage;
    protected $adsFavorite;
    protected $searchLogs;
    public function __construct(Advertisment $model , AdvertismentImage $modelImage,SearchLogs $searchLogs, AdsFavorite $adsFavorite)
    {
        $this->model = $model;
        $this->adsFavorite=  $adsFavorite;
        $this->modelImage =$modelImage;
        $this->searchLogs = $searchLogs;
    }
    public function store(AdvertismentRequest $request)
    {
        $data = $request->validated();
        try{
            DB::beginTransaction();

            // if(is_array($data['advantages']))
            // {
            //     $data['advantages'] = implode(',',$data['advantages']); 
            // }

            $ads =$this->model->create(array_merge($data,['user_id'=>$this->auth($request->access_token)->id]));
            
            // if($request->hasFile('images'))
            // {
            //     foreach($data['images'] as $image)
            //     {
            //         $imageName = $this->saveFile($image,config('filepath.ADS_PATH'));
            //         $this->modelImage->create(['advertisment_id'=>$ads->id,'image'=>$imageName]);
            //     }
            // }


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
            // fire notification event 
            event(new NotificationEvent($ads));

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
            ],400);
        }
    }


    public function storeWeb(AdvertismentWebRequest $request)
    {
        $data = $request->validated();
        if(is_array($data['advantages']))
        {
            $data['advantages'] = implode(',',$data['advantages']);
        }
        try{
            $ads =$this->model->create($data);
            if($request->hasFile('images'))
            {
                foreach($data['images'] as $image)
                {
                    $imageName = $this->saveFile($image,config('filepath.ADS_PATH'));
                    $this->modelImage->create(['advertisment_id'=>$ads->id,'image'=>$imageName]);
                }
            } 
            event(new NotificationEvent($ads));
            return response()->json([
                'status'=>200,
                'message'=>'Advertisment Added',
                'data'=> new AdvertismentResource($ads)
            ]);

        }catch(Exception $e){
            return response()->json([
                'status' => 400,
                'message'=> $e->getMessage(),
                'data'=>null
            ],400);
        }
        

    }

    public function show(Request $request)
    {
        $data = $this->model->with('category')->find($request->get('id'));
        $data['authticated_token'] = $request->access_token != null ? $request->access_token  : null;
        if($data)
        {
            // insert in search log
            if(isset($request->access_token)  && $request->access_token != null)
            {
                $userSearch = $this->searchLogs->where('user_id',$this->auth($request->access_token)->id)->latest()->first();
                if($userSearch)
                {
                    $userSearch->update(['advertisment_id'=>$data->id]);
                }
                
            }
            // 
            
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
         
            $request->visitor()->setVisitor($data)->visit($data);
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
            'data'=>AdvertismentResource::collection($this->model->special()->where('is_expire',0)->where('abroved',true)->latest()->get())
        ], 200);
    }

    public function index(Request $request)
    {
        $data = $this->model->orderByRaw("FIELD(ads_type, 'fixed', 'normal')")->filter($request->all())->where('abroved',true)->where('is_expire',0)->where('ads_type','!=','special')->where('ads_type','!=','draft')->latest()->simplePaginate(7);
        if(isset($request->access_token) && $request->access_token != null)
        {
            if($request->q)
            {
                SearchLogs::create(['keyword'=>$request->q,'user_id'=>$this->auth($request->access_token)->id]);
            }
            
        }
        return response()->json([
            'status'=>200,
            'message'=>'Success',
            'data'=>AdvertismentResource::collection($data)
        ], 200);
    }
 
    public function update(AdvertismentRequest $request,$id)
    {
        $data = $request->validated();
        $ads = $this->model->findOrFail($id);
        $ads->update(array_merge($data,['abroved'=>false]));
        $countofExist = count($ads->adsImage);
        if($request->hasFile('image_1'))
        {
            if($countofExist >= 1)
            {
                $data['image_1'] = $this->updateFile($request->file('image_1'),$ads->adsImage[0]->image,config('filepath.ADS_PATH'));
                $this->modelImage->where('image',$ads->adsImage[0]->image)->update(['image'=>$data['image_1']]);    
            }else{
                // add new
                $data['image_1'] = $this->saveFile($request->file('image_1'),config('filepath.ADS_PATH'));
                $this->modelImage->create(['image'=>$data['image_1'],'advertisment_id'=>$ads->id]);
            }
         }
        if($request->hasFile('image_2'))
        {
            if($countofExist >= 2)
            {
                $data['image_2'] = $this->updateFile($request->file('image_2'),$ads->adsImage[1]->image,config('filepath.ADS_PATH'));
                $this->modelImage->where('image',$ads->adsImage[1]->image)->update(['image'=>$data['image_2']]);    
            }
            else{
                // add new
                $data['image_2'] = $this->saveFile($request->file('image_2'),config('filepath.ADS_PATH'));
                $this->modelImage->create(['image'=>$data['image_2'],'advertisment_id'=>$ads->id]);
            }
        }
        if($request->hasFile('image_3'))
        {
            if($countofExist >= 3)
            {
                $data['image_3'] = $this->updateFile($request->file('image_3'),$ads->adsImage[2]->image,config('filepath.ADS_PATH'));
                $this->modelImage->where('image',$ads->adsImage[2]->image)->update(['image'=>$data['image_3']]);    
            }
            else{
                // add new
                $data['image_3'] = $this->saveFile($request->file('image_3'),config('filepath.ADS_PATH'));
                $this->modelImage->create(['image'=>$data['image_3'],'advertisment_id'=>$ads->id]);
            }
        }
        if($request->hasFile('image_4'))
        {
            if($countofExist >= 4)
            {
                $data['image_4'] = $this->updateFile($request->file('image_4'),$ads->adsImage[3]->image,config('filepath.ADS_PATH'));
                $this->modelImage->where('image',$ads->adsImage[3]->image)->update(['image'=>$data['image_4']]);    
            }
            else{
                // add new
                $data['image_4'] = $this->saveFile($request->file('image_4'),config('filepath.ADS_PATH'));
                $this->modelImage->create(['image'=>$data['image_4'],'advertisment_id'=>$ads->id]);
            }
        }
        if($request->hasFile('image_5'))
        {
            if($countofExist >= 5)
            {
                $data['image_5'] = $this->updateFile($request->file('image_5'),$ads->adsImage[4]->image,config('filepath.ADS_PATH'));
                $this->modelImage->where('image',$ads->adsImage[4]->image)->update(['image'=>$data['image_5']]);    
            } else{
                // add new
                $data['image_5'] = $this->saveFile($request->file('image_5'),config('filepath.ADS_PATH'));
                $this->modelImage->create(['image'=>$data['image_5'],'advertisment_id'=>$ads->id]);
            }
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
        $IDs = $this->adsFavorite->where('user_id',$this->auth($request->access_token)->id)->pluck('advertisment_id');
        $data =  $this->model->whereIn('id',$IDs)->simplePaginate(7);
        return response()->json([
            'status'=>200,
            'message'=>'Success',
            'data'=>AdvertismentResource::collection($data)
        ], 200);
    }


    public function userAds(Request $request)
    {
        $user = $this->auth($request->access_token);
        $data = $this->model->filter($request->all())->where('user_id',$user->id)->where('abroved',true)->latest()->simplePaginate(7);;
        return response()->json([
            'status'=>200,
            'message'=>'Success',
            'data'=>AdvertismentResource::collection($data)
        ]);
    }

    public function deleteImage(Request $request)
    {
        $ids = explode(',',$request->ids);
        try{
            $data = $this->modelImage->whereIn('id',$ids)->get();
            foreach($data as $item)
            {
                if($item->image != null)
                {
                    $this->deleteFile($item->image,config('filepath.ADS_PATH'));
                    $item->delete();
                }
            }
            return response()->json([
                'data'=>null,
                'message'=>'success',
                'status'=>200                
            ]);
        }catch(Exception $e)
        {
            return response()->json([
                'data'=>null,
                'message'=>$e->getMessage(),
                'status'=>400                
            ],400);
        }
    }

    public function deleteFavorite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'access_token'=>'required',
            'advertisment_id'=>'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(
                [
                    'status'=>403,
                    'message'=>'Validation error',
                    'data'=>$errors
                ],403);
        }
        $data = $this->adsFavorite->where('user_id',$this->auth($request->access_token)->id)->get()
        ->where('advertisment_id',$request->advertisment_id);
        if($data)
        {
            $data->delete();
        }else{
            return response()->json(
                [
                    'status'=>404,
                    'message'=>'Data Not Found',
                    'data'=>null
                ],404);
        }
        return response()->json([
            'status'=>200,
            'message'=>'Success',
            'data'=>null
        ]);
    }
}
