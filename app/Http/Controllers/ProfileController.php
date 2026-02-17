<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('global.profile.index');
    }
    public function update($request)
    {
        $user = User::find(Auth::id());
        if ($request->hasFile('avatar')) {
        $user->clearMediaCollection('avatar');
        $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->number = $request->number;
        $user->address = $request->address;
        $user->save();
        return back();
    }
    
       public function password($request)
        {
        $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        #Match The Old Password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            Toastr::error("Old Password Doesn't match!", 'error');
            return back();
        }
        #Update the new Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->password)
        ]);
        Toastr::success("Password Change Successfully !!", 'Changed');
        return back();
    }
}
