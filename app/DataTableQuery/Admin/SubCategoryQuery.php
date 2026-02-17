<?php

namespace App\DataTableQuery\Admin;

use App\Models\Product\SubCategory;

class SubCategoryQuery
{
    public static function get()
    {
        $data = SubCategory::with('category')->select(['id', 'name', 'category_id', 'status', 'created_at'])->orderBy('created_at', 'desc')->get();

        return datatables()::of($data)
            ->addIndexColumn()
            ->addColumn('category_name', function ($row) {
                return $row->category->name;
            })
            ->addColumn('status', function ($row) {
                return $row->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('M d Y h:i A');
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.category.sub.edit', $row->id);
                $deleteUrl = route('admin.category.sub.destroy', $row->id);
                $actionBtn = "<div class='btn-group' role='group' aria-label='Subcategory Actions'>
                                <a href='$editUrl' class='btn btn-primary btn-sm'><i class='fadeIn animated bx bx-edit'></i></a>
                                <a href='$deleteUrl' class='btn btn-danger btn-sm delete_btn' data-id='$row->id'><i class='fadeIn animated bx bx-trash-alt'></i></a>
                            </div>";
                return $actionBtn;
            })
            ->rawColumns(['category_name','status', 'action'])
            ->make(true);
    }
}
