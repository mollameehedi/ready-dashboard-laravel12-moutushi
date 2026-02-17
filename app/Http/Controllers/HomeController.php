<?php

namespace App\Http\Controllers;

use App\Enums\Common\Role;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (Auth::user()->role == Role::Admin->value) {
            return redirect('admin/dashboard');
        }

        return redirect('/');
    }
    public function privacy()
    {
        $page = Page::where('slug','privacy-policy')->firstOrFail();
        return view('auth.page',compact('page'));
    }
    public function terms()
    {
        $page = Page::where('slug','terms-and-condition')->firstOrFail();
        return view('auth.page',compact('page'));
    }
}
