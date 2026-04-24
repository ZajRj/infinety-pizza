<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // 1. Most sold pizza
        $mostSoldPizza = OrderDetail::select('pizza_name', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('pizza_name')
            ->orderByDesc('total_sold')
            ->first();

        // 2. Total (non admin) users
        $totalUsers = User::where('is_admin', false)->count();

        // 3. Orders of the day
        $ordersToday = Order::whereDate('created_at', now())->count();

        return [
            Stat::make(__('Most Sold Pizza'), $mostSoldPizza?->pizza_name ?? __('No sales yet'))
                ->description($mostSoldPizza ? __('Total units') . ": {$mostSoldPizza->total_sold}" : __('Get those ovens hot!'))
                ->descriptionIcon('heroicon-m-fire')
                ->color('danger'),

            Stat::make(__('Total Fans'), $totalUsers)
                ->description(__('Active connoisseurs'))
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make(__('Orders Today'), $ordersToday)
                ->description(__('Daily momentum'))
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('success'),
        ];
    }
}
