<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Advertise;
use App\Models\Advertisment;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public $model;
    public $userModel;
    public function __construct(Advertisment $model, User $userModel)
    {
        $this->model = $model;
        $this->userModel = $userModel;
    }
    public function index()
    {
        $users = $this->userModel::count();
        // $advertisments = Advertisment::with('user')->where('abroved',0)->where('created_at',Carbon::today())->get();
        $ads = Advertise::count();
        $advertisments = $this->model::count();
        return view('dashboard.index',['advertisments'=>$advertisments,'users'=>$users,'ads'=>$ads]);
    }

    public function getType()
    {
        $rent = $this->model->rent()->count();
        $sale = $this->model->sale()->count();
        $instead = $this->model->instead()->count();
        $data = ['rent'=>$rent,'sale'=>$sale,'instead'=>$instead];
        return response()->json($data);
    }

    public function getAcountType()
    {
        $normal = $this->userModel->normal()->count();
        $permium = $this->userModel->premium()->count();
        $data = ['normal'=>$normal,'permium'=>$permium];
        return response()->json($data);
    }

    public function getUserType()
    {
        $company = $this->userModel->company()->count();
        $personal = $this->userModel->personal()->count();
        $data = ['company'=>$company,'personal'=>$personal];
        return response()->json($data);
    }

    public function getAdvertismentStatus()
    {
        $fixed = $this->model->fixed()->count();
        $special = $this->model->special()->count();
        $normal = $this->model->normal()->count();
        $draft = $this->model->draft()->count();
        $data = ['fixed'=>$fixed,'special'=>$special,'normal'=>$normal,'draft'=>$draft];
        return response()->json($data);
    }

    public function getCategoryType()
    {
        $data = [
            'residential'=>$this->model->whereHas('category',function($q){$q->where('type','residential');})->count(),
            'commercial_units'=>$this->model->whereHas('category',function($q){$q->where('type','commercial_units');})->count(),
            'commercial'=>$this->model->whereHas('category',function($q){$q->where('type','commercial');})->count(),
            'investment'=>$this->model->whereHas('category',function($q){$q->where('type','investment');})->count(),
            'industrial'=>$this->model->whereHas('category',function($q){$q->where('type','industrial');})->count(),
            'chalet'=>$this->model->whereHas('category',function($q){$q->where('type','chalet');})->count(),
            'farm'=>$this->model->whereHas('category',function($q){$q->where('type','farm');})->count(),
            'break'=>$this->model->whereHas('category',function($q){$q->where('type','break');})->count(),
            'lands'=>$this->model->whereHas('category',function($q){$q->where('type','lands');})->count(),
        ];
        return response()->json($data);
        
    }    
}
