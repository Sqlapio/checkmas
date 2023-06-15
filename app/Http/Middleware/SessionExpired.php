<?php

namespace App\Http\Middleware;

use App\Http\Controllers\UtilsController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionExpired
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
        if(Auth::check()){
            $id = Auth::user()->id;
            $data = DB::table('sessions')->where('user_id', $id)->get();
                foreach($data as $item){
                    $last_activity = $item->last_activity;
                }
            $res = $last_activity + 10;
            if(time() > $res){
                $user = Auth::user();
                UtilsController::userInactivo($user->id);
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                $request->session()->flush();
                return redirect('/logout');
            }
        }
        
        return $next($request);
    }
}
