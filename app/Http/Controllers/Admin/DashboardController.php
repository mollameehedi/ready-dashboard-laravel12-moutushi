<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Order\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $endDate = Carbon::today();
        $startDate = Carbon::now()->subDays(29);

        $orders = Order::query()->countData();
        $data['total_order'] = $orders->count();
        $data['total_success'] = $orders->clone()->delivered()->count();
        $data['total_pending'] = $orders->clone()->pending()->count();
        $data['total_cancel'] = $orders->clone()->cancel()->count();

        $dates = [];
        while ($startDate->lte($endDate)) {
            $dates[$startDate->format('Y-m-d')] = [
                'order' => 0,
                'success' => 0,
                'pending' => 0,
                'cancel' => 0,
            ];
            $startDate->addDay();
        }

        $orders = Order::whereBetween('created_at', [$endDate->subDays(14), Carbon::today()])->countData()->get();

        $chart_data = $orders->groupBy(function($date) {
            return $date->created_at->format('Y-m-d');
        })->map(function($group) {
            return [
                'order' => $group->count(),
                'success' => $group->where('order_status',OrderStatus::Delivered->value)->count(),
                'pending' => $group->where('order_status',OrderStatus::Pending->value)->count(),
                'cancel' => $group->where('order_status',OrderStatus::Cancel->value)->count(),
            ];
        });
        $data['chart_data'] = new Collection(array_merge($dates, $chart_data->toArray()));
        return view('admin.pages.dashboard.index')->with($data);
    }
}
