<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Helpers\ImageHelper;
use App\Http\Requests\Admin\About\MessageUpdateRequest;

class AboutController extends Controller
{
    public function index(){
        return view('admin.pages.website.about');
    }
    
    public function update(Request $request){
        $validatedData = $request->validate([
            'about_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Make nullable
            'about_title' => 'required|string',
            'about_description' => 'required|string',
            'vission_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Make nullable
            'vission_title' => 'required|string',
            'vission_description' => 'required|string',
            'mission_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Make nullable
            'mission_title' => 'required|string',
            'mission_description' => 'required|string',
        ]);

 // about_img update
 if ($request->hasFile('about_img')) {
    $setting = Setting::where('name', 'about_img')->firstOrFail();
    if ($setting->hasMedia('about_img')) {
        $setting->clearMediaCollection('about_img');
    }
     ImageHelper::uploadImage($setting, $request, 'about_img');
 }

    Setting::updateOrCreate(['name' => 'about_title'], ['value' => $validatedData['about_title']]);
    Setting::updateOrCreate(['name' => 'about_description'], ['value' => $validatedData['about_description']]);




     // about_img update
     if ($request->hasFile('vission_img')) {
        $setting = Setting::where('name', 'vission_img')->firstOrFail();
        if ($setting->hasMedia('vission_img')) {
            $setting->clearMediaCollection('vission_img');
        }
         ImageHelper::uploadImage($setting, $request, 'vission_img');
     }
    Setting::updateOrCreate(['name' => 'vission_title'], ['value' => $validatedData['vission_title']]);
    Setting::updateOrCreate(['name' => 'vission_description'], ['value' => $validatedData['vission_description']]);

     // about_img update
     if ($request->hasFile('mission_img')) {
        $setting = Setting::where('name', 'mission_img')->firstOrFail();
        if ($setting->hasMedia('mission_img')) {
            $setting->clearMediaCollection('mission_img');
        }
         ImageHelper::uploadImage($setting, $request, 'mission_img');
     }
    Setting::updateOrCreate(['name' => 'mission_title'], ['value' => $validatedData['mission_title']]);
    Setting::updateOrCreate(['name' => 'mission_description'], ['value' => $validatedData['mission_description']]);




    return back()->with('success', 'About Updated Successfully!!');
    }


private function setting_update($name, $value)
{
    if ($value) {
        Setting::updateOrCreate(['name' => $name], ['value' => $value]);
    }
}
}
