<?php

namespace App\Http\Controllers\Front;

use App\Enums\Product\ProductHighLight;
use App\Http\Controllers\Controller;
use App\Models\Order\OrderDetails;
use App\Models\Product\Category;
use App\Models\Product\FlashSale;
use App\Models\Product\Product;
use App\Models\Product\SubCategory;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cookie;

class ProductCotroller extends Controller
{
    public function index(Request $request){
        $products = Product::active();
        $banner = setting_img('shop_banner');
        $title = 'All Products';
        if($request->category){
            $category = Category::where('slug',$request->category)->firstOrFail();
            $products->where('category_id',$category->id);
            $banner = get_image_url($category,'banner_image');
            $title = $category->name;
        }
        if($request->sub_category){
            $subcategory = SubCategory::where('slug',$request->sub_category)->first();
            $products->where('sub_category_id',$subcategory->id);
            $banner = $banner = get_image_url($subcategory->category,'banner_image');
            $title = $subcategory->name;
        }
        if($request->filled('highlight')){
            if($request->highlight == 'new'){
                $products->where('highlight',ProductHighLight::New->value);
            }elseif($request->highlight == 'best'){
                $products->where('highlight',ProductHighLight::Best->value);
            }elseif($request->highlight == 'popular'){
                $products->where('highlight',ProductHighLight::Popular->value);
            }
        }
        if($request->filled('flash_sale')){
           $products =  $products->flashAvailable();
           $flash_sale = FlashSale::active();
            $banner = get_image_url($flash_sale,'image');
        }

        $shop_info = [
            'banner' => $banner,
            'title' =>  $title
        ];

        // if ($request->search) {
        //     $products = $products->where('title', 'like', '%' . $request->search . '%')->orWhere('long_description', $request->search);
        // }

        $data['shop_info'] = $shop_info;
        $data['products'] = $products->paginate(24);
        $data['categories'] = Category::with(['subCategories:id,slug,name,category_id'])->latest()->get();
        return view('frontend.pages.product.index')->with($data);
    }

    public function details($slug){
        $product = Product::where('slug',$slug)->active()->firstOrFail();
        $reviews = OrderDetails::where('product_id',$product->id);
        $my_review = false;
        if(Auth::check()){
            $my_review = $this->own_review($reviews) ;
        }
        $reviews = $reviews->whereNotNull('rating')->get();
        $related_products = Product::where('category_id', $product->category_id)->active()->latest()->take(10)->get();
        return view('frontend.pages.product.details',compact('product','related_products','reviews','my_review'));
    }
    public function review(Request $request,$id){

        $order_details = OrderDetails::where('product_id', $id)->whereNull('rating')
        ->whereHas('order', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->first();
        if($order_details){
            $order_details->rating = $request->stars;
            $order_details->review = $request->review;
            $order_details->save();
        }
        return response()->json([
            'status' => 201,
            'success' => true,
            'message' => "Review Submitted Successfully",
        ]);
    }
    private function own_review($reviews){

         return  $reviews->clone()->whereNull('rating')->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->exists();
    }
}
