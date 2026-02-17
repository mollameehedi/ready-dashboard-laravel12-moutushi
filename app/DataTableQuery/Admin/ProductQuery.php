<?php

namespace App\DataTableQuery\Admin;

use App\Enums\Common\ActiveStatus;
use App\Models\Product\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductQuery
{
    public static function get(Request $request)
    {
        $data = Product::with('category','media')->select([
            'id',
            'title',
            'product_code',
            'price',
            'quantity',
            'is_active',
            'created_at',
            'category_id'
        ])->orderBy('created_at', 'desc')->get();

        return datatables()::of($data)
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                $imageUrl = get_image_url($row, 'image');
                    return '<img src="' . $imageUrl . '" alt="'.$row->name.'" width="50">';
            })
            ->addColumn('title', function ($row) {

                    return Str::limit($row->title,25);
            })
            ->addColumn('category_name', function ($row) {
                return $row->category->name;
            })
            ->addColumn('is_active', function ($row) {
                return ActiveStatus::fromValue($row->is_active)->value == ActiveStatus::Active->value ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('M d Y h:i A');
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.product.edit', $row->id);
                $deleteUrl = route('admin.product.destroy', $row->id);
                                $actionBtn = "<div class='dropdown'>
                                    <button class='btn btn-primary dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>Actions</button>
                                    <ul class='dropdown-menu'>
                                        <li><a class='dropdown-item' href='$editUrl'>Edit</a></li>
                                        <li><a class='dropdown-item delete_btn' href='$deleteUrl' data-id='$row->id'>Delete</a></li>
                                        <li><a class='dropdown-item' href='" . route('admin.product.stock.index', $row->id) . "'>Add Stock</a></li>
                                    </ul>
                                </div>";
                return $actionBtn;
            })
            ->rawColumns(['image','is_active', 'action'])
            ->make(true);
    }
}
