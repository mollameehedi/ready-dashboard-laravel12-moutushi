<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon; // Import the Coupon model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; // Required for unique validation rules
use App\Enums\Common\ActiveStatus;
use App\Enums\CouponType;
use App\Http\Requests\Admin\CouponRequest;
use App\Trait\CRUD\CrudOparation;

// use App\Trait\CRUD\CrudOparation; // Uncomment if you have this trait

class CouponController extends Controller
{

    use CrudOparation;
    // use CrudOparation; // Uncomment and ensure this trait is correctly defined and imported

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // This part would typically use a DataTableQuery class, similar to CategoryQuery::get($request)
            // For now, I'll provide a basic DataTables response.
            $data = Coupon::select([
                'id',
                'code',
                'name',
                'type',
                'value',
                'min_amount',
                'expires_at',
                'usage_limit',
                'usage_count',
                'is_active',
                'created_at'
            ])->orderBy('created_at', 'desc')->get();

            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('type', function ($row) {
                    // Assuming 1 for fixed, 2 for percentage based on your migration
                    return $row->type == 1 ? 'Fixed' : 'Percentage';
                })
                ->addColumn('value', function ($row) {
                    return $row->type == 1 ? price(number_format($row->value, 2)) : number_format($row->value, 2) . '%';
                })
                ->addColumn('expires_at', function ($row) {
                    return $row->expires_at ? $row->expires_at->format('M d Y h:i A') : 'N/A';
                })
                ->addColumn('is_active', function ($row) {
                    $status = '<span class="badge bg-danger">Inactive</span>';
                    if(ActiveStatus::Active->value == $row->is_active){
                        $status = '<span class="badge bg-success">Active</span>';
                    }
                    return $status;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('M d Y h:i A');
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.coupon.edit', $row->id);
                    $deleteUrl = route('admin.coupon.destroy', $row->id);
                    $actionBtn = "<div class='btn-group' role='group' aria-label='Coupon Actions'>
                                        <a href='$editUrl' class='btn btn-primary btn-sm'><i class='bx bx-edit'></i></a>
                                        <a href='$deleteUrl' class='btn btn-danger btn-sm delete_btn' data-id='$row->id'><i class='bx bx-trash-alt'></i></a>
                                    </div>";
                    return $actionBtn;
                })
                ->rawColumns(['type', 'value', 'is_active', 'action'])
                ->make(true);
        }
        return view('admin.pages.coupon.index'); // Assuming this is your coupon index view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['activeStatus'] = ActiveStatus::asSelectArray();
        $data['couponTypes'] = CouponType::asSelectArray();
        return view('admin.pages.coupon.form')->with($data); // Assuming this is your coupon form view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $data = $request->validated();
       return $this->storeModel(Coupon::class, $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $activeStatus = ActiveStatus::asSelectArray();
        $couponTypes = CouponType::asSelectArray();
        return view('admin.pages.coupon.form', compact('coupon', 'activeStatus', 'couponTypes')); // Assuming your coupon form view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, string $id)
    {
       $data = $request->validated();
        return $this->updateModel(Coupon::class,$id,$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy(string $id)
    {
        return $this->destroyModel($id,Coupon::class);
    }
}
