<?php

namespace App\Http\Controllers\Admin;

use App\DataTableQuery\Admin\CustomerQuery;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerCotnroller extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            return CustomerQuery::get($request);
        }
        return view('admin.pages.customer.index');
    }
    public function show($id)
{
    $customer = User::findOrFail($id);
    return view('admin.pages.customer.show', compact('customer'));
}
}
