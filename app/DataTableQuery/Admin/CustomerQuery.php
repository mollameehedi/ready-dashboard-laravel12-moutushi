<?php

namespace App\DataTableQuery\Admin;

use App\Models\Product\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerQuery
{
    public static function get(Request $request)
    {
        $data = User::customers()->select(['id', 'name', 'email', 'number', 'address','created_at'])
                ->orderBy('created_at', 'desc')
                ->get();

            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('M d Y h:i A');
                })
                ->addColumn('action', function ($row) {
                    $show = route('admin.customer.show', $row->id);
                    $actionBtn = "<div class='btn-group' role='group' aria-label='Customer Actions'>
                                    <a href='$show' class='btn btn-primary btn-sm'><i class='fadeIn animated bx bx-show'></i></a>
                                 </div>";
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);

    }
}
