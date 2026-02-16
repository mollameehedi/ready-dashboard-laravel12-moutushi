<?php

namespace App\Http\Controllers\Admin\website;

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
    // Show profile page
    public function index()
    {
       
        return view('admin.pages.profile.index');
    }
    // Update profile info (name, email, number)
 
    public function update(UpdateProfile $request)
    {
        $profile_update = new Profile();
        $profile_update->update($request);
        return back()->with('success','Profile Updated Successfully');
    }
    public function password(Request $request)
    {
        $profile_update = new Profile();
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

      return redirect()->route('dashboard.index')
                 ->with('success', 'Profile image updated successfully!');
    }
}