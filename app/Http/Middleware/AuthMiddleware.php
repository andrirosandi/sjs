<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $redirect=null;
        $url = $request->fullUrl();

        if (strpos($url, '/auth/login') === false) {
            $redirect = base64_encode($url);
        }

        $user = session('user');
        if ($user !== null) {
            if(isset( (User::where('id', $user->id)->get())[0])) {
                
                return $next($request);
            }
            else{
                session()->forget('user');
            }
            
        }
        
        return redirect('/auth/login'.($redirect !== null ? '?redirect='.$redirect:''));
        
        // Lanjutkan permintaan
        
    }
}
