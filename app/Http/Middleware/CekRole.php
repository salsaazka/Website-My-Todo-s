<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekRole
{
    

    //...$roles -> untuk mengubah data yang dikirim ke middleware menjadi bentukan array
    public function handle(Request $request, Closure $next, ...$roles)
    {
        //cek apakah parameter yang dikirim dari route tadi terdapat role yang dimiliki user yang login, kalau ya diperbolehkan akses
        if(in_array(Auth::user()->role, $roles)){
            return $next($request);
        }
        //kalau tidak akan diarahkann ke halaman error not found
        return redirect('/error');
    }
}
