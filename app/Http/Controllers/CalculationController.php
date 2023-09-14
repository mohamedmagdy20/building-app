<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Calculation;
use App\Models\SiteSpecfication;
use Illuminate\Http\Request;

class CalculationController extends Controller
{
    //
    public $model;
    public function __construct(Calculation $model)
    {
        $this->model = $model;
    }
    public function index(){
        $data = $this->model->latest()->get();
        return view('dashboard.calculation.index',['data'=>$data]);
    }

    public function update(Request $request)
    {
        $data = $this->model->findOrFail($request->id);
        $data->update(['value'=>$request->value]);
        return response()->json([
            'status'=>true,
            'message'=>'Updated' 
        ]);
    }


    public function calculate(Request $request)
    {
        $sum = 0;
        $areaPrice = Area::findOrFail($request->area_id)->price;
        $space =  Calculation::where('key',$request->space)->first();

        $type = Calculation::where('key',$request->type)->first();
        
        $base = $areaPrice * $space->value;

        $sum = $base + $type;

        $calcIDs = explode(',',$request->calcs);  
        $specficationIDs = explode(',',$request->spcfications);

        $calcData = Calculation::whereIn('id',$calcIDs)->get();
        foreach($calcData as $item)
        {
            $sum += $item->value;
        }

        $spcficationData = SiteSpecfication::whereIn('id',$specficationIDs)->get();
        foreach($spcficationData as $item)
        {
            $sum += $item->value;
        }
        
        return response()->json([
            'data'=>$sum,
            'status'=>200,
            'message'=>'success'
        ]);

    }



}
