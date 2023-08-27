<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    //
    /** --------------------------------------------------------------- **/
     // API
     public function AllAdvertises()
     {
         $Advertisements = Advertise::simplePaginate(7);
         return response()->json([
         'status'  => 200,
         'message' => "This Is All Advertisements",
         'data'    => $Advertisements
       ]);
     }
 /** --------------------------------------------------------------- **/
    // WEB
    protected $model;
    public function __construct(Advertise $model)
    {
        $this->model = $model;
    }
    public function AllAdvertise()
    {
     $data = $this->model->latest()->get();
     return view('dashboard.Advertises.index',['data'=>$data]);
    }
    public function AddAdvertise()
    {
     return view('dashboard.Advertises.create');
    }
    public function storeAdvertise(Request $request)
    {
     $request->validate([
         'url' => 'required|string',
         'image' => 'required|image|mimes:jpg,png',
     ]);
     $image = $request->file('image');
     $ext   = $image->getClientOriginalExtension();
     $original_file_name = "ads-". uniqid() . ".$ext";
     $imagename = asset('uploads/adsUrl/' .$original_file_name );
     $image->move( public_path('uploads/adsUrl') , $imagename);
     $book = Advertise::create([
         'url' => $request->url,
         'image' => $imagename
     ]);
     return redirect( route('admin.Advertise.index') )->with('success','Added');
    }
    public function EditAdvertise($id)
    {
     $Advertise = Advertise::findOrFail($id);
     return view('dashboard.Advertises.edit',compact('Advertise'));
    }
    public function updateAdvertise(Request $request, $id)
    {
     $Advertise = Advertise::findOrFail($id);
     $name = $Advertise->img;
     if($request->hasFile('image'))
     {
         if($name !== null)
         {
             unlink( public_path('uploads/adsUrl/') . $name );
         }
 
         $image = $request->file('image');
         $ext   = $image->getClientOriginalExtension();
         $original_file_name = "ads-". uniqid() . ".$ext";
         $imagename = asset('uploads/adsUrl/' .$original_file_name );
         $image->move( public_path('uploads/adsUrl') , $imagename);
     }
     $Advertise->update([
         'url' => $request->url,
         'image' => $imagename
     ]);
     return redirect( route('admin.Advertise.index', $id) )->with('success','Updated');
    }
    public function DeletetaskAdvertise($id)
    {
     $Advertise = Advertise::findOrFail($id);
 
     $Advertise->delete();
 
     return redirect( route('admin.Advertise.index') )->with('success','Deleted');
    }
}
