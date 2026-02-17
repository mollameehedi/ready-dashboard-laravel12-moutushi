<?php
namespace App\Http\Controllers\Admin;
use App\Enums\Common\CurrencyPossition;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Page;
use App\Helpers\ImageHelper;

class SettingController extends Controller
{
    public function index()
    {
        $data['timezones'] = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        $data['currencyPossition'] = CurrencyPossition::asSelectArray();
        return view('admin.pages.settings.general.index')->with($data);
    }
    public function update(Request $request)
     {
    // Validate the request data (important!)
    $validatedData = $request->validate([
        'website_name' => 'required|string|max:255',
        'website_description' => 'required|string',
        'email' => 'required|email',
        'number' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'currency' => 'required|string|max:4',
        'currency_position' => 'required|in:1,2',
        'inside_dhaka' => 'required|numeric|min:1',
        'outside_dhaka' => 'required|numeric|min:1',
        'footer_text' => 'nullable|string',
        'shop_banner' => 'nullable|image',
    ]);

    // Update settings using the helper function
    $this->setting_update('website_name', $validatedData['website_name']);
    $this->setting_update('website_description', $validatedData['website_description']);
    $this->setting_update('email', $validatedData['email']);
    $this->setting_update('number', $validatedData['number'] ?? null);
    $this->setting_update('address', $validatedData['address'] ?? null);
    $this->setting_update('currency', $validatedData['currency'] ?? null);
    $this->setting_update('currency_position', $validatedData['currency_position'] ?? null);
    $this->setting_update('inside_dhaka', $validatedData['inside_dhaka'] ?? null);
    $this->setting_update('outside_dhaka', $validatedData['outside_dhaka'] ?? null);
    $this->setting_update('footer_text', $validatedData['footer_text'] ?? null);

    if ($request->hasFile('shop_banner')) {
       $setting = Setting::firstOrCreate(['name' => 'shop_banner'], ['value' => 'shop_banner']);
        if ($setting->hasMedia('shop_banner')) {
            $setting->clearMediaCollection('shop_banner');
        }
         ImageHelper::uploadImage($setting, $request, 'shop_banner');
     }

    return back()->with('success', 'General Settings Updated Successfully!!');
     }

    // ... your setting_update helper function ...


    public function appearance()
    {
        return view('admin.pages.settings.appearance');
    }
    public function appearanceUpdate(Request $request)
    {
        if ($request->hasFile('website_logo')) {
             $setting = Setting::firstOrCreate(['name' => 'website_logo'], ['value' => 'website_logo']);
            if ($setting->hasMedia('website_logo')) {
                $setting->clearMediaCollection('website_logo');
            }
             ImageHelper::uploadImage($setting, $request, 'website_logo');
         }

         // favicon update
        if ($request->hasFile('website_favicon')) {
             $setting = Setting::firstOrCreate(['name' => 'website_favicon'], ['value' => 'website_favicon']);
            if ($setting->hasMedia('website_favicon')) {
                $setting->clearMediaCollection('website_favicon');
            }
             ImageHelper::uploadImage($setting, $request, 'website_favicon');
         }

        return back()->with('success', 'Settings Updated Successfully');
    }

    private function deleteOldLogo($path)
    {
        // Storage::disk('public')->delete($path);
    }
    public function social_media()
    {
        return view('admin.pages.settings.social_media');
    }
    public function social_media_update(Request $request)
    {
        $validatedData = $request->validate([

            'facebook_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
        ]);

        $this->setting_update('facebook_link', $validatedData['facebook_link'] ?? null);
        $this->setting_update('twitter_link', $validatedData['twitter_link'] ?? null);
        $this->setting_update('youtube_link', $validatedData['youtube_link'] ?? null);
        $this->setting_update('instagram_link', $validatedData['instagram_link'] ?? null);


        return back()->with('success', 'Settings Updated Successfully!');
    }
    public function meta_tag()
    {
        return view('admin.pages.settings.meta_tag');
    }
    public function meta_tag_update(Request $request)
    {
        $validatedData = $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keyword' => 'nullable|string|max:255',
        ]);

        $this->setting_update('meta_title', $validatedData['meta_title'] ?? null);
        $this->setting_update('meta_description', $validatedData['meta_description'] ?? null);
        $this->setting_update('meta_keyword', $validatedData['meta_keyword'] ?? null);

        return back()->with('success', 'Meta Tags Updated Successfully!');
    }
    public function fb_pixel()
    {
        return view('admin.pages.settings.fb_pixel');
    }
    public function fb_pixel_update(Request $request)
    {
        $validatedData = $request->validate([
            'fb_pixel' => 'nullable|string|max:255',
        ]);

        $this->setting_update('fb_pixel', $validatedData['fb_pixel'] ?? null);

        return back()->with('success', 'Pixels Updated Successfully!');
    }
    public function gtm()
    {
        return view('admin.pages.settings.gtm');
    }
    public function gtm_update(Request $request)
    {
        $validatedData = $request->validate([
            'gtm' => 'nullable|string|max:255',
        ]);

        $this->setting_update('gtm', $validatedData['gtm'] ?? null);

        return back()->with('success', 'Gtm Updated Successfully!');
    }

    public function page()
    {
        $pages = Page::all();
        return view('admin.pages.website.pages.index',compact('pages'));
    }

    public function pageEdit($slug)
    {
        $page = Page::where('slug',$slug)->firstOrFail();
        return view('admin.pages.website.pages.form',compact('page'));
    }
    public function pageupdate(Request $request,$slug)
    {
        $page = Page::where('slug',$slug)->firstOrFail();
        $page->update([
            'description'=>$request->description
        ]);
        return back()->with('success', 'Update successfully');
    }



      public function map()
    {
        return view('admin.pages.website.map');
    }
    public function map_update(Request $request)
    {
        $validatedData = $request->validate([
            'map_location' => 'nullable|string|max:1024',
        ]);

        $this->setting_update('map_location', $validatedData['map_location'] ?? null);

        return back()->with('success', 'Gtm Updated Successfully!');
    }


    private function setting_update($name,$value){
        if($value){
            Setting::updateOrCreate(['name' => $name], ['value' => $value]);
        }
    }




}
