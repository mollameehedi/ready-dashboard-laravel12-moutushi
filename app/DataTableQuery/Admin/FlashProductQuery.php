<?php

namespace App\DataTableQuery\Admin;

use App\Enums\Common\ActiveStatus;
use App\Enums\Common\BooleanStatus;
use App\Models\Product\FlashSaleProduct;
use App\Models\Product\ProductStock;
use Carbon\Carbon;

class FlashProductQuery
{
    public static function get($id)
    {
        $product = FlashSaleProduct::where('flash_sale_id',$id)->select('id','flash_sale_id', 'product_id', 'quantity', 'sold_quantity', 'price', 'is_active', 'created_at')->get();
        return datatables()::of($product)
            ->addIndexColumn()
            ->addColumn('is_active', function ($row) {
                $type = '<span class="badge bg-success">'.ActiveStatus::Active->name.'</span>';
                if(!$row->is_active ){
                $type = '<span class="badge bg-danger">'.ActiveStatus::Inactive->name.'</span>';
                }
                return $type;
            })
            ->addColumn('product_title', function ($row) {
                return $row->product?->title;
            })
            ->addColumn('start_date', function ($row) {
                return $row->start_date?->format('M d Y h:i A');
            })
            ->addColumn('end_date', function ($row) {
                return $row->end_date?->format('M d Y h:i A');
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at?->format('M d Y h:i A');
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.flash_sale.product.edit', $row->id);
                $deleteUrl = route('admin.flash_sale.product.destroy', $row->id);

                $actionBtn = "<div class='btn-group' role='group' aria-label='Category Actions'>
                <a href='$editUrl' class='btn btn-primary btn-sm'><i class='fadeIn animated bx bx-edit'></i></a>
                <a href='$deleteUrl' class='btn btn-danger btn-sm delete_btn' data-id='$row->id'><i class='fadeIn animated bx bx-trash-alt'></i></a>
            </div>";
return $actionBtn;
            })
            ->rawColumns(['is_active','created_at','action'])
            ->make(true);
    }
}
