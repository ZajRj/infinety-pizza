<?php

namespace App;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::PENDING   => __('orders.statuses.pending'),
            self::CONFIRMED => __('orders.statuses.confirmed'),
            self::COMPLETED => __('orders.statuses.completed'),
            self::CANCELLED => __('orders.statuses.cancelled'),
        };
    }
}
