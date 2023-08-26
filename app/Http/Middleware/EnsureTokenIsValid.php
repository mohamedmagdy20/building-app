<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        if($request->access_token)
        {
           if($request->access_token !== null)
           {
               $user = User::where('access_token',$request->access_token)->first();
               if($user !== null)
               {
                  return $next($request,$user);
               }
               else
               {
               return response()->json( [
                   'status'  => '403',
                   "message" => "This Access Token Is Not Correct",
                   'data'   => NULL

               ],403);
               }
           }
           else
           {
           return response()->json([
               'status'  => '400',
               "message" => "This Access Token Is Empty",
               'data'   => NULL

           ],400);
           }
        }
        else
        {
        return response()->json([
           'status'  => '403',
           "message" => "There Is No Access Token ",
           'data'   => NULL

        ],403);
        }
    }
}
