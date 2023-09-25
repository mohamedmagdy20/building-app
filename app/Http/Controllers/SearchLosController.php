<?php

namespace App\Http\Controllers;

use App\Models\SearchLogs;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SearchLosController extends Controller
{
    //
    protected $model;
    public function __construct(SearchLogs $model)
    {
        $this->model = $model;
    }
    public function index()
    {
        return view('dashboard.searchlogs.index');
    }
    
    public function data()
    {
        $data = $this->model->with('user')->with('advertisment')->where('advertisment_id','!=',null)->latest();
        return DataTables::of($data)->editColumn('advertisment_id',function($data){
            return optional($data->advertisment)->title;
    })->make(true);
    }
}
