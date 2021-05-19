<?php


namespace App\Types;


class ReservationStatuses
{
    const _CANCELLED = 'cancelled';
    const _PENDING = 'pending';
    const _APPROVED = 'approved';

    public static function getAllStatuses(): array
    {
        return [
            self::_CANCELLED,
            self::_PENDING,
            self::_APPROVED,
        ];
    }
}