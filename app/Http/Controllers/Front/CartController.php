<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CartCreateRequest;
use App\Models\Product\Product;
use App\Services\PriceCalculationService;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
     protected $priceCalculationService;

     public function __construct(PriceCalculationService $price_calculation_service)
     {
    $this->priceCalculationService =  $price_calculation_service;
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session()->has('cart')) {
            if (empty(session('cart'))) {
                return redirect()->route('front.shop.index')->with('warning','No Product in cart');
            } else {
                return view('frontend.pages.cart.index');
            }
        } else {
            return redirect()->route('front.shop.index')->with('warning','No Product in cart');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $request->validate([
            'color' => 'nullable|string',
            'size' => 'nullable|string',
            'model' => 'nullable|string',
            'id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $if_buy = false;
        $product = Product::findOrFail($request->id);
        $price = $this->priceCalculationService->calculatePrice($product);
        $cart = session()->get('cart', []);

                $itemKey = $product->id . '-' .
                ($request->color ?? '') . '-' .
                ($request->size ?? '') . '-' .
                ($request->model ?? '');

        // Check if an item with the same unique key already exists in the cart.
        if (isset($cart[$itemKey])) {
            // If it exists, just update the quantity.
            $cart[$itemKey]['quantity'] += $request->quantity;
        } else {
            // If it's a new item, add it to the cart with the unique key.
            $cart[$itemKey] = [
                "image" => get_image_url($product, 'image'),
                "name" => $product->title,
                "quantity" => $request->quantity,
                "price" => $price,
                "id" => $product->id,
                "slug" => $product->slug,
                "model" => $request->model ?? '',
                "color" => $request->color ?? '',
                "size" => $request->size ?? '',
            ];
        }
        // --- Core Changes End Here ---

        session()->put('cart', $cart);

        if (isset($request->buy)) {
            $if_buy = true;
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart!',
            'is_buy' => $if_buy,
            'code' => 200,
            'data' => $cart
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($id && $request->quantity){
             $cart = session()->get('cart', []);

                $itemKey = $id . '-' .
                ($request->color ?? '') . '-' .
                ($request->size ?? '') . '-' .
                ($request->model ?? '');
        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity'] = $request->quantity;
           session()->put('cart', $cart);
        }
        }
        return response()->json([
            'status'=>"success",
            'message' => 'Cart Updated Successfully!!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
        return response()->json([
            'status'=>"success",
            'message' => 'Cart Product Removed Successfully!'
        ]);
    }
}
