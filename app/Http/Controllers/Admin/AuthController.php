<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function loginView()
    {
        return view('dashboard.login');
    }

    public function login(AuthRequest $request)
    {
        $data = $request->validated();
        if(Auth::guard('admin')->attempt($data))
        {
            return redirect()->route('admin.home')->with('error','Invaild Email or Password');
        }else{
            return redirect()->back()->with('error','Invaild Email or Password');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }


}
