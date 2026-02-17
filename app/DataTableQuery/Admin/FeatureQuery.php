<?php

namespace App\DataTableQuery\Admin;

use App\Models\Product\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FeatureQuery
{
    public static function get(Request $request)
    {
            $data = Category::featureCategory()
                ->select(['id', 'name', 'feature_status', 'created_at'])
                ->orderBy('created_at', 'desc')
                ->get();

            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('feature_status', function ($row) {
                    $feature_status = '<span class="badge bg-danger">Inactive</span>';
                    if($row->feature_status == 1){
                        $feature_status = '<span class="badge bg-success">Active</span>';
                    }
                    return  $feature_status;
                })
                ->addColumn('image', function ($row) {
                    $imageUrl = get_image_url($row, 'feature_image');
                    return '<img src="' . $imageUrl . '" alt="' . $row->name . '" width="50" height="50">';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('M d Y h:i A');
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.category.feature.edit', $row->id);
                    $deleteUrl = route('admin.category.feature.destroy', $row->id);
                    $actionBtn = "<div class='btn-group' role='group' aria-label='Category Actions'>
                                        <a href='$editUrl' class='btn btn-primary btn-sm'><i class='fadeIn animated bx bx-edit'></i></a>
                                        <a href='$deleteUrl' class='btn btn-danger btn-sm delete_btn' data-id='$row->id'><i class='fadeIn animated bx bx-trash-alt'></i></a>
                                    </div>";
                    return $actionBtn;
                })
                ->rawColumns(['image', 'feature_status', 'action'])
                ->make(true);
    }
}
