<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboadrdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        return view('admin.pages.dashboard.index', [
            'stats' => [
                ['label' => 'Total Orders', 'value' => 150, 'color' => 'info'],
                ['label' => 'Revenue', 'value' => '$12,500', 'color' => 'success'],
                ['label' => 'Products', 'value' => 120, 'color' => 'warning'],
                ['label' => 'Customers', 'value' => 75, 'color' => 'danger'],
            ],
            'chart_data' => [
                'Jan 18' => ['sales' => 1000],
                'Jan 19' => ['sales' => 1200],
                'Jan 20' => ['sales' => 800],
                'Jan 21' => ['sales' => 1500],
                'Jan 22' => ['sales' => 1300],
                'Jan 23' => ['sales' => 1700],
                'Jan 24' => ['sales' => 1600],
            ],
            'recent_orders' => [
                ['id'=>101,'customer'=>'Alice','status'=>'Completed','amount'=>'$120','date'=>'2026-01-24'],
                ['id'=>102,'customer'=>'Bob','status'=>'Pending','amount'=>'$250','date'=>'2026-01-23'],
                ['id'=>103,'customer'=>'Charlie','status'=>'Cancelled','amount'=>'$90','date'=>'2026-01-23'],
                ['id'=>104,'customer'=>'Diana','status'=>'Completed','amount'=>'$180','date'=>'2026-01-22'],
                ['id'=>105,'customer'=>'Eve','status'=>'Pending','amount'=>'$300','date'=>'2026-01-22'],
            ]
        ]);
    }

   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
