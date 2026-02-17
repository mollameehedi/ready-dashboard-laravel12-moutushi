<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LoginLogController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = LoginLog::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name',function ($LoginLog) {
                $name = '';
                if(isset($LoginLog->user))
                {
                    $name = $LoginLog->user->first_name.' '. $LoginLog->user->last_name  ;
                }
                return $name;
            })
            ->addColumn('time',function ($LoginLog) {
                $time = '';
                if(isset($LoginLog->user))
                {
                    $time = $LoginLog->created_at->diffForHumans();
                }
                return $time;
            })
            ->make(true);
        }
        return view('admin.pages.loginlog.index');
    }
}
