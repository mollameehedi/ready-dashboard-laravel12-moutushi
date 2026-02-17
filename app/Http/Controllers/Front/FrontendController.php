<?php

namespace App\Http\Controllers\Front;

use App\Enums\Common\BooleanStatus;
use App\Enums\Product\ProductHighLight;
use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Page;
use App\Models\Product\Category;
use App\Models\Product\FlashSale;
use App\Models\Product\Product;
use App\Models\Website\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $data['categories'] = Category::shortData()->latest()->take(15)->get();
        $data['feature_categories'] = Category::activeFeature()->take(5)->get();
        $data['best_products'] = Product::shortData()->best()->take(10)->get();
        $data['popular_products'] = Product::shortData()->popular()->take(10)->get();
        $data['latest_product'] = Product::shortData()->new()->take(10)->get();
        $data['flashSales'] = FlashSale::with('flashProduct.product')->active();
        $data['banners'] = Banner::active()->latest()->take(10)->get();
            $data['flash_sale'] = FlashSale::activeFlash()
                                ->first();
              $data['flash_products'] =    Product::flashAvailable()->get();
        return view('frontend.pages.home.index')->with($data);
    }

    public function item(Request $request)
    {
        $product = Product::find($request->id);

        return response()->json([
            'product' => ([
                'id'=>$product->id,
                'image'=> get_image_url($product,'image'),
                'title'=>$product->title,
                'category'=>$product->category?->name,
                'price'=>$product->final_price,
                'short_description'=>$product->short_description,
                'models'=>json_decode($product->models),
                'colors'=>json_decode($product->colors),
                'sizes'=>json_decode($product->sizes),
            ]),
        ]);
    }

public function pages(){
        $currentRoute = request()->path();
        $page = Page::where('slug',$currentRoute)->firstOrFail();
            return view('frontend.pages.page',compact('page'));
        }
        public  function track(Request $request){
            $data = [];
            if($request->filled('order_number')){
            $request->validate([
                    'order_number' => 'required|string|max:255',
            ]);
                $orderNumber = $request->input('order_number');
        $data['order'] = Order::where('order_number', $orderNumber)->first();
            }
            return view('frontend.pages.tracking.track')->with($data);
        }

          public function trackOrder(Request $request)
    {
        // Validate the request to ensure the order number is present
        $request->validate([
            'order_number' => 'required|string|max:255',
        ]);
        $orderNumber = $request->input('order_number');
        $order = Order::where('order_number', $orderNumber)->first();
        return view('frontend.pages.tracking.track', compact('order'));
    }
}
