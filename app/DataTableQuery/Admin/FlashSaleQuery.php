<?php

namespace App\DataTableQuery\Admin;

use App\Models\Product\FlashSale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FlashSaleQuery
{
    public static function get(Request $request)
    {
        $data = FlashSale::select(['id', 'name', 'start_date', 'end_time', 'is_current', 'created_at'])
        ->orderBy('created_at', 'desc')->with('media')
        ->get();

    return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('start_date', function ($row) {
            return Carbon::parse($row->start_date)->format('M d Y h:i A');
        })
        ->addColumn('image', function ($row) {
            $imageUrl = get_image_url($row, 'image');
                return '<a href="'. $imageUrl.'" target="_blank" ><img src="' . $imageUrl . '" alt="'.$row->name.'" height="50"></a>';
        })
        ->addColumn('end_time', function ($row) {
            return Carbon::parse($row->end_time)->format('M d Y h:i A');
        })
        ->addColumn('is_current', function ($row) {
            return $row->is_current ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>';
        })
        ->addColumn('created_at', function ($row) {
            return $row->created_at->format('M d Y h:i A');
        })
        ->addColumn('action', function ($row) {
            $editUrl = route('admin.flash_sale.edit', $row->id);
            $deleteUrl = route('admin.flash_sale.destroy', $row->id);
            $actionBtn = "<div class='dropdown'>
            <button class='btn btn-primary dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>Actions</button>
            <ul class='dropdown-menu'>
                <li><a class='dropdown-item' href='$editUrl'>Edit</a></li>
                <li><a class='dropdown-item delete_btn' href='$deleteUrl' data-id='$row->id'>Delete</a></li>
                <li><a class='dropdown-item' href='" . route('admin.flash_sale.product.index', $row->id) . "'>Add Product</a></li>
            </ul>
        </div>";
            return $actionBtn;
        })
        ->rawColumns(['image','is_current', 'action'])
        ->make(true);
    }
}
