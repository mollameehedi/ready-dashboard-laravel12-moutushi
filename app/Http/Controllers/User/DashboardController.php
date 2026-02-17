<?php

namespace App\Http\Controllers\User;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\User;
use App\Trait\CRUD\CrudOparation;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use CrudOparation;
    public function index()
    {
        $total_order = Order::where('user_id',Auth::id())->count();
        $pending_order = Order::where('user_id',Auth::id())->pending()->count();
        $cancel_order = Order::where('user_id',Auth::id())->cancel()->count();
        $compleate_order = Order::where('user_id',Auth::id())->delivered()->count();
        return view('user.pages.dashboard',compact('total_order','pending_order','cancel_order','compleate_order'));
    }
    public function history()
    {
        $orders = Order::where('user_id',Auth::id())->latest()->get();

        return view('user.pages.history',compact('orders'));
    }
    public function profile()
    {
        return view('user.pages.profile');
    }
    public function store(Request $request)
    {
       $request->validate([
        'name'=>'required|max:50',
        'number'=>'required|numeric|digits:11',
        'email'=>'nullable|max:50',
        'address'=>'nullable|max:255',
        'image'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);
    $user = User::find(Auth::id());

    $user->name = $request->name;
    $user->number = $request->number;
    $user->email = $request->email;
    $user->address = $request->address;

    $user->save();

    if ($request->hasFile('image')) {
        if ($user->hasMedia('image')) {
            $user->clearMediaCollection('image');
        }
         ImageHelper::uploadImage($user, $request, 'image');
     }
    return back()->with('success','Profile Updated Successfully!!');
    }
}
