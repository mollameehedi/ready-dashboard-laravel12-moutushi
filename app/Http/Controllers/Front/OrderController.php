<?php

namespace App\Http\Controllers\Front;

use App\Enums\Finance\PaymentMethod;
use App\Enums\Finance\PaymentStatus;
use App\Enums\Order\DelivaryArea;
use App\Enums\Order\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Order\OrderDetails;
use App\Models\Product\Product;
use App\Models\User;
use App\Services\CouponCalculationService;
use App\Services\FlashSaleService;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Throwable;

class OrderController extends Controller
{
        protected $flashSaleService;
        protected $couponCalculationService;

    /**
     * Constructor for dependency injection.
     *
     * The FlashSaleService is automatically resolved by the service container.
     *
     * @param FlashSaleService $flashSaleService
     */
    public function __construct(FlashSaleService $flashSaleService,CouponCalculationService $couponCalculationService)
    {
        $this->flashSaleService = $flashSaleService;
        $this->couponCalculationService = $couponCalculationService;
    }


    public function cart()
    {
        return view('frontend.pages.cart.cart');
    }

    public function checkout()
    {
        return view('frontend.pages.cart.checkout');
    }

    public function store(Request $request)
    {
        $this->validateOrderRequest($request);
         try {
            DB::beginTransaction();
            // 3. Create the main order record.
            $order = $this->createMainOrder($request);

            // 4. Process each item in the cart, create order details, and update product stock.
            $totalAmount = $this->processOrderItems($order);
            // 5. Update the order with the final calculated total and user ID.
            $order->amount = $totalAmount;
            if (Auth::check()) {
                $order->user_id = Auth::id();
                if($request->filled('coupon_code')){
                    $order->discount = $this->couponCalculationService->calculateDiscount($request->coupon_code,$totalAmount,'create');

            }
            }
            $order->save();

            // 6. Clear the cart session and commit the transaction.
            Session::forget('cart');
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order Placed Successfully',
                'order_number' => $order->order_number,
                'redirect_url' => route('front.order.details', $order->order_number)
            ]);
        } catch (Throwable $th) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Failed to place your order. Please try again.'.$th->getMessage(),
            ], 500);
        }


    }

    public function details($id)
    {
        $order = Order::where('order_number',$id)->firstOrFail();
        $order->update([
            'view'=>$order->view + 1,
        ]);
        return view('frontend.pages.tracking.index',compact('order'));
    }


    private function createMainOrder(Request $request)
    {
        $area = ($request->location == setting('outside_dhaka')) ? DelivaryArea::OutOfDakha->value : DelivaryArea::InOfDhaka->value;
       $orderNumber = Str::substr(Str::uuid(), 0, 10); // Use UUID for unique order number

        return Order::create([
            'order_number' => $orderNumber,
            'name' => $request->name,
            'phone' => $request->number,
            'email' => $request->email,
            'address' => $request->address,
            'message' => $request->message,
            'delivary_area' => $area,
            'shipping_charge' => $request->location,
            'payment_status' => PaymentStatus::UnPaid->value,
            'order_status' => OrderStatus::Pending->value,
            'payment_method' => PaymentMethod::Cash->value,
        ]);
    }


  private function processOrderItems(Order $order)
    {
        $total = 0;
        foreach (session('cart') as $id => $item) {
            $product = Product::with('flashSaleProduct.flashSale')->find($item['id']);

            // Skip if product not found
            if (!$product) {
                continue;
            }

            // Determine the final product price based on flash sale
            $price =  $this->flashSaleService->getPriceAndDecrementStock($product, $item['quantity']);;

            // Create the order details record
            $order->orderDetails()->create([
                'order_number' => $order->order_number,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'title' => $product->title,
                'price' => $price,
                'model' => $item['model'],
                'color' => $item['color'],
                'size' => $item['size'],
                'flash_sale_id' => $product->flashSaleProduct?->flash_sale_id,
            ]);

            // Update product's sell count and decrement quantity
            $product->decrement('quantity', $item['quantity']);

            // Calculate total amount for the order
            $total += $price * $item['quantity'];
        }
        return $total;
    }




    private function user_register($request)
    {
        $user =  User::create([
            'name' => $request->name,
            'number' => $request->number,
            'password' => Hash::make($request->password),
        ]);
        return $user;
    }

      private function validateOrderRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|string',
            'address' => 'required|max:250|string',
            'number' => 'required|digits:11|numeric',
            'email' => 'nullable|email|max:100|string',
            'message' => 'nullable|max:250|string',
            'location' => [
                'required',
                'numeric',
                Rule::in([setting('outside_dhaka'), setting('inside_dhaka')]),
            ],
        ]);
    }
}
