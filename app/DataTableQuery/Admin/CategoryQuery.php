<?php

namespace App\DataTableQuery\Admin;

use App\Models\Product\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryQuery
{
    public static function get(Request $request)
    {
        $data = Category::select(['id', 'name', 'status', 'created_at'])->orderBy('created_at', 'desc')->get();

        return datatables()::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return $row->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('image', function ($row) {
                $imageUrl = get_image_url($row, 'image');
                    return '<img src="' . $imageUrl . '" alt="'.$row->name.'" width="50">';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('M d Y h:i A');
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.category.main.edit', $row->id);
                $deleteUrl = route('admin.category.main.destroy', $row->id);
                $actionBtn = "<div class='btn-group' role='group' aria-label='Category Actions'>
                                <a href='$editUrl' class='btn btn-primary btn-sm'><i class='fadeIn animated bx bx-edit'></i></a>
                                <a href='$deleteUrl' class='btn btn-danger btn-sm delete_btn' data-id='$row->id'><i class='fadeIn animated bx bx-trash-alt'></i></a>
                            </div>";
                return $actionBtn;
            })
            ->rawColumns(['image','status', 'action'])
            ->make(true);
    }
}
