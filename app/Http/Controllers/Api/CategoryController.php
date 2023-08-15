<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CityResource;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    protected $model;
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        return CategoryResource::collection($this->model->filter($request->type)->get());
    }

    public function city()
    {
        return CityResource::collection(City::all());
    }
}
