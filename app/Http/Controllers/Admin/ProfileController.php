<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController as Profile;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Profile\UpdateProfile;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.pages.profile.index');
    }
    public function update(UpdateProfile $request)
    {
        $profile_update =  auth()->user();
        
          $profile_update->update($request->validated());
        return back()->with('success','Profile Updated Successfully');
    }
    public function password(Request $request)
    {
        $profile_update =  auth()->user();
        $profile_update->password($request);
        return back();
    }

    public function image(Request $request)
    {
        $user = User::find(Auth::id());
        if ($request->hasFile('avatar')) {
            if ($user->hasMedia('avatar')) {
                $user->clearMediaCollection('avatar');
            }
             ImageHelper::uploadImage($user, $request, 'avatar');
         }
        return back()->with('success','Image Updatee Successfully');
    }
}
