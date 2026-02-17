<?php

namespace App\DataTableQuery\Admin;

use App\Enums\Product\StockType;
use App\Models\Product\ProductStock;
use Carbon\Carbon;

class ProductStockQuery
{
    public static function get($product_id)
    {
        $product = ProductStock::where('product_id', $product_id)->get();
        return datatables()::of($product)
            ->addIndexColumn()
            ->addColumn('type', function ($row) {
                $type = '<span class="badge bg-danger">'.StockType::Deduction->name.'</span>';
                if($row->type == 1 ){
                $type = '<span class="badge bg-success">'.StockType::Addition->name.'</span>';
                }
                return $type;
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('M d Y h:i A');
            })
            ->rawColumns(['type','created_at'])
            ->make(true);
    }
}
