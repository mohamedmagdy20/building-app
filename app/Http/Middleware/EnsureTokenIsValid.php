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
        if($request->header('access_token'))
        {
           if($request->header('access_token') !== null)
           {
               $user = User::where('access_token', $request->header('access_token'))->first();
               if($user !== null)
               {
               return $next($request);
               }
               else
               {
               return response()->json( [
                   'status'  => '404',
                   "message" => "This Access Token Is Not Correct",
                   'data'   => NULL

               ]);
               }
           }
           else
           {
           return response()->json([
               'status'  => '404',
               "message" => "This Access Token Is Empty",
               'data'   => NULL

           ]);
           }
        }
        else
        {
        return response()->json([
           'status'  => '404',
           "message" => "There Is No Access Token ",
           'data'   => NULL

        ]);
        }
    }
}
