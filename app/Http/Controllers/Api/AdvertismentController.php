<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertismentRequest;
use App\Http\Resources\AdvertismentResource;
use App\Models\Advertisment;
use App\Models\AdvertismentImage;
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
    public function __construct(Advertisment $model , AdvertismentImage $modelImage)
    {
        $this->model = $model;
        $this->modelImage =$modelImage;
    }
    public function store(AdvertismentRequest $request)
    {
        $data = $request->validated();
        try{
            DB::beginTransaction();
            $ads =$this->model->create(array_merge($data,['user_id'=>$this->auth($request->access_token)->id]));
            foreach($request->file('image') as $image)
            {
                $imageName = $this->saveFile($image,config('filepath.ADS_PATH'));
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
        $data = $this->model->find($request->get('id'));
        if($data)
        {
            return response()->json(
                [
                    'status'=>200,
                    'message'=>'Success',
                    'data'=> new AdvertismentResource($data)
                ]
            );
        }else{
            return response()->json(
                [
                    'status'=>404,
                    'message'=>'Not Found',
                    'data'=> null
                ]
            );
        }
        
    }

    public function specialAds(Request $request)
    {
        return response()->json([
            'status'=>200,
            'message'=>'Success',
            'data'=>AdvertismentResource::collection($this->model->special()->latest()->get())
        ], 200);
    }

    public function index(Request $request)
    {
        $data = $this->model->orderByRaw("FIELD(ads_type, 'fixed', 'normal')")->filter($request->all())->latest()->simplePaginate(7);
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
