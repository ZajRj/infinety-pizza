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
            self::PENDING   => 'Pendiente',
            self::CONFIRMED => 'Confirmada',
            self::COMPLETED => 'Completada',
            self::CANCELLED => 'Cancelada',
        };
    }
}
