<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        // Kullanıcı giriş yapmış mı ve rolü admin mi kontrol et
        if (Auth::check() && Auth::user()->role_id === 0) {
            // Eğer admin ise, istenen sayfaya erişime izin ver
            // İsteğe bağlı olarak admin dashboard'a yönlendirme yapabilirsiniz
            // return redirect('/admin/dashboard');
            
            // Eğer sadece erişime izin vermek istiyorsanız, 
            // $next($request) ile devam edin
            return $next($request);
        }

        abort(403, 'Bu sayfaya erişim yetkiniz yok.');
    }
}


